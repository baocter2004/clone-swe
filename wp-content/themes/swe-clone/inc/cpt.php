<?php
/**
 * Custom Post Types — khách hàng tự upload ảnh trong WP Admin.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register content types.
 */
function swe_clone_register_cpts() {
	register_post_type(
		'swe_hero',
		array(
			'labels'       => array(
				'name'          => __( 'Banner full màn hình', 'swe-clone' ),
				'singular_name' => __( 'Banner', 'swe-clone' ),
				'add_new_item'  => __( 'Thêm banner mới', 'swe-clone' ),
				'edit_item'     => __( 'Sửa banner', 'swe-clone' ),
				'all_items'     => __( 'Banner trang chủ', 'swe-clone' ),
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-format-gallery',
			'menu_position'=> 25,
			'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
			'has_archive'  => false,
		)
	);

	register_post_type(
		'swe_category',
		array(
			'labels'       => array(
				'name'          => __( 'Ảnh danh mục', 'swe-clone' ),
				'singular_name' => __( 'Danh mục', 'swe-clone' ),
				'add_new_item'  => __( 'Thêm danh mục', 'swe-clone' ),
				'all_items'     => __( 'Ảnh danh mục (TOP, BOTTOM...)', 'swe-clone' ),
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => 'edit.php?post_type=swe_hero',
			'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
		)
	);

	register_post_type(
		'swe_feedback',
		array(
			'labels'       => array(
				'name'          => __( 'Ảnh Feedback', 'swe-clone' ),
				'singular_name' => __( 'Feedback', 'swe-clone' ),
				'add_new_item'  => __( 'Thêm ảnh feedback', 'swe-clone' ),
				'all_items'     => __( 'SWE® Feedback', 'swe-clone' ),
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => 'edit.php?post_type=swe_hero',
			'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
		)
	);
}
add_action( 'init', 'swe_clone_register_cpts' );

/**
 * Admin notice hướng dẫn upload.
 */
function swe_clone_admin_notice() {
	$screen = get_current_screen();
	if ( ! $screen || 'swe_hero' !== $screen->post_type ) {
		return;
	}

	$count = wp_count_posts( 'swe_hero' )->publish;
	if ( $count > 0 ) {
		return;
	}
	?>
	<div class="notice notice-info">
		<p>
			<strong><? esc_html_e( 'Hướng dẫn banner full màn hình:', 'swe-clone' ); ?></strong>
			<?php esc_html_e( '1) Đặt Ảnh đại diện (desktop) · 2) Chọn ảnh mobile (khung bên dưới) · 3) Nhập link · 4) Kéo thả Thứ tự ở cột phải.', 'swe-clone' ); ?>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'swe_clone_admin_notice' );
