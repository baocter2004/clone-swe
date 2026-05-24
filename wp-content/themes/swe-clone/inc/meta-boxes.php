<?php
/**
 * Meta boxes + Media Uploader cho banner.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register meta boxes.
 */
function swe_clone_add_meta_boxes() {
	add_meta_box(
		'swe_hero_settings',
		__( 'Cài đặt banner', 'swe-clone' ),
		'swe_clone_render_hero_meta_box',
		'swe_hero',
		'normal',
		'high'
	);

	add_meta_box(
		'swe_category_settings',
		__( 'Link danh mục', 'swe-clone' ),
		'swe_clone_render_category_meta_box',
		'swe_category',
		'normal',
		'high'
	);

	add_meta_box(
		'swe_feedback_settings',
		__( 'Link (tuỳ chọn)', 'swe-clone' ),
		'swe_clone_render_feedback_meta_box',
		'swe_feedback',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'swe_clone_add_meta_boxes' );

/**
 * Hero meta box HTML.
 *
 * @param WP_Post $post Post.
 */
function swe_clone_render_hero_meta_box( $post ) {
	wp_nonce_field( 'swe_hero_save', 'swe_hero_nonce' );

	$url       = get_post_meta( $post->ID, '_swe_slide_url', true );
	$mobile_id = (int) get_post_meta( $post->ID, '_swe_slide_mobile_id', true );
	$mobile_url = $mobile_id ? wp_get_attachment_image_url( $mobile_id, 'medium' ) : '';
	?>
	<p>
		<label for="swe_slide_url"><strong><? esc_html_e( 'Link khi bấm banner', 'swe-clone' ); ?></strong></label><br>
		<input type="url" class="widefat" id="swe_slide_url" name="swe_slide_url" value="<?php echo esc_attr( $url ); ?>" placeholder="https://...">
	</p>
	<p class="description">
		<?php esc_html_e( 'Ảnh desktop: dùng "Ảnh đại diện" bên phải (nên ≥ 1920×1080). Ảnh mobile: khung dưới (nên dọc 9:16).', 'swe-clone' ); ?>
	</p>
	<hr>
	<p><strong><? esc_html_e( 'Ảnh mobile (tuỳ chọn)', 'swe-clone' ); ?></strong></p>
	<div id="swe-mobile-preview" style="margin-bottom:8px;">
		<?php if ( $mobile_url ) : ?>
			<img src="<?php echo esc_url( $mobile_url ); ?>" style="max-width:200px;height:auto;">
		<?php endif; ?>
	</div>
	<input type="hidden" id="swe_slide_mobile_id" name="swe_slide_mobile_id" value="<?php echo esc_attr( $mobile_id ); ?>">
	<button type="button" class="button swe-upload-btn" data-target="swe_slide_mobile_id" data-preview="swe-mobile-preview">
		<?php esc_html_e( 'Chọn ảnh mobile', 'swe-clone' ); ?>
	</button>
	<button type="button" class="button swe-remove-btn" data-target="swe_slide_mobile_id" data-preview="swe-mobile-preview">
		<?php esc_html_e( 'Xóa', 'swe-clone' ); ?>
	</button>
	<?php
}

/**
 * Category link meta box.
 *
 * @param WP_Post $post Post.
 */
function swe_clone_render_category_meta_box( $post ) {
	wp_nonce_field( 'swe_category_save', 'swe_category_nonce' );
	$url = get_post_meta( $post->ID, '_swe_category_url', true );
	?>
	<p>
		<label for="swe_category_url"><strong><?php esc_html_e( 'Link danh mục', 'swe-clone' ); ?></strong></label><br>
		<input type="url" class="widefat" id="swe_category_url" name="swe_category_url" value="<?php echo esc_attr( $url ); ?>" placeholder="/collections/tops/">
	</p>
	<p class="description"><?php esc_html_e( 'Tiêu đề = tên hiển thị (TOP, BOTTOM...). Ảnh đại diện = ảnh danh mục.', 'swe-clone' ); ?></p>
	<?php
}

/**
 * Feedback link meta box.
 *
 * @param WP_Post $post Post.
 */
function swe_clone_render_feedback_meta_box( $post ) {
	wp_nonce_field( 'swe_feedback_save', 'swe_feedback_nonce' );
	$url = get_post_meta( $post->ID, '_swe_feedback_url', true );
	?>
	<p>
		<label for="swe_feedback_url"><strong><?php esc_html_e( 'Link', 'swe-clone' ); ?></strong></label><br>
		<input type="url" class="widefat" id="swe_feedback_url" name="swe_feedback_url" value="<?php echo esc_attr( $url ); ?>" placeholder="#">
	</p>
	<?php
}

/**
 * Save meta.
 *
 * @param int $post_id Post ID.
 */
function swe_clone_save_meta( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['swe_hero_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['swe_hero_nonce'] ) ), 'swe_hero_save' ) ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		update_post_meta( $post_id, '_swe_slide_url', esc_url_raw( wp_unslash( $_POST['swe_slide_url'] ?? '' ) ) );
		update_post_meta( $post_id, '_swe_slide_mobile_id', absint( $_POST['swe_slide_mobile_id'] ?? 0 ) );
	}

	if ( isset( $_POST['swe_category_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['swe_category_nonce'] ) ), 'swe_category_save' ) ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		update_post_meta( $post_id, '_swe_category_url', esc_url_raw( wp_unslash( $_POST['swe_category_url'] ?? '' ) ) );
	}

	if ( isset( $_POST['swe_feedback_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['swe_feedback_nonce'] ) ), 'swe_feedback_save' ) ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		update_post_meta( $post_id, '_swe_feedback_url', esc_url_raw( wp_unslash( $_POST['swe_feedback_url'] ?? '' ) ) );
	}
}
add_action( 'save_post', 'swe_clone_save_meta' );

/**
 * Enqueue media uploader in admin.
 *
 * @param string $hook Hook.
 */
function swe_clone_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}

	$screen = get_current_screen();
	if ( ! $screen || ! in_array( $screen->post_type, array( 'swe_hero', 'swe_category', 'swe_feedback' ), true ) ) {
		return;
	}

	wp_enqueue_media();
	wp_enqueue_script(
		'swe-clone-admin',
		SWE_CLONE_URI . '/assets/js/admin-upload.js',
		array( 'jquery' ),
		SWE_CLONE_VERSION,
		true
	);
}
add_action( 'admin_enqueue_scripts', 'swe_clone_admin_assets' );

/**
 * Admin list column: thumbnail.
 *
 * @param array $columns Columns.
 */
function swe_clone_hero_columns( $columns ) {
	$new = array();
	foreach ( $columns as $key => $label ) {
		$new[ $key ] = $label;
		if ( 'title' === $key ) {
			$new['thumb'] = __( 'Ảnh', 'swe-clone' );
		}
	}
	return $new;
}
add_filter( 'manage_swe_hero_posts_columns', 'swe_clone_hero_columns' );

/**
 * Render thumb column.
 *
 * @param string $column Column.
 * @param int    $post_id Post ID.
 */
function swe_clone_hero_column_content( $column, $post_id ) {
	if ( 'thumb' === $column && has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail( $post_id, array( 80, 50 ) );
	}
}
add_action( 'manage_swe_hero_posts_custom_column', 'swe_clone_hero_column_content', 10, 2 );
