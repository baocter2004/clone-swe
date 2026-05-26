<?php
/**
 * Tự seed lần đầu (gọi seeder chính).
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

/**
 * Seed lần đầu khi vào admin.
 */
function swe_clone_maybe_seed_on_admin() {
	if ( get_option( 'swe_clone_demo_seeded' ) ) {
		return;
	}
	if ( ! class_exists( 'WooCommerce' ) || ! function_exists( 'swe_clone_run_seeder' ) ) {
		return;
	}

	swe_clone_run_seeder( false );
}
add_action( 'admin_init', 'swe_clone_maybe_seed_on_admin', 5 );
