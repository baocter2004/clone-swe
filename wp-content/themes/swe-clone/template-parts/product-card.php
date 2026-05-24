<?php
/**
 * Product card — tái sử dụng trên homepage & archive.
 *
 * @package Swe_Clone
 *
 * @var array $args['product'] Product data.
 */

defined( 'ABSPATH' ) || exit;

$product = $args['product'] ?? array();
if ( empty( $product['title'] ) ) {
	return;
}

$url   = home_url( '/products/' . ( $product['slug'] ?? '' ) . '/' );
$hover = ! empty( $product['image_hover'] ) ? $product['image_hover'] : $product['image'];
?>
<article class="swe-product-card">
	<div class="swe-product-card__media">
		<a href="<?php echo esc_url( $url ); ?>" class="swe-product-card__link">
			<img src="<?php echo esc_url( $product['image'] ); ?>" alt="<?php echo esc_attr( $product['title'] ); ?>" loading="lazy" class="swe-product-card__img swe-product-card__img--primary">
			<?php if ( $hover !== $product['image'] ) : ?>
				<img src="<?php echo esc_url( $hover ); ?>" alt="" loading="lazy" class="swe-product-card__img swe-product-card__img--hover" aria-hidden="true">
			<?php endif; ?>
		</a>
		<span class="swe-product-card__price-mobile"><?php echo esc_html( swe_clone_price( $product['price'] ) ); ?></span>
		<button type="button" class="swe-product-card__buy" data-product="<?php echo esc_attr( $product['title'] ); ?>">
			Mua ngay →
		</button>
	</div>
	<div class="swe-product-card__body">
		<h3 class="swe-product-card__title">
			<a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $product['title'] ); ?></a>
		</h3>
		<p class="swe-product-card__price"><?php echo esc_html( swe_clone_price( $product['price'] ) ); ?></p>
	</div>
</article>
