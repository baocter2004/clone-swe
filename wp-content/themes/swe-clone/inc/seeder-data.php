<?php
/**
 * Dữ liệu mẫu dự án SWE — giống swe.vn.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

/**
 * Danh mục sản phẩm WooCommerce.
 *
 * @return array<string, array{slug: string, name: string, description: string}>
 */
function swe_seed_product_categories() {
	return array(
		'new-arrivals' => array(
			'slug'        => 'new-arrivals',
			'name'        => 'new arrivals',
			'description' => 'Sản phẩm mới về',
		),
		'tops'         => array(
			'slug'        => 'tops',
			'name'        => 'tops',
			'description' => 'Áo thun, áo dài tay',
		),
		'bottoms'      => array(
			'slug'        => 'bottoms',
			'name'        => 'bottoms',
			'description' => 'Quần, váy',
		),
		'outerwear'    => array(
			'slug'        => 'outerwear',
			'name'        => 'outerwear',
			'description' => 'Áo khoác, sơ mi',
		),
		'accessories'  => array(
			'slug'        => 'accessories',
			'name'        => 'accessories',
			'description' => 'Phụ kiện',
		),
		'womens'       => array(
			'slug'        => 'womens',
			'name'        => 'womens',
			'description' => 'Dòng nữ',
		),
		'sale'         => array(
			'slug'        => 'sale',
			'name'        => 'sale',
			'description' => 'Giảm giá',
		),
	);
}

/**
 * Sản phẩm demo (ảnh từ CDN SWE công khai).
 *
 * @return array<int, array<string, mixed>>
 */
function swe_seed_products() {
	$p = 'https://cdn.hstatic.net/products/200001108416';

	return array(
		array(
			'name'        => 'SWE PASSION L/S TEE - WHITE',
			'slug'        => 'swe-passion-l-s-tee-white',
			'price'       => 575000,
			'sale_price'  => 0,
			'categories'  => array( 'tops', 'new-arrivals' ),
			'image'       => $p . '/1_fb8763e5d7ce41d5a70ae2681b702c07_large.jpg',
			'gallery'     => array( $p . '/2_fb8763e5d7ce41d5a70ae2681b702c07_large.jpg' ),
			'short'       => 'Boxy fit · Cotton 100% · Unisex',
			'description' => '<p>SWE PASSION L/S TEE phiên bản trắng — form boxy streetwear, phù hợp layer hoặc mặc riêng.</p><p><strong>Young kids with a mission™</strong></p>',
			'sizes'       => array( 'S', 'M', 'L', 'XL' ),
			'stock'       => 30,
		),
		array(
			'name'        => 'SWE STARFALL BOXY L/S TEE - BROWN/CREAM',
			'slug'        => 'swe-starfall-boxy-l-s-tee-brown-cream',
			'price'       => 575000,
			'categories'  => array( 'tops', 'new-arrivals' ),
			'image'       => $p . '/1_0a8c8f8e8c8f4e8c8f8e8c8f8e8c8f8e_large.jpg',
			'short'       => 'Starfall graphic · Long sleeve',
			'description' => '<p>Họa tiết Starfall nổi bật, tone brown/cream.</p>',
			'sizes'       => array( 'S', 'M', 'L', 'XL' ),
			'stock'       => 25,
		),
		array(
			'name'        => 'SWE STARFALL BOXY L/S TEE - NAVY/CREAM',
			'slug'        => 'swe-starfall-boxy-l-s-tee-navy-cream',
			'price'       => 575000,
			'categories'  => array( 'tops' ),
			'image'       => $p . '/1_fb8763e5d7ce41d5a70ae2681b702c07_large.jpg',
			'short'       => 'Navy/Cream colorway',
			'description' => '<p>Starfall boxy tee — navy/cream.</p>',
			'sizes'       => array( 'S', 'M', 'L', 'XL' ),
			'stock'       => 40,
		),
		array(
			'name'        => 'SWE STARFALL BOXY L/S TEE - GRAY/WHITE',
			'slug'        => 'swe-starfall-boxy-l-s-tee-gray-white',
			'price'       => 575000,
			'categories'  => array( 'tops' ),
			'image'       => $p . '/1_fb8763e5d7ce41d5a70ae2681b702c07_large.jpg',
			'short'       => 'Gray/White colorway',
			'description' => '<p>Starfall boxy tee — gray/white.</p>',
			'sizes'       => array( 'S', 'M', 'L' ),
			'stock'       => 20,
		),
		array(
			'name'        => 'SWE STARFALL BOXY L/S TEE - BLACK/WHITE',
			'slug'        => 'swe-starfall-boxy-l-s-tee-black-white',
			'price'       => 575000,
			'categories'  => array( 'tops', 'new-arrivals' ),
			'image'       => $p . '/1_fb8763e5d7ce41d5a70ae2681b702c07_large.jpg',
			'short'       => 'Black/White colorway',
			'description' => '<p>Starfall boxy tee — black/white.</p>',
			'sizes'       => array( 'M', 'L', 'XL' ),
			'stock'       => 35,
		),
		array(
			'name'        => 'SWE LILY BABY TEE - YELLOW',
			'slug'        => 'swe-lily-baby-tee-yellow',
			'price'       => 345000,
			'categories'  => array( 'tops', 'womens' ),
			'image'       => $p . '/1_fb8763e5d7ce41d5a70ae2681b702c07_large.jpg',
			'short'       => 'Baby tee fit · Yellow',
			'description' => '<p>Lily baby tee — form crop nhẹ, màu vàng.</p>',
			'sizes'       => array( 'S', 'M', 'L' ),
			'stock'       => 50,
		),
		array(
			'name'        => 'SWE CULTURE BOXY TEE - WHITE',
			'slug'        => 'swe-culture-boxy-tee-white',
			'price'       => 475000,
			'categories'  => array( 'tops' ),
			'image'       => $p . '/1_fb8763e5d7ce41d5a70ae2681b702c07_large.jpg',
			'short'       => 'Culture graphic · Boxy white',
			'description' => '<p>SWE Culture boxy tee trắng.</p>',
			'sizes'       => array( 'S', 'M', 'L', 'XL' ),
			'stock'       => 45,
		),
		array(
			'name'        => 'SWE WESTFIELD PLAID SHIRT - BROWN',
			'slug'        => 'swe-westfield-plaid-shirt-brown',
			'price'       => 675000,
			'categories'  => array( 'outerwear', 'new-arrivals' ),
			'image'       => $p . '/1_5ac218efdaed4557b38f09b9c0f0ed56_612c975514d74e529528749cef65537a_large.jpg',
			'gallery'     => array( $p . '/2_3e0db13fc1ac4a8eb3e10df3c6611e82_63fabc43558e498ea31a0d2f39110f2b_large.jpg' ),
			'short'       => 'Plaid shirt · Brown',
			'description' => '<p>Sơ mi kẻ caro Westfield — outerwear layer.</p>',
			'sizes'       => array( 'S', 'M', 'L', 'XL' ),
			'stock'       => 18,
		),
		array(
			'name'        => 'SWE ESSENTIAL CAP - BLACK',
			'slug'        => 'swe-essential-cap-black',
			'price'       => 295000,
			'categories'  => array( 'accessories' ),
			'image'       => $p . '/1_fb8763e5d7ce41d5a70ae2681b702c07_large.jpg',
			'short'       => 'Logo cap · Black',
			'description' => '<p>Nón SWE Essential — phụ kiện daily.</p>',
			'sizes'       => array(),
			'stock'       => 60,
		),
		array(
			'name'        => 'SWE CLASSIC TOTE - NATURAL',
			'slug'        => 'swe-classic-tote-natural',
			'price'       => 225000,
			'sale_price'  => 199000,
			'categories'  => array( 'accessories', 'sale' ),
			'image'       => $p . '/1_fb8763e5d7ce41d5a70ae2681b702c07_large.jpg',
			'short'       => 'Tote bag · Sale',
			'description' => '<p>Túi tote canvas SWE.</p>',
			'sizes'       => array(),
			'stock'       => 40,
		),
	);
}

