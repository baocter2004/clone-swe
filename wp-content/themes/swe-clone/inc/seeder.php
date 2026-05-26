<?php
/**
 * Seeder dự án SWE — chạy 1 lần hoặc reset demo.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

require_once SWE_CLONE_DIR . '/inc/seeder-data.php';

/**
 * Chạy seeder đầy đủ.
 *
 * @param bool $reset Xóa dữ liệu demo cũ trước khi seed.
 * @return array{ok: bool, message: string, stats: array<string, int>}
 */
function swe_clone_run_seeder( $reset = false ) {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return array(
			'ok'      => false,
			'message' => 'Cần bật plugin WooCommerce trước.',
			'stats'   => array(),
		);
	}

	@set_time_limit( 300 );

	$stats = array(
		'categories' => 0,
		'products'   => 0,
		'heroes'     => 0,
		'cat_banners'=> 0,
		'feedback'   => 0,
	);

	if ( $reset ) {
		swe_clone_delete_demo_data();
	}

	if ( function_exists( 'swe_clone_woocommerce_install' ) ) {
		delete_option( 'swe_clone_wc_configured' );
		swe_clone_woocommerce_install();
	}

	$cat_map = swe_clone_seed_categories( $stats );
	swe_clone_seed_all_products( $cat_map, $stats );
	swe_clone_seed_heroes_cpt( $stats );
	swe_clone_seed_category_cpt( $stats );
	swe_clone_seed_feedback_cpt( $stats );

	flush_rewrite_rules( true );
	update_option( 'swe_clone_demo_seeded', 1 );
	update_option( 'swe_clone_demo_seeded_at', current_time( 'mysql' ) );

	return array(
		'ok'      => true,
		'message' => 'Đã seed dữ liệu demo SWE thành công.',
		'stats'   => $stats,
	);
}

/**
 * Xóa sản phẩm / CPT có meta demo.
 */
function swe_clone_delete_demo_data() {
	$types = array( 'product', 'swe_hero', 'swe_category', 'swe_feedback' );

	foreach ( $types as $type ) {
		$posts = get_posts(
			array(
				'post_type'      => $type,
				'post_status'    => 'any',
				'posts_per_page' => -1,
				'meta_key'       => '_swe_demo',
				'meta_value'     => '1',
				'fields'         => 'ids',
			)
		);

		foreach ( $posts as $id ) {
			wp_delete_post( (int) $id, true );
		}
	}
}

/**
 * Seed product categories.
 *
 * @param array<string, int> $stats Stats ref.
 * @return array<string, int> slug => term_id
 */
function swe_clone_seed_categories( &$stats ) {
	$map = array();

	foreach ( swe_seed_product_categories() as $key => $cat ) {
		$term = term_exists( $cat['slug'], 'product_cat' );

		if ( ! $term ) {
			$term = wp_insert_term(
				$cat['name'],
				'product_cat',
				array(
					'slug'        => $cat['slug'],
					'description' => $cat['description'],
				)
			);
		}

		if ( is_wp_error( $term ) ) {
			continue;
		}

		$term_id       = is_array( $term ) ? (int) $term['term_id'] : (int) $term;
		$map[ $key ]   = $term_id;
		++$stats['categories'];
	}

	return $map;
}

/**
 * Seed products (simple hoặc variable có size).
 *
 * @param array<string, int> $cat_map Category map.
 * @param array<string, int> $stats Stats ref.
 */
function swe_clone_seed_all_products( $cat_map, &$stats ) {
	foreach ( swe_seed_products() as $item ) {
		if ( get_page_by_path( $item['slug'], OBJECT, 'product' ) ) {
			continue;
		}

		$sizes = $item['sizes'] ?? array();

		if ( count( $sizes ) > 1 ) {
			$product_id = swe_clone_create_variable_product( $item, $sizes );
		} else {
			$product_id = swe_clone_create_simple_product( $item );
		}

		if ( ! $product_id ) {
			continue;
		}

		update_post_meta( $product_id, '_swe_demo', '1' );

		$term_ids = array();
		foreach ( (array) ( $item['categories'] ?? array() ) as $slug ) {
			if ( isset( $cat_map[ $slug ] ) ) {
				$term_ids[] = $cat_map[ $slug ];
			}
		}
		if ( $term_ids ) {
			wp_set_object_terms( $product_id, $term_ids, 'product_cat' );
		}

		++$stats['products'];
	}
}

/**
 * Simple product.
 *
 * @param array<string, mixed> $item Product data.
 * @return int Product ID.
 */
function swe_clone_create_simple_product( $item ) {
	$product = new WC_Product_Simple();
	$product->set_name( $item['name'] );
	$product->set_slug( $item['slug'] );
	$product->set_regular_price( (string) $item['price'] );

	if ( ! empty( $item['sale_price'] ) ) {
		$product->set_sale_price( (string) $item['sale_price'] );
	}

	$product->set_short_description( $item['short'] ?? '' );
	$product->set_description( $item['description'] ?? '' );
	$product->set_status( 'publish' );
	$product->set_catalog_visibility( 'visible' );
	$product->set_manage_stock( true );
	$product->set_stock_quantity( (int) ( $item['stock'] ?? 20 ) );
	$product->set_stock_status( 'instock' );
	$product->save();

	$id = $product->get_id();
	swe_clone_seed_product_images( $id, $item );

	return $id;
}

