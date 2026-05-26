<?php
/**
 * Product card — WooCommerce hoặc mảng demo.
 *
 * @package Swe_Clone
 *
 * @var array $args['product']    Demo array.
 * @var WC_Product $args['wc_product'] WooCommerce product.
 */

defined( 'ABSPATH' ) || exit;

if ( ! empty( $args['wc_product'] ) && $args['wc_product'] instanceof WC_Product ) {
	$wc   = $args['wc_product'];
	$url  = $wc->get_permalink();
	$img  = wp_get_attachment_image_url( $wc->get_image_id(), 'large' ) ?: wc_placeholder_img_src( 'large' );
	$gallery = $wc->get_gallery_image_ids();
	$hover = ! empty( $gallery ) ? wp_get_attachment_image_url( $gallery[0], 'large' ) : $img;
	$price_html = $wc->get_price_html();
	$title = $wc->get_name();
	$product_id = $wc->get_id();
	$is_woo = true;
} elseif ( ! empty( $args['product']['title'] ) ) {
	$item  = $args['product'];
	$url   = home_url( '/product/' . ( $item['slug'] ?? '' ) . '/' );
	$img   = $item['image'];
	$hover = ! empty( $item['image_hover'] ) ? $item['image_hover'] : $img;
	$price_html = esc_html( swe_clone_price( $item['price'] ) );
	$title = $item['title'];
	$product_id = 0;
	$is_woo = false;
} else {
	return;
}
?>
<article class="swe-product-card<?php echo $is_woo ? ' swe-product-card--woo' : ''; ?>">
	<div class="swe-product-card__media">
		<a href="<?php echo esc_url( $url ); ?>" class="swe-product-card__link">
			<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" class="swe-product-card__img swe-product-card__img--primary">
			<?php if ( $hover !== $img ) : ?>
				<img src="<?php echo esc_url( $hover ); ?>" alt="" loading="lazy" class="swe-product-card__img swe-product-card__img--hover" aria-hidden="true">
			<?php endif; ?>
		</a>
		<div class="swe-product-card__price-mobile"><?php echo $is_woo ? wp_kses_post( $price_html ) : $price_html; ?></div>
		<?php if ( $is_woo && $wc->is_purchasable() && $wc->is_in_stock() ) : ?>
			<a href="<?php echo esc_url( $wc->add_to_cart_url() ); ?>"
				class="swe-product-card__buy add_to_cart_button ajax_add_to_cart"
				data-quantity="1"
				data-product_id="<?php echo esc_attr( (string) $product_id ); ?>"
				aria-label="<?php echo esc_attr( sprintf( __( 'Thêm %s vào giỏ', 'swe-clone' ), $title ) ); ?>">
				Mua ngay →
			</a>
		<?php elseif ( ! $is_woo ) : ?>
			<a href="<?php echo esc_url( $url ); ?>" class="swe-product-card__buy">Mua ngay →</a>
		<?php endif; ?>
	</div>
	<div class="swe-product-card__body">
		<h3 class="swe-product-card__title">
			<a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></a>
		</h3>
		<p class="swe-product-card__price"><?php echo $is_woo ? wp_kses_post( $price_html ) : $price_html; ?></p>
	</div>
</article>