/**
 * Banner hero.
 *
 * @return array<int, array<string, string>>
 */
function swe_seed_heroes() {
	$t = 'https://cdn.hstatic.net/themes/200001108416/1001438792/14';
	return array(
		array(
			'title'  => 'Summer Collection 2025',
			'url'    => '/shop/',
			'image'  => $t . '/slideshow_1.jpg?v=56',
			'mobile' => $t . '/slideshow_mb_1.jpg?v=56',
		),
		array(
			'title'  => 'Summer Collection',
			'url'    => '/product-category/new-arrivals/',
			'image'  => $t . '/slideshow_2.jpg?v=56',
			'mobile' => $t . '/slideshow_mb_2.jpg?v=56',
		),
	);
}

/**
 * Ảnh danh mục trang chủ.
 *
 * @return array<int, array<string, string>>
 */
function swe_seed_category_banners() {
	$f = 'https://cdn.hstatic.net/files/200001108416/file';
	return array(
		array( 'title' => 'TOP', 'url' => '/product-category/tops/', 'image' => $f . '/1.png' ),
		array( 'title' => 'BOTTOM', 'url' => '/product-category/bottoms/', 'image' => $f . '/3.png' ),
		array( 'title' => 'OUTERWEAR', 'url' => '/product-category/outerwear/', 'image' => $f . '/4.png' ),
		array( 'title' => 'ACCESSORIES', 'url' => '/product-category/accessories/', 'image' => $f . '/2.png' ),
	);
}

/**
 * Feedback images.
 *
 * @return array<int, array<string, string>>
 */
function swe_seed_feedback() {
	$t = 'https://cdn.hstatic.net/themes/200001108416/1001438792/14';
	return array(
		array( 'title' => 'Feedback 1', 'url' => '/shop/', 'image' => $t . '/imgaView1.jpg?v=56' ),
		array( 'title' => 'Feedback 2', 'url' => '/shop/', 'image' => $t . '/imgaView2.jpg?v=56' ),
		array( 'title' => 'Feedback 3', 'url' => '/shop/', 'image' => $t . '/imgaView3.jpg?v=56' ),
	);
}