/**
 * Variable product with Size.
 *
 * @param array<string, mixed> $item Product data.
 * @param array<int, string>   $sizes Sizes.
 * @return int Product ID.
 */
function swe_clone_create_variable_product( $item, $sizes ) {
	$product = new WC_Product_Variable();
	$product->set_name( $item['name'] );
	$product->set_slug( $item['slug'] );
	$product->set_short_description( $item['short'] ?? '' );
	$product->set_description( $item['description'] ?? '' );
	$product->set_status( 'publish' );
	$product->set_catalog_visibility( 'visible' );

	$attr = new WC_Product_Attribute();
	$attr->set_id( 0 );
	$attr->set_name( 'Size' );
	$attr->set_options( $sizes );
	$attr->set_visible( true );
	$attr->set_variation( true );
	$product->set_attributes( array( $attr ) );
	$product->save();

	$id = $product->get_id();
	swe_clone_seed_product_images( $id, $item );

	foreach ( $sizes as $size ) {
		$variation = new WC_Product_Variation();
		$variation->set_parent_id( $id );
		$variation->set_regular_price( (string) $item['price'] );
		if ( ! empty( $item['sale_price'] ) ) {
			$variation->set_sale_price( (string) $item['sale_price'] );
		}
		$variation->set_attributes( array( 'attribute_size' => $size ) );
		$variation->set_manage_stock( true );
		$variation->set_stock_quantity( (int) ( $item['stock'] ?? 10 ) );
		$variation->set_stock_status( 'instock' );
		$variation->set_status( 'publish' );
		$variation->save();
	}

	WC_Product_Variable::sync( $id );

	return $id;
}

/**
 * Attach images.
 *
 * @param int                  $product_id Product ID.
 * @param array<string, mixed> $item Product data.
 */
function swe_clone_seed_product_images( $product_id, $item ) {
	if ( ! empty( $item['image'] ) ) {
		swe_clone_attach_image_from_url( $product_id, $item['image'], true );
	}

	if ( ! empty( $item['gallery'] ) ) {
		$gallery_ids = array();
		foreach ( (array) $item['gallery'] as $url ) {
			$aid = swe_clone_attach_image_from_url( $product_id, $url, false );
			if ( $aid ) {
				$gallery_ids[] = $aid;
			}
		}
		if ( $gallery_ids ) {
			$product = wc_get_product( $product_id );
			if ( $product ) {
				$product->set_gallery_image_ids( $gallery_ids );
				$product->save();
			}
		}
	}
}

/**
 * @param int                  $post_id Post ID.
 * @param string               $url URL.
 * @param bool                 $featured Featured.
 * @return int Attachment ID.
 */
function swe_clone_attach_image_from_url( $post_id, $url, $featured = false ) {
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$tmp = download_url( $url );
	if ( is_wp_error( $tmp ) ) {
		return 0;
	}

	$file = array(
		'name'     => basename( wp_parse_url( $url, PHP_URL_PATH ) ) ?: 'swe-image.jpg',
		'tmp_name' => $tmp,
	);

	$id = media_handle_sideload( $file, $post_id );
	if ( is_wp_error( $id ) ) {
		@unlink( $tmp );
		return 0;
	}

	if ( $featured ) {
		set_post_thumbnail( $post_id, $id );
	}

	return (int) $id;
}

/**
 * Hero CPT.
 *
 * @param array<string, int> $stats Stats.
 */
function swe_clone_seed_heroes_cpt( &$stats ) {
	$order = 0;
	foreach ( swe_seed_heroes() as $hero ) {
		if ( get_page_by_title( $hero['title'], OBJECT, 'swe_hero' ) ) {
			continue;
		}

		$id = wp_insert_post(
			array(
				'post_type'   => 'swe_hero',
				'post_title'  => $hero['title'],
				'post_status' => 'publish',
				'menu_order'  => $order++,
			)
		);

		if ( is_wp_error( $id ) ) {
			continue;
		}

		update_post_meta( $id, '_swe_demo', '1' );
		update_post_meta( $id, '_swe_slide_url', home_url( $hero['url'] ) );
		swe_clone_attach_image_from_url( $id, $hero['image'], true );

		$mobile_id = swe_clone_attach_image_from_url( $id, $hero['mobile'], false );
		if ( $mobile_id ) {
			update_post_meta( $id, '_swe_slide_mobile_id', $mobile_id );
		}

		++$stats['heroes'];
	}
}

/**
 * Category banner CPT.
 *
 * @param array<string, int> $stats Stats.
 */
