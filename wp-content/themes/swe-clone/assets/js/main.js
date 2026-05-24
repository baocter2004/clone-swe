/**
 * SWE Clone — interactions nhẹ (menu, slider, cart drawer).
 */
(function () {
	'use strict';

	const menuToggle = document.getElementById('swe-menu-toggle');
	const mobileDrawer = document.getElementById('swe-mobile-drawer');
	const cartToggle = document.getElementById('swe-cart-toggle');
	const cartDrawer = document.getElementById('swe-cart-drawer');
	const cartClose = document.getElementById('swe-cart-close');
	const heroSlider = document.getElementById('swe-hero-slider');
	const heroDots = document.getElementById('swe-hero-dots');

	/* Mobile menu */
	if (menuToggle && mobileDrawer) {
		menuToggle.addEventListener('click', () => {
			const open = mobileDrawer.hasAttribute('hidden');
			if (open) {
				mobileDrawer.removeAttribute('hidden');
				menuToggle.setAttribute('aria-expanded', 'true');
			} else {
				mobileDrawer.setAttribute('hidden', '');
				menuToggle.setAttribute('aria-expanded', 'false');
			}
		});

		mobileDrawer.addEventListener('click', (e) => {
			if (e.target === mobileDrawer) {
				mobileDrawer.setAttribute('hidden', '');
				menuToggle.setAttribute('aria-expanded', 'false');
			}
		});
	}

	/* Cart drawer */
	function setCartOpen(open) {
		if (!cartDrawer) return;
		cartDrawer.classList.toggle('is-open', open);
		cartDrawer.setAttribute('aria-hidden', open ? 'false' : 'true');
	}

	if (cartToggle) {
		cartToggle.addEventListener('click', () => setCartOpen(true));
	}
	if (cartClose) {
		cartClose.addEventListener('click', () => setCartOpen(false));
	}
	if (cartDrawer) {
		cartDrawer.addEventListener('click', (e) => {
			if (e.target === cartDrawer) setCartOpen(false);
		});
	}

	/* Hero slider */
	if (heroSlider && heroDots) {
		const slides = heroSlider.querySelectorAll('.swe-hero__slide');
		let current = 0;
		let timer;

		slides.forEach((_, i) => {
			const dot = document.createElement('button');
			dot.type = 'button';
			dot.className = 'swe-hero__dot' + (i === 0 ? ' is-active' : '');
			dot.setAttribute('aria-label', 'Slide ' + (i + 1));
			dot.addEventListener('click', () => goTo(i));
			heroDots.appendChild(dot);
		});

		const dots = heroDots.querySelectorAll('.swe-hero__dot');

		function goTo(index) {
			slides[current].classList.remove('is-active');
			dots[current].classList.remove('is-active');
			current = index;
			slides[current].classList.add('is-active');
			dots[current].classList.add('is-active');
		}

		function next() {
			goTo((current + 1) % slides.length);
		}

		function startAutoplay() {
			timer = setInterval(next, 5000);
		}

		function resetAutoplay() {
			clearInterval(timer);
			startAutoplay();
		}

		heroDots.addEventListener('click', resetAutoplay);
		if (slides.length > 1) startAutoplay();
	}

	/* Demo: "Mua ngay" */
	document.querySelectorAll('.swe-product-card__buy').forEach((btn) => {
		btn.addEventListener('click', () => {
			const countEl = document.querySelector('.swe-header__cart-count');
			if (countEl) {
				countEl.textContent = String(parseInt(countEl.textContent, 10) + 1);
			}
			setCartOpen(true);
		});
	});
})();
