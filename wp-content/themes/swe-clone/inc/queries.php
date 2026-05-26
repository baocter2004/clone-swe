<?php
/**
 * Lấy dữ liệu từ CPT (ưu tiên) hoặc fallback data.php.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hero slides từ Admin.
 *
 * @return array<int, array{url: string, image: string, image_mobile: string}>
 */
function swe_clone_get_hero_slides() {
	$posts = get_posts(
		array(
			'post_type'      => 'swe_hero',
			'post_status'    => 'publish',
			'posts_per_page' => 20,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		)
	);

	if ( empty( $posts ) ) {
		return swe_clone_hero_slides();
	}

	$slides = array();
	foreach ( $posts as $post ) {
		$desktop_id = get_post_thumbnail_id( $post->ID );
		if ( ! $desktop_id ) {
			continue;
		}

		$mobile_id = (int) get_post_meta( $post->ID, '_swe_slide_mobile_id', true );
		$desktop   = wp_get_attachment_image_url( $desktop_id, 'full' );
		$mobile    = $mobile_id ? wp_get_attachment_image_url( $mobile_id, 'full' ) : $desktop;

		$slides[] = array(
			'url'          => get_post_meta( $post->ID, '_swe_slide_url', true ) ?: '#',
			'image'        => $desktop,
			'image_mobile' => $mobile,
		);
	}

	return ! empty( $slides ) ? $slides : swe_clone_hero_slides();
}

/**
 * Category banners từ Admin.
 *
 * @return array<int, array{label: string, url: string, image: string}>
 */
function swe_clone_get_categories() {
	$posts = get_posts(
		array(
			'post_type'      => 'swe_category',
			'post_status'    => 'publish',
			'posts_per_page' => 8,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		)
	);

	if ( empty( $posts ) ) {
		return swe_clone_categories();
	}

	$items = array();
	foreach ( $posts as $post ) {
		$thumb = get_post_thumbnail_id( $post->ID );
		if ( ! $thumb ) {
			continue;
		}

		$items[] = array(
			'label' => get_the_title( $post ),
			'url'   => get_post_meta( $post->ID, '_swe_category_url', true ) ?: '#',
			'image' => wp_get_attachment_image_url( $thumb, 'large' ),
		);
	}

	return ! empty( $items ) ? $items : swe_clone_categories();
}

/**
 * Feedback images từ Admin.
 *
 * @return array<int, array{url: string, image: string}>
 */
function swe_clone_get_feedback() {
	$posts = get_posts(
		array(
			'post_type'      => 'swe_feedback',
			'post_status'    => 'publish',
			'posts_per_page' => 12,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		)
	);

	if ( empty( $posts ) ) {
		return array(
			array(
				'url'   => '#',
				'image' => 'https://cdn.hstatic.net/themes/200001108416/1001438792/14/imgaView1.jpg?v=56',
			),
			array(
				'url'   => '#',
				'image' => 'https://cdn.hstatic.net/themes/200001108416/1001438792/14/imgaView2.jpg?v=56',
			),
			array(
				'url'   => '#',
				'image' => 'https://cdn.hstatic.net/themes/200001108416/1001438792/14/imgaView3.jpg?v=56',
			),
		);
	}

	$items = array();
	foreach ( $posts as $post ) {
		$thumb = get_post_thumbnail_id( $post->ID );
		if ( ! $thumb ) {
			continue;
		}

		$items[] = array(
			'url'   => get_post_meta( $post->ID, '_swe_feedback_url', true ) ?: '#',
			'image' => wp_get_attachment_image_url( $thumb, 'large' ),
		);
	}

	return $items;
}

/**
 * Sản phẩm trang chủ — WooCommerce hoặc demo.
 *
 * @return array<int, WC_Product|array>
 */
function swe_clone_get_home_products() {
	if ( swe_clone_is_woo() ) {
		return wc_get_products(
			array(
				'limit'   => 8,
				'status'  => 'publish',
				'orderby' => 'date',
				'order'   => 'DESC',
			)
		);
	}

	return swe_clone_products();
}
