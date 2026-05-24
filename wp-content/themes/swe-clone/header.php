<?php
/**
 * Site header.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;

$nav_items = swe_clone_nav_items();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'swe-body' ); ?>>
<?php wp_body_open(); ?>

<div class="swe-layout">
	<header class="swe-header" id="site-header">
		<div class="swe-topbar">
			<div class="swe-container">
				<p>Miễn phí vận chuyển với mọi đơn hàng.</p>
			</div>
		</div>

		<div class="swe-header__middle">
			<div class="swe-container swe-header__row">
				<button type="button" class="swe-header__menu-btn" id="swe-menu-toggle" aria-label="<? esc_attr_e( 'Mở menu', 'swe-clone' ); ?>" aria-expanded="false">
					<span class="swe-hamburger"><span></span></span>
				</button>

				<div class="swe-header__logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="SWE">
						<span class="swe-logo-text">SWE</span>
					</a>
				</div>

				<form class="swe-header__search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label class="screen-reader-text" for="swe-search"><? esc_html_e( 'Tìm kiếm', 'swe-clone' ); ?></label>
					<input type="search" id="swe-search" name="s" placeholder="Tìm kiếm sản phẩm..." value="<?php echo get_search_query(); ?>">
					<button type="submit" aria-label="<? esc_attr_e( 'Tìm kiếm', 'swe-clone' ); ?>">
						<svg width="20" height="20" viewBox="0 0 24 27" aria-hidden="true"><path d="M10,2C4.5,2,0,6.5,0,12s4.5,10,10,10s10-4.5,10-10S15.5,2,10,2z M10,19c-3.9,0-7-3.1-7-7s3.1-7,7-7s7,3.1,7,7S13.9,19,10,19z"/><rect x="17" y="17" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -9.2844 19.5856)" width="4" height="8"/></svg>
					</button>
				</form>

				<div class="swe-header__actions">
					<button type="button" class="swe-header__icon" id="swe-account-toggle" aria-label="<? esc_attr_e( 'Tài khoản', 'swe-clone' ); ?>">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6"/></svg>
					</button>
					<button type="button" class="swe-header__icon swe-header__cart" id="swe-cart-toggle" aria-label="<? esc_attr_e( 'Giỏ hàng', 'swe-clone' ); ?>">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M6 6h15l-1.5 9h-12z"/><circle cx="9" cy="20" r="1"/><circle cx="18" cy="20" r="1"/><path d="M6 6L5 3H2"/></svg>
						<span class="swe-header__cart-count">0</span>
					</button>
				</div>
			</div>
		</div>

		<nav class="swe-header__nav" aria-label="<? esc_attr_e( 'Menu chính', 'swe-clone' ); ?>">
			<div class="swe-container">
				<ul class="swe-nav-list">
					<?php foreach ( $nav_items as $item ) : ?>
						<li><a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</nav>

		<div class="swe-mobile-drawer" id="swe-mobile-drawer" hidden>
			<nav aria-label="<? esc_attr_e( 'Menu di động', 'swe-clone' ); ?>">
				<ul>
					<?php foreach ( $nav_items as $item ) : ?>
						<li><a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
				<div class="swe-mobile-drawer__contact">
					<p>Liên hệ với chúng tôi</p>
					<a href="tel:0357420420">0357 420 420</a>
					<a href="mailto:streetweareazy@gmail.com">streetweareazy@gmail.com</a>
				</div>
			</nav>
		</div>
	</header>

	<main class="swe-main" id="main-content">
