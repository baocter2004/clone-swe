# Luồng bán hàng & Seeder — SWE Clone

## Chạy seeder dự án (xem demo đầy đủ)

### Cách 1 — Trang Admin (khuyên dùng)

1. Bật **WooCommerce**
2. Vào **Công cụ → SWE Demo Data**
3. Bấm **Reset & Seed lại từ đầu** (lần đầu nên dùng nút này)
4. **Cài đặt → Đường dẫn tĩnh → Lưu**

### Cách 2 — URL nhanh

Đã đăng nhập Admin:

```
http://datn-swe.test/wp-admin/?swe_seed_demo=1&reset=1
```

### Seeder tạo gì?

| Loại | Số lượng | Ghi chú |
|------|----------|---------|
| Danh mục WC | 7 | new arrivals, tops, bottoms… |
| Sản phẩm | 10 | Có size (S–XL), giá VND, ảnh SWE CDN |
| Banner hero | 2 | Full màn hình |
| Ảnh danh mục | 4 | TOP, BOTTOM… |
| Feedback | 3 | |

Sản phẩm có meta `_swe_demo` — **Reset** chỉ xóa dữ liệu demo, không đụng SP khách tự thêm (nếu không gắn meta demo).

---

## Luồng bán hàng chuẩn (test end-to-end)

```
① Trang chủ          http://datn-swe.test/
② Cửa hàng           /shop/
③ Chi tiết SP        /product/swe-passion-l-s-tee-white/
   → Chọn Size → Thêm vào giỏ
④ Giỏ hàng           /cart/
⑤ Thanh toán         /checkout/
⑥ Đặt hàng           Chọn COD → Đặt hàng
⑦ Admin xử lý        WooCommerce → Đơn hàng
```

### Checklist demo đồ án

- [ ] Trang chủ: banner, 4 danh mục, lưới SP
- [ ] SP có ảnh, giá ₫, chọn size (biến thể)
- [ ] Thêm giỏ → số trên icon giỏ tăng
- [ ] Checkout COD hoàn tất
- [ ] Admin thấy đơn mới

---

## Khách hàng thật cung cấp gì?

Excel/Google Sheet: **Tên | Giá | Size | SL tồn | Ảnh (file) | Mô tả | Danh mục**

Bạn nhập: **Sản phẩm → Thêm mới** hoặc **Nhập CSV**.

Banner: **Banner trang chủ** (không qua WooCommerce).

---

## Thanh toán

- **COD** + **Chuyển khoản** — bật sẵn khi seed
- VNPay/MoMo: cài plugin cổng VN + API key
