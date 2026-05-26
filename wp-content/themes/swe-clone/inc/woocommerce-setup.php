<?php
/**
 * Thiết lập WooCommerce pages, COD, VND, flush permalink.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

/**
 * One-time setup sau khi WooCommerce active.
 */
function swe_clone_woocommerce_install() {
	if ( ! swe_clone_is_woo() ) {
		return;
	}

	if ( get_option( 'swe_clone_wc_configured' ) ) {
		return;
	}

	update_option( 'woocommerce_currency', 'VND' );
	update_option( 'woocommerce_currency_pos', 'right_space' );
	update_option( 'woocommerce_price_thousand_sep', '.' );
	update_option( 'woocommerce_price_decimal_sep', ',' );
	update_option( 'woocommerce_price_num_decimals', '0' );

	// COD — thanh toán khi nhận hàng.
	update_option(
		'woocommerce_cod_settings',
		array(
			'enabled'      => 'yes',
			'title'        => 'Thanh toán khi nhận hàng (COD)',
			'description'  => 'Thanh toán bằng tiền mặt khi nhận hàng.',
			'instructions' => 'Vui lòng chuẩn bị đúng số tiền khi nhận hàng.',
			'enable_for_methods' => array(),
			'enable_for_virtual' => 'no',
		)
	);

	// Chuyển khoản ngân hàng.
	update_option(
		'woocommerce_bacs_settings',
		array(
			'enabled'      => 'yes',
			'title'        => 'Chuyển khoản ngân hàng',
			'description'  => 'Chuyển khoản theo thông tin bên dưới. Ghi rõ mã đơn hàng.',
			'instructions' => "Ngân hàng: ...\nSTK: ...\nChủ TK: SWE",
		)
	);

	if ( function_exists( 'wc_create_pages' ) ) {
		wc_create_pages();
	}

	flush_rewrite_rules();
	update_option( 'swe_clone_wc_configured', 1 );
}
add_action( 'admin_init', 'swe_clone_woocommerce_install' );

/**
 * Breadcrumb trên trang SP.
 */
function swe_clone_woo_breadcrumb() {
	if ( ! is_product() && ! is_product_taxonomy() && ! is_shop() ) {
		return;
	}

	echo '<div class="swe-container">';
	woocommerce_breadcrumb(
		array(
			'delimiter'   => ' / ',
			'wrap_before' => '<nav class="swe-breadcrumb woocommerce-breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'swe-clone' ) . '">',
			'wrap_after'  => '</nav>',
		)
	);
	echo '</div>';
}
add_action( 'woocommerce_before_main_content', 'swe_clone_woo_breadcrumb', 15 );
