<?php
/**
 * Homepage — clone layout swe.vn.
 *
 * @package Swe_Clone
 */

get_header();

$slides     = swe_clone_hero_slides();
$categories = swe_clone_categories();
$products   = swe_clone_products();
$services   = swe_clone_services();
?>

<section class="swe-hero" aria-label="<? esc_attr_e( 'Banner', 'swe-clone' ); ?>">
	<div class="swe-hero__slider" id="swe-hero-slider">
		<?php foreach ( $slides as $index => $slide ) : ?>
			<div class="swe-hero__slide<?php echo 0 === $index ? ' is-active' : ''; ?>">
				<a href="<?php echo esc_url( $slide['url'] ); ?>">
					<picture>
						<source media="(max-width: 767px)" srcset="<?php echo esc_url( $slide['image_mobile'] ); ?>">
						<img src="<?php echo esc_url( $slide['image'] ); ?>" alt="" loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>">
					</picture>
				</a>
			</div>
		<?php endforeach; ?>
		<div class="swe-hero__dots" id="swe-hero-dots"></div>
	</div>
</section>

<section class="swe-categories" aria-label="<? esc_attr_e( 'Danh mục', 'swe-clone' ); ?>">
	<div class="swe-container swe-categories__grid">
		<?php foreach ( $categories as $cat ) : ?>
			<a href="<?php echo esc_url( $cat['url'] ); ?>" class="swe-categories__item">
				<img src="<?php echo esc_url( $cat['image'] ); ?>" alt="<?php echo esc_attr( $cat['label'] ); ?>" loading="lazy">
			</a>
		<?php endforeach; ?>
	</div>
</section>

<section class="swe-products-section">
	<div class="swe-container">
		<h2 class="swe-section-title">
			<a href="<?php echo esc_url( home_url( '/collections/tops/' ) ); ?>">TẤT CẢ SẢN PHẨM</a>
		</h2>
	</div>
	<div class="swe-container">
		<div class="swe-products-grid">
			<?php
			foreach ( $products as $product ) {
				get_template_part( 'template-parts/product', 'card', array( 'product' => $product ) );
			}
			?>
		</div>
	</div>
</section>

<section class="swe-services" aria-label="<? esc_attr_e( 'Dịch vụ', 'swe-clone' ); ?>">
	<div class="swe-container swe-services__grid">
		<?php foreach ( $services as $service ) : ?>
			<div class="swe-services__item">
				<img src="<?php echo esc_url( $service['icon'] ); ?>" alt="" width="48" height="48" loading="lazy">
				<div>
					<p class="swe-services__title"><?php echo esc_html( $service['title'] ); ?></p>
					<p class="swe-services__desc"><?php echo esc_html( $service['desc'] ); ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<section class="swe-feedback">
	<div class="swe-container">
		<h2 class="swe-section-title">SWE® FEEDBACK</h2>
		<div class="swe-feedback__grid">
			<?php
			$feedback_imgs = array(
				'https://cdn.hstatic.net/themes/200001108416/1001438792/14/imgaView1.jpg?v=56',
				'https://cdn.hstatic.net/themes/200001108416/1001438792/14/imgaView2.jpg?v=56',
				'https://cdn.hstatic.net/themes/200001108416/1001438792/14/imgaView3.jpg?v=56',
			);
			foreach ( $feedback_imgs as $img ) :
				?>
				<a href="#" class="swe-feedback__item">
					<img src="<?php echo esc_url( $img ); ?>" alt="Feedback" loading="lazy">
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_footer();
