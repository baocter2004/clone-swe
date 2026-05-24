<?php
/**
 * Fallback template.
 *
 * @package Swe_Clone
 */

get_header();
?>

<div class="swe-container swe-page">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'swe-post' ); ?>>
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<?php the_excerpt(); ?>
			</article>
		<?php endwhile; ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Không có nội dung.', 'swe-clone' ); ?></p>
	<?php endif; ?>
</div>

<?php
get_footer();
