<?php
/**
 * Sample data — sau này thay bằng WooCommerce / Custom Post Type.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

/**
 * Navigation items (giống swe.vn).
 *
 * @return array<int, array{label: string, url: string}>
 */
function swe_clone_nav_items() {
	return array(
		array( 'label' => 'new arrivals', 'url' => home_url( '/collections/new-arrivals/' ) ),
		array( 'label' => 'best-selling items', 'url' => home_url( '/collections/best-selling-items/' ) ),
		array( 'label' => 'tops', 'url' => home_url( '/collections/tops/' ) ),
		array( 'label' => 'bottoms', 'url' => home_url( '/collections/bottoms/' ) ),
		array( 'label' => 'outerwear', 'url' => home_url( '/collections/outerwear/' ) ),
		array( 'label' => 'accessories', 'url' => home_url( '/collections/accessories/' ) ),
		array( 'label' => 'womens', 'url' => home_url( '/collections/womens/' ) ),
		array( 'label' => 'sale', 'url' => home_url( '/collections/clearance-sale/' ) ),
	);
}

/**
 * Category banners.
 *
 * @return array<int, array{label: string, url: string, image: string}>
 */
function swe_clone_categories() {
	$cdn = 'https://cdn.hstatic.net/files/200001108416/file';
	return array(
		array(
			'label' => 'TOP',
			'url'   => home_url( '/collections/tops/' ),
			'image' => $cdn . '/1.png',
		),
		array(
			'label' => 'BOTTOM',
			'url'   => home_url( '/collections/bottoms/' ),
			'image' => $cdn . '/3.png',
		),
		array(
			'label' => 'OUTERWEAR',
			'url'   => home_url( '/collections/outerwear/' ),
			'image' => $cdn . '/4.png',
		),
		array(
			'label' => 'ACCESSORIES',
			'url'   => home_url( '/collections/accessories/' ),
			'image' => $cdn . '/2.png',
		),
	);
}

/**
 * Homepage products (demo).
 *
 * @return array<int, array{title: string, slug: string, price: int, image: string, image_hover: string}>
 */
function swe_clone_products() {
	$base = 'https://cdn.hstatic.net/products/200001108416';
	return array(
		array(
			'title'       => 'SWE PASSION L/S TEE - WHITE',
			'slug'        => 'swe-passion-l-s-tee-white',
			'price'       => 575000,
			'image'       => $base . '/1_fb8763e5d7ce41d5a70ae2681b702c07_large.jpg',
			'image_hover' => $base . '/2_fb8763e5d7ce41d5a70ae2681b702c07_large.jpg',
		),
		array(
			'title'       => 'SWE STARFALL BOXY L/S TEE - BROWN/CREAM',
			'slug'        => 'swe-starfall-boxy-l-s-tee-brown-cream',
			'price'       => 575000,
			'image'       => 'https://picsum.photos/seed/swe-brown/600/750',
			'image_hover' => 'https://picsum.photos/seed/swe-brown2/600/750',
		),
		array(
			'title' => 'SWE STARFALL BOXY L/S TEE - NAVY/CREAM',
			'slug'  => 'swe-starfall-boxy-l-s-tee-navy-cream',
			'price' => 575000,
			'image' => 'https://picsum.photos/seed/swe-navy/600/750',
			'image_hover' => 'https://picsum.photos/seed/swe-navy2/600/750',
		),
		array(
			'title' => 'SWE STARFALL BOXY L/S TEE - GRAY/WHITE',
			'slug'  => 'swe-starfall-boxy-l-s-tee-gray-white',
			'price' => 575000,
			'image' => 'https://picsum.photos/seed/swe-gray/600/750',
			'image_hover' => 'https://picsum.photos/seed/swe-gray2/600/750',
		),
		array(
			'title' => 'SWE STARFALL BOXY L/S TEE - BLACK/WHITE',
			'slug'  => 'swe-starfall-boxy-l-s-tee-black-white',
			'price' => 575000,
			'image' => 'https://picsum.photos/seed/swe-black/600/750',
			'image_hover' => 'https://picsum.photos/seed/swe-black2/600/750',
		),
		array(
			'title' => 'SWE LILY BABY TEE - YELLOW',
			'slug'  => 'swe-lily-baby-tee-yellow',
			'price' => 345000,
			'image' => 'https://picsum.photos/seed/swe-yellow/600/750',
			'image_hover' => '',
		),
		array(
			'title' => 'SWE CULTURE BOXY TEE - WHITE',
			'slug'  => 'swe-culture-boxy-tee-white',
			'price' => 475000,
			'image' => 'https://picsum.photos/seed/swe-culture/600/750',
			'image_hover' => '',
		),
		array(
			'title' => 'SWE WESTFIELD PLAID SHIRT - BROWN',
			'slug'  => 'swe-westfield-plaid-shirt-brown',
			'price' => 675000,
			'image' => $base . '/1_5ac218efdaed4557b38f09b9c0f0ed56_612c975514d74e529528749cef65537a_large.jpg',
			'image_hover' => $base . '/2_3e0db13fc1ac4a8eb3e10df3c6611e82_63fabc43558e498ea31a0d2f39110f2b_large.jpg',
		),
	);
}

/**
 * USP / services block.
 *
 * @return array<int, array{title: string, desc: string, icon: string}>
 */
function swe_clone_services() {
	$theme = 'https://cdn.hstatic.net/themes/200001108416/1001438792/14';
	return array(
		array(
			'title' => 'Giao hàng miễn phí',
			'desc'  => 'với mọi đơn hàng',
			'icon'  => $theme . '/vice_item_1.png?v=56',
		),
		array(
			'title' => 'Hỗ trợ 24/7',
			'desc'  => 'Hỗ trợ online / offline 24/7',
			'icon'  => $theme . '/vice_item_2.png?v=56',
		),
		array(
			'title' => 'Đổi trả linh hoạt',
			'desc'  => 'Trong vòng 5 ngày',
			'icon'  => $theme . '/vice_item_3.png?v=56',
		),
		array(
			'title' => 'Đặt hàng trực tuyến',
			'desc'  => 'Hotline: 0357 420 420',
			'icon'  => $theme . '/vice_item_4.png?v=56',
		),
	);
}

/**
 * Hero slider slides.
 *
 * @return array<int, array{url: string, image: string, image_mobile: string}>
 */
function swe_clone_hero_slides() {
	$theme = 'https://cdn.hstatic.net/themes/200001108416/1001438792/14';
	return array(
		array(
			'url'          => 'https://swe.vn/collections/summer-collection-2025',
			'image'        => $theme . '/slideshow_1.jpg?v=56',
			'image_mobile' => $theme . '/slideshow_mb_1.jpg?v=56',
		),
		array(
			'url'          => 'https://swe.vn/collections/summer-collection',
			'image'        => $theme . '/slideshow_2.jpg?v=56',
			'image_mobile' => $theme . '/slideshow_mb_2.jpg?v=56',
		),
	);
}
