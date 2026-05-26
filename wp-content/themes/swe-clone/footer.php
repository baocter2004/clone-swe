<?php
/**
 * Site footer.
 *
 * @package Swe_Clone
 */

defined( 'ABSPATH' ) || exit;
?>
	</main>

	<footer class="swe-footer">
		<div class="swe-container">
			<h2 class="swe-footer__brand-heading">THƯƠNG HIỆU</h2>
			<div class="swe-footer__grid">
				<div class="swe-footer__col">
					<h4>ABOUT US</h4>
					<p>Được thành lập vào cuối năm 2016 trong bối cảnh thời trang streetstyle dần nhen nhóm vào thị trường Việt Nam. SWE - Street Wear Eazy với slogan <em>Young kids with a mission™</em> đã chiếm được tình cảm của các bạn trẻ yêu mến thời trang đường phố.</p>
				</div>
				<div class="swe-footer__col">
					<h4>CHÍNH SÁCH</h4>
					<ul>
						<li><a href="#">Hướng dẫn mua hàng</a></li>
						<li><a href="#">Chính sách đổi &amp; bảo hành sản phẩm</a></li>
						<li><a href="#">Chính sách giao nhận - vận chuyển</a></li>
						<li><a href="#">Chính sách Membership</a></li>
						<li><a href="#">Hướng dẫn giặt ủi &amp; bảo quản sản phẩm</a></li>
					</ul>
				</div>
				<div class="swe-footer__col">
					<h4>HỆ THỐNG CỬA HÀNG SWE</h4>
					<ul class="swe-footer__stores">
						<li>44A Trần Quang Diệu, Phường Nhiêu Lộc, TP.HCM</li>
						<li>TNP, 26 Lý Tự Trọng, Phường Sài Gòn, TP.HCM</li>
						<li>Store 29-30 TNP, Tầng B1, Vincom Center Đồng Khởi, TP.HCM</li>
						<li>TRC, 180 Đê La Thành, Hà Nội</li>
					</ul>
					<p><a href="tel:0357420420">0357 420 420</a> · <a href="mailto:streetweareazy@gmail.com">streetweareazy@gmail.com</a></p>
				</div>
				<div class="swe-footer__col">
					<h4>FANPAGE</h4>
					<p class="swe-footer__fanpage">SWE — clone demo cho đồ án</p>
				</div>
			</div>
		</div>
		<div class="swe-footer__bottom">
			<p>Copyright © <?php echo esc_html( gmdate( 'Y' ) ); ?> SWE. Clone demo — WordPress theme <code>swe-clone</code></p>
		</div>
	</footer>

	<aside class="swe-cart-drawer" id="swe-cart-drawer" aria-hidden="true">
		<div class="swe-cart-drawer__panel">
			<div class="swe-cart-drawer__head">
				<h3>Giỏ hàng</h3>
				<button type="button" id="swe-cart-close" aria-label="<? esc_attr_e( 'Đóng', 'swe-clone' ); ?>">&times;</button>
			</div>
			<div class="swe-mini-cart">
				<?php
				if ( swe_clone_is_woo() ) {
					woocommerce_mini_cart();
				} else {
					echo '<p class="swe-cart-drawer__empty">' . esc_html__( 'Cài WooCommerce để dùng giỏ hàng.', 'swe-clone' ) . '</p>';
				}
				?>
			</div>
			<?php if ( swe_clone_is_woo() ) : ?>
			<div class="swe-cart-drawer__footer">
				<p><strong><?php esc_html_e( 'TỔNG TIỀN:', 'swe-clone' ); ?></strong> <?php wc_cart_totals_subtotal_html(); ?></p>
				<div class="swe-cart-drawer__actions">
					<a href="<?php echo esc_url( swe_clone_cart_url() ); ?>" class="swe-btn swe-btn--outline"><?php esc_html_e( 'Xem giỏ hàng', 'swe-clone' ); ?></a>
					<a href="<?php echo esc_url( swe_clone_checkout_url() ); ?>" class="swe-btn"><?php esc_html_e( 'Thanh toán', 'swe-clone' ); ?></a>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</aside>
</div>

<?php wp_footer(); ?>
</body>
</html>
