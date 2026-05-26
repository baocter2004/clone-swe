<?php
/**
 * Homepage — clone layout swe.vn.
 *
 * @package Swe_Clone
 */

get_header();

$slides     = swe_clone_get_hero_slides();
$categories = swe_clone_get_categories();
$products   = swe_clone_get_home_products();
$services   = swe_clone_services();
$feedback   = swe_clone_get_feedback();
?>

<section class="swe-hero swe-hero--fullscreen" aria-label="<? esc_attr_e( 'Banner', 'swe-clone' ); ?>">
	<div class="swe-hero__slider" id="swe-hero-slider">
		<?php foreach ( $slides as $index => $slide ) : ?>
			<div class="swe-hero__slide<?php echo 0 === $index ? ' is-active' : ''; ?>">
				<a href="<?php echo esc_url( $slide['url'] ); ?>" class="swe-hero__link">
					<picture>
						<source media="(max-width: 767px)" srcset="<?php echo esc_url( $slide['image_mobile'] ); ?>">
						<img src="<?php echo esc_url( $slide['image'] ); ?>" alt="" loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>">
					</picture>
				</a>
			</div>
		<?php endforeach; ?>
		<?php if ( count( $slides ) > 1 ) : ?>
			<div class="swe-hero__dots" id="swe-hero-dots"></div>
		<?php endif; ?>
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
			<a href="<?php echo esc_url( swe_clone_shop_url() ); ?>">TẤT CẢ SẢN PHẨM</a>
		</h2>
	</div>
	<div class="swe-container">
		<div class="swe-products-grid">
			<?php
			foreach ( $products as $product ) {
				if ( is_object( $product ) && method_exists( $product, 'get_id' ) ) {
					get_template_part( 'template-parts/product', 'card', array( 'wc_product' => $product ) );
				} else {
					get_template_part( 'template-parts/product', 'card', array( 'product' => $product ) );
				}
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
			<?php foreach ( $feedback as $item ) : ?>
				<a href="<?php echo esc_url( $item['url'] ); ?>" class="swe-feedback__item">
					<img src="<?php echo esc_url( $item['image'] ); ?>" alt="Feedback" loading="lazy">
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_footer();
