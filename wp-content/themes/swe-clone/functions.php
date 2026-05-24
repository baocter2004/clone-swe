<?php
/**
 * SWE Clone theme functions.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

define( 'SWE_CLONE_VERSION', '1.0.0' );
define( 'SWE_CLONE_DIR', get_template_directory() );
define( 'SWE_CLONE_URI', get_template_directory_uri() );

require_once SWE_CLONE_DIR . '/inc/data.php';

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

	wp_enqueue_script(
		'swe-clone-main',
		SWE_CLONE_URI . '/assets/js/main.js',
		array(),
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
