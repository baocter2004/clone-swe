<?php
/**
 * Nội dung trang chi tiết sản phẩm.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product = wc_get_product( get_the_ID() );

if ( ! $product || ! $product->is_visible() ) {
	return;
}

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'swe-single-product', $product ); ?>>
	<div class="swe-container">
		<?php woocommerce_output_all_notices(); ?>

		<div class="swe-single-product__grid">
			<div class="swe-single-product__gallery">
				<?php woocommerce_show_product_images(); ?>
			</div>

			<div class="swe-single-product__summary summary entry-summary">
				<?php
				woocommerce_template_single_title();
				woocommerce_template_single_price();

				if ( $product->get_short_description() ) {
					woocommerce_template_single_excerpt();
				}

				woocommerce_template_single_add_to_cart();
				woocommerce_template_single_meta();
				?>
			</div>
		</div>

		<?php if ( $product->get_description() ) : ?>
			<section class="swe-single-product__description">
				<h2 class="swe-single-product__section-title"><?php esc_html_e( 'Mô tả sản phẩm', 'swe-clone' ); ?></h2>
				<div class="swe-single-product__description-content entry-content">
					<?php the_content(); ?>
				</div>
			</section>
		<?php endif; ?>

		<section class="swe-single-product__related">
			<?php woocommerce_output_related_products(); ?>
		</section>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
