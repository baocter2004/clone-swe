<?php
/**
 * SWE Clone theme functions.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

define( 'SWE_CLONE_VERSION', '1.1.1' );
define( 'SWE_CLONE_DIR', get_template_directory() );
define( 'SWE_CLONE_URI', get_template_directory_uri() );

require_once SWE_CLONE_DIR . '/inc/data.php';
require_once SWE_CLONE_DIR . '/inc/cpt.php';
require_once SWE_CLONE_DIR . '/inc/meta-boxes.php';
require_once SWE_CLONE_DIR . '/inc/queries.php';

require_once SWE_CLONE_DIR . '/inc/seeder.php';
require_once SWE_CLONE_DIR . '/inc/woocommerce.php';
require_once SWE_CLONE_DIR . '/inc/woocommerce-seed.php';
require_once SWE_CLONE_DIR . '/inc/woocommerce-setup.php';

/**
 * Theme setup.
 */
function swe_clone_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	register_nav_menus(
		array(
			'primary' => __( 'Menu chính', 'swe-clone' ),
		)
	);
}
add_action( 'after_setup_theme', 'swe_clone_setup' );

/**
 * Flush rewrite rules khi kích hoạt theme (CPT hiện trong Admin).
 */
function swe_clone_theme_activation() {
	swe_clone_register_cpts();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'swe_clone_theme_activation' );

/**
 * Enqueue styles & scripts.
 */
function swe_clone_assets() {
	wp_enqueue_style(
		'swe-clone-fonts',
		'https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'swe-clone-main',
		SWE_CLONE_URI . '/assets/css/main.css',
		array( 'swe-clone-fonts' ),
		SWE_CLONE_VERSION
	);

	if ( swe_clone_is_woo() ) {
		wp_enqueue_style(
			'swe-clone-woo',
			SWE_CLONE_URI . '/assets/css/woocommerce.css',
			array( 'swe-clone-main' ),
			SWE_CLONE_VERSION
		);
	}

	$script_deps = swe_clone_is_woo() ? array( 'jquery' ) : array();

	wp_enqueue_script(
		'swe-clone-main',
		SWE_CLONE_URI . '/assets/js/main.js',
		$script_deps,
		SWE_CLONE_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'swe_clone_assets' );

/**
 * Format price VND.
 *
 * @param int $amount Amount in VND.
 */
function swe_clone_price( $amount ) {
	return number_format( (int) $amount, 0, ',', '.' ) . '₫';
}
