<?php
/**
 * Page template — giỏ hàng, thanh toán, tài khoản.
 *
 * @package Swe_Clone
 */

get_header();
?>

<div class="swe-container swe-page swe-page--wc">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class(); ?>>
			<?php if ( ! is_cart() && ! is_checkout() && ! is_account_page() ) : ?>
				<h1 class="swe-section-title"><?php the_title(); ?></h1>
			<?php endif; ?>
			<div class="swe-page__content">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
</div>

<?php
get_footer();
