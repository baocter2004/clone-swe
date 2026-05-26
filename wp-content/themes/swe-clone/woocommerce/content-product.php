<?php
/**
 * Product loop card.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	<?php get_template_part( 'template-parts/product', 'card', array( 'wc_product' => $product ) ); ?>
</li>