function swe_clone_seed_category_cpt( &$stats ) {
	$order = 0;
	foreach ( swe_seed_category_banners() as $banner ) {
		$exists = get_page_by_title( $banner['title'], OBJECT, 'swe_category' );
		if ( $exists ) {
			continue;
		}

		$id = wp_insert_post(
			array(
				'post_type'   => 'swe_category',
				'post_title'  => $banner['title'],
				'post_status' => 'publish',
				'menu_order'  => $order++,
			)
		);

		if ( is_wp_error( $id ) ) {
			continue;
		}

		update_post_meta( $id, '_swe_demo', '1' );
		update_post_meta( $id, '_swe_category_url', home_url( $banner['url'] ) );
		swe_clone_attach_image_from_url( $id, $banner['image'], true );

		++$stats['cat_banners'];
	}
}

/**
 * Feedback CPT.
 *
 * @param array<string, int> $stats Stats.
 */
function swe_clone_seed_feedback_cpt( &$stats ) {
	$order = 0;
	foreach ( swe_seed_feedback() as $fb ) {
		$exists = get_page_by_title( $fb['title'], OBJECT, 'swe_feedback' );
		if ( $exists ) {
			continue;
		}

		$id = wp_insert_post(
			array(
				'post_type'   => 'swe_feedback',
				'post_title'  => $fb['title'],
				'post_status' => 'publish',
				'menu_order'  => $order++,
			)
		);

		if ( is_wp_error( $id ) ) {
			continue;
		}

		update_post_meta( $id, '_swe_demo', '1' );
		update_post_meta( $id, '_swe_feedback_url', home_url( $fb['url'] ) );
		swe_clone_attach_image_from_url( $id, $fb['image'], true );

		++$stats['feedback'];
	}
}

/**
 * Admin: Tools → SWE Demo Data.
 */
function swe_clone_seed_admin_menu() {
	add_management_page(
		__( 'SWE Demo Data', 'swe-clone' ),
		__( 'SWE Demo Data', 'swe-clone' ),
		'manage_options',
		'swe-demo-seed',
		'swe_clone_seed_admin_page'
	);
}
add_action( 'admin_menu', 'swe_clone_seed_admin_menu' );

/**
 * Admin page UI.
 */
function swe_clone_seed_admin_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$result = null;
	if ( isset( $_POST['swe_seed_action'] ) && check_admin_referer( 'swe_seed_action' ) ) {
		$reset  = 'reset' === $_POST['swe_seed_action'];
		$result = swe_clone_run_seeder( $reset );
	}

	$seeded_at = get_option( 'swe_clone_demo_seeded_at' );
	?>
	<div class="wrap">
		<h1>SWE — Seeder dự án demo</h1>
		<p>Tạo danh mục, sản phẩm (có size), banner, feedback — dùng cho demo / đồ án.</p>

		<?php if ( $seeded_at ) : ?>
			<p><strong>Lần seed gần nhất:</strong> <?php echo esc_html( $seeded_at ); ?></p>
		<?php endif; ?>

		<?php if ( $result ) : ?>
			<div class="notice notice-<?php echo $result['ok'] ? 'success' : 'error'; ?>">
				<p><?php echo esc_html( $result['message'] ); ?></p>
				<?php if ( ! empty( $result['stats'] ) ) : ?>
					<ul>
						<?php foreach ( $result['stats'] as $k => $v ) : ?>
							<li><?php echo esc_html( $k . ': ' . $v ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<form method="post" style="margin-top:20px;">
			<?php wp_nonce_field( 'swe_seed_action' ); ?>
			<p>
				<button type="submit" name="swe_seed_action" value="seed" class="button button-primary">
					Seed dữ liệu (giữ SP cũ, chỉ thêm thiếu)
				</button>
			</p>
		</form>

		<form method="post" onsubmit="return confirm('Xóa toàn bộ sản phẩm/banner demo và tạo lại?');">
			<?php wp_nonce_field( 'swe_seed_action' ); ?>
			<p>
				<button type="submit" name="swe_seed_action" value="reset" class="button">
					Reset &amp; Seed lại từ đầu
				</button>
			</p>
		</form>

		<hr>
		<h2>Luồng test bán hàng</h2>
		<ol>
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank">Trang chủ</a></li>
			<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" target="_blank">Cửa hàng</a></li>
			<li>Chọn SP → Thêm giỏ → <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" target="_blank">Giỏ hàng</a></li>
			<li><a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" target="_blank">Thanh toán</a> (COD)</li>
		</ol>
	</div>
	<?php
}

/**
 * URL nhanh: /wp-admin/?swe_seed_demo=1
 */
function swe_clone_seed_url_trigger() {
	if ( ! is_admin() || ! current_user_can( 'manage_options' ) || empty( $_GET['swe_seed_demo'] ) ) {
		return;
	}

	$reset  = ! empty( $_GET['reset'] );
	$result = swe_clone_run_seeder( $reset );

	wp_safe_redirect(
		add_query_arg(
			array(
				'page'       => 'swe-demo-seed',
				'seeded'     => $result['ok'] ? '1' : '0',
				'message'    => rawurlencode( $result['message'] ),
			),
			admin_url( 'tools.php' )
		)
	);
	exit;
}
add_action( 'admin_init', 'swe_clone_seed_url_trigger' );
