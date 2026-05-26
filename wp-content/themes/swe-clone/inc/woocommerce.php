<?php
/**
 * WooCommerce integration — bán hàng thật.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

/**
 * Check WooCommerce active.
 */
function swe_clone_is_woo() {
	return class_exists( 'WooCommerce' );
}

/**
 * Cart URL helpers (luôn có — dùng trong header/footer).
 */
function swe_clone_cart_count() {
	if ( ! swe_clone_is_woo() || ! WC()->cart ) {
		return 0;
	}
	return WC()->cart->get_cart_contents_count();
}

function swe_clone_cart_url() {
	return swe_clone_is_woo() ? wc_get_cart_url() : '#';
}

function swe_clone_checkout_url() {
	return swe_clone_is_woo() ? wc_get_checkout_url() : '#';
}

function swe_clone_shop_url() {
	return swe_clone_is_woo() ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
}

if ( ! swe_clone_is_woo() ) {
	return;
}

/**
 * Theme support + setup.
 */
function swe_clone_woocommerce_setup() {
	if ( ! swe_clone_is_woo() ) {
		return;
	}

	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 600,
			'single_image_width'    => 800,
			'product_grid'          => array(
				'default_rows'    => 4,
				'min_rows'        => 1,
				'max_rows'        => 8,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 4,
			),
		)
	);

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'swe_clone_woocommerce_setup' );

/**
 * VND — không lẻ xu.
 */
function swe_clone_woo_currency_vnd( $currency ) {
	return 'VND';
}
add_filter( 'woocommerce_currency', 'swe_clone_woo_currency_vnd' );

/**
 * Symbol ₫.
 *
 * @param string $symbol Symbol.
 * @param string $currency Currency code.
 */
function swe_clone_woo_currency_symbol( $symbol, $currency ) {
	return 'VND' === $currency ? '₫' : $symbol;
}
add_filter( 'woocommerce_currency_symbol', 'swe_clone_woo_currency_symbol', 10, 2 );

/**
 * Price decimals.
 *
 * @param array $args Price args.
 */
function swe_clone_woo_price_args( $args ) {
	$args['decimals'] = 0;
	return $args;
}
add_filter( 'wc_price_args', 'swe_clone_woo_price_args' );

/**
 * Bỏ style mặc định WooCommerce (dùng theme CSS).
 *
 * @param array $styles Enqueued styles.
 */
function swe_clone_woo_dequeue_styles( $styles ) {
	unset( $styles['woocommerce-general'] );
	unset( $styles['woocommerce-layout'] );
	unset( $styles['woocommerce-smallscreen'] );
	return $styles;
}
add_filter( 'woocommerce_enqueue_styles', 'swe_clone_woo_dequeue_styles' );

/**
 * Enqueue cart fragments (cập nhật số giỏ AJAX).
 */
function swe_clone_woo_scripts() {
	if ( ! swe_clone_is_woo() ) {
		return;
	}

	wp_enqueue_script( 'wc-cart-fragments' );

	wp_localize_script(
		'swe-clone-main',
		'sweClone',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'cartUrl' => wc_get_cart_url(),
			'checkoutUrl' => wc_get_checkout_url(),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'swe_clone_woo_scripts', 20 );

/**
 * Cart count fragment.
 *
 * @param array $fragments Fragments.
 */
function swe_clone_cart_fragments( $fragments ) {
	$count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;

	ob_start();
	?>
	<span class="swe-header__cart-count"><?php echo esc_html( (string) $count ); ?></span>
	<?php
	$fragments['span.swe-header__cart-count'] = ob_get_clean();

	ob_start();
	woocommerce_mini_cart();
	$fragments['div.swe-mini-cart'] = '<div class="swe-mini-cart">' . ob_get_clean() . '</div>';

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'swe_clone_cart_fragments' );

/**
 * Wrapper — bỏ sidebar mặc định.
 */
function swe_clone_woo_before_main_content() {
	if ( is_product() ) {
		echo '<div class="swe-woo-page">';
		return;
	}
	echo '<div class="swe-container swe-woo-wrap">';
}
add_action( 'woocommerce_before_main_content', 'swe_clone_woo_before_main_content', 5 );

function swe_clone_woo_after_main_content() {
	echo '</div>';
}
add_action( 'woocommerce_after_main_content', 'swe_clone_woo_after_main_content', 50 );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Products per page.
 *
 * @param int $cols Columns.
 */
function swe_clone_woo_loop_columns( $cols ) {
	return 4;
}
add_filter( 'loop_shop_columns', 'swe_clone_woo_loop_columns' );

function swe_clone_woo_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'swe_clone_woo_products_per_page' );

/**
 * Trang SP: bỏ tab đánh giá / comment (form WP mặc định dễ vỡ CSS).
 */
function swe_clone_remove_product_tabs( $tabs ) {
	unset( $tabs['reviews'] );
	unset( $tabs['additional_information'] );

	if ( isset( $tabs['description'] ) ) {
		$tabs['description']['title'] = __( 'Mô tả', 'swe-clone' );
	}

	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'swe_clone_remove_product_tabs', 98 );

/**
 * Tắt rating dưới tiêu đề.
 */
function swe_clone_single_product_summary_hooks() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
}
add_action( 'wp', 'swe_clone_single_product_summary_hooks' );

/**
 * Script gallery SP (ảnh không bị opacity: 0).
 */
function swe_clone_single_product_scripts() {
	if ( ! is_product() ) {
		return;
	}

	wp_enqueue_script( 'wc-single-product' );
}
add_action( 'wp_enqueue_scripts', 'swe_clone_single_product_scripts', 25 );

/**
 * Tắt comments/reviews trên sản phẩm.
 */
function swe_clone_disable_product_comments( $open, $post_id ) {
	$post = get_post( $post_id );
	if ( $post && 'product' === $post->post_type ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'swe_clone_disable_product_comments', 10, 2 );
