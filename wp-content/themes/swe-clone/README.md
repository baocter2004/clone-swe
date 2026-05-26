# SWE Clone — WordPress Theme

Clone giao diện [swe.vn](https://swe.vn/) (Haravan) cho mục đích học tập / đồ án tốt nghiệp.

## Cách chạy

1. Mở Laragon, đảm bảo site `datn-swe` chạy được.
2. Vào **WP Admin → Plugin → Cài đặt** → bật **WooCommerce** (đã có sẵn trong `wp-content/plugins/woocommerce`).
3. Làm wizard WooCommerce (VND, Việt Nam) hoặc **WooCommerce → Cài đặt → Tổng quan → Đơn vị tiền tệ: VND**.
4. **Giao diện → Giao diện** → kích hoạt **SWE Clone**.
5. Tắt/bật lại theme một lần để tự tạo **8 sản phẩm demo** (nếu shop trống).
6. Truy cập: `http://datn-swe.test/`

## Bán hàng thật (WooCommerce)

| Trang | URL mặc định |
|-------|----------------|
| Cửa hàng | `/shop/` |
| Chi tiết SP | `/product/ten-san-pham/` |
| Giỏ hàng | `/cart/` |
| Thanh toán | `/checkout/` |
| Tài khoản | `/my-account/` |

**Khách (admin) thêm sản phẩm:** WooCommerce → Sản phẩm → Thêm mới → ảnh, giá, tồn kho, biến thể (size).

**Thanh toán:** WooCommerce → Cài đặt → Thanh toán → bật **Chuyển khoản**, **COD**, hoặc cài cổng VN (VNPay, MoMo plugin…).

Chi tiết luồng mua hàng: xem **[HUONG-DAN-BAN-HANG.md](HUONG-DAN-BAN-HANG.md)**

**Trang SP trống / 404:** Cài đặt → Đường dẫn tĩnh → Lưu, rồi mở `wp-admin/?swe_reseed=1`

## Khách hàng tự upload ảnh (không cần sửa code)

Vào **WP Admin** → menu **Banner trang chủ**:

| Menu | Mục đích |
|------|----------|
| **Banner trang chủ** | Slider full màn hình |
| **Ảnh danh mục** | 4 ô TOP / BOTTOM / OUTERWEAR / ACCESSORIES |
| **SWE® Feedback** | Ảnh feedback |

### Thêm 1 banner full màn hình

1. **Banner trang chủ → Thêm banner mới**
2. **Ảnh đại diện** (bên phải) = ảnh desktop (khuyến nghị 1920×1080 trở lên)
3. **Cài đặt banner** → **Chọn ảnh mobile** (ảnh dọc cho điện thoại)
4. Nhập **Link** khi bấm banner
5. Cột **Thứ tự** (kéo thả) = thứ tự slide
6. **Xuất bản**

Nếu chưa có banner trong Admin, theme tự dùng ảnh demo từ `inc/data.php`.

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
