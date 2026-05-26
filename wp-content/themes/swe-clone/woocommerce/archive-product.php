<?php
/**
 * Shop / category archive.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Hook: woocommerce_before_main_content.
 */
do_action( 'woocommerce_before_main_content' );
?>

<header class="swe-shop-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="swe-section-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php do_action( 'woocommerce_archive_description' ); ?>
</header>

<?php
if ( woocommerce_product_loop() ) {
	do_action( 'woocommerce_before_shop_loop' );
	?>
	<ul class="swe-products-grid swe-products-grid--shop products">
		<?php
		while ( have_posts() ) {
			the_post();
			wc_get_template_part( 'content', 'product' );
		}
		?>
	</ul>
	<?php
	do_action( 'woocommerce_after_shop_loop' );
} else {
	do_action( 'woocommerce_no_products_found' );
}

do_action( 'woocommerce_after_main_content' );

get_footer();
