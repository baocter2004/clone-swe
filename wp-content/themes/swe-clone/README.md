# SWE Clone — WordPress Theme

Clone giao diện [swe.vn](https://swe.vn/) (Haravan) cho mục đích học tập / đồ án tốt nghiệp.

## Cách chạy

1. Mở Laragon, đảm bảo site `datn-swe` chạy được.
2. Vào **WP Admin → Giao diện → Giao diện** → kích hoạt **SWE Clone**.
3. **Cài đặt → Đọc** → chọn **Trang tĩnh** làm trang chủ (hoặc để mặc định — theme dùng `front-page.php`).
4. Truy cập: `http://datn-swe.test/` (hoặc URL local của bạn).

## Cấu trúc theme (chuẩn WordPress)

```
swe-clone/
├── style.css              # Metadata theme
├── functions.php          # Setup, enqueue CSS/JS
├── front-page.php         # Trang chủ
├── header.php / footer.php
├── inc/data.php           # Dữ liệu demo (sản phẩm, menu, banner)
├── template-parts/
│   └── product-card.php   # Component tái sử dụng
└── assets/
    ├── css/main.css
    └── js/main.js
```

## So sánh với swe.vn gốc

| swe.vn (Haravan) | Theme clone |
|------------------|-------------|
| Haravan platform | WordPress custom theme |
| jQuery + Owl Carousel | Vanilla JS slider |
| Liquid template | PHP template parts |
| Sản phẩm từ admin Haravan | `inc/data.php` (sau gắn WooCommerce) |
| Font Quicksand | Giữ Quicksand (Google Fonts) |

## Lộ trình nâng cấp (đồ án)

1. **Giai đoạn 1 (hiện tại):** Clone UI tĩnh — layout, responsive, hover sản phẩm.
2. **Giai đoạn 2:** Cài **WooCommerce** → thay `swe_clone_products()` bằng `wc_get_products()`.
3. **Giai đoạn 3:** Trang chi tiết SP (`single-product.php`), giỏ hàng thật, checkout.
4. **Giai đoạn 4:** Custom Post Type nếu không dùng WooCommerce.

## Lưu ý bản quyền

- Ảnh banner/sản phẩm demo lấy từ CDN công khai của swe.vn — chỉ dùng cho học tập.
- Đồ án nộp chính thức nên dùng ảnh tự chụp hoặc placeholder.

## Gốc tham khảo

- Site: https://swe.vn/
- Nền tảng gốc: Haravan (footer: "Powered by Haravan")
