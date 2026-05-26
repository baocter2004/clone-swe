<?php
/**
 * Plugin Name: SWE Activate WooCommerce (one-time helper)
 * Description: Tự kích hoạt WooCommerce khi plugin đã cài. Xóa file này sau khi site chạy ổn.
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'admin_init',
	static function () {
		if ( ! is_admin() || ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$plugin = 'woocommerce/woocommerce.php';
		if ( ! file_exists( WP_PLUGIN_DIR . '/' . $plugin ) ) {
			return;
		}

		if ( is_plugin_active( $plugin ) ) {
			return;
		}

		activate_plugin( $plugin );
	}
);
