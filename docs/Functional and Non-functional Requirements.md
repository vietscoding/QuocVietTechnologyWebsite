# Functional and Non-functional Requirements Document

**Project Name**: Quoc Viet Technology

**Website Type**: Computer Sales Website

**Student Name**: Doan Quoc Viet

**Student ID**: BD00536

**Class**: SE07203

---

## 1. Functional Requirements

### 1.1 User Registration & Login

- Người dùng có thể đăng ký tài khoản bằng tên, email, mật khẩu.
- Xác thực form sử dụng JavaScript (frontend), xử lý dữ liệu sử dụng PHP và lưu trữ vào MySQL.
- Đăng nhập với xác minh thông tin người dùng từ CSDL.

### 1.2 User Roles
- Có 2 vai trò: User và Admin (xác định qua cột `role` trong bảng user).
- Admin có thể truy cập trang quản trị, User chỉ truy cập chức năng mua hàng.

### 1.3 Product Browsing & Search

- Tìm kiếm theo tên, hãng, loại sản phẩm.
- Lọc nâng cao theo mức giá, đánh giá.

### 1.4 Product Detail View

- Trang sản phẩm hiển thị ảnh, mô tả, cấu hình, giá, đánh giá từ người dùng.

### 1.5 Shopping Cart

- Thêm/sửa/xóa sản phẩm trong giỏ hàng.
- Dữ liệu giỏ hàng lưu trong MySQL (dựa vào user ID hoặc session guest).

### 1.6 Checkout (Demo only)

- Trang xác nhận đơn hàng, hiển thị tổng tiền, thông tin giao hàng (không tích hợp cổng thanh toán).

### 1.7 Rating & Review

- Người dùng có thể để lại đánh giá (sao + nội dung) sau khi mua

### 1.8 Profile & Order History

- Trang profile để cập nhật thông tin cá nhân.
- Xem lại các đơn hàng đã đặt.

### 1.9 Admin Panel

- Quản lý sản phẩm: thêm/sửa/xóa
- Quản lý đơn hàng: cập nhật trạng thái xử lý.
- Quản lý người dùng: phân quyền, khóa tài khoản.

---


## 2. Non-functional Requirements

### 2.1 Performance

- Trang chủ tải trong < 2 giây với kết nối ổn định.
- Tìm kiếm sản phẩm phản hồi trong vòng 1 giây.

### 2.2 Scalability

- Thiết kế database đủ khả năng mở rộng tới hàng chục nghìn sản phẩm.

### 2.3 Security

- Mã hóa mật khẩu bằng `password_hash()` trong PHP.
- Chống SQL Injection bằng `mysql_real_escape_string()` hoặc `prepared statements`.

### 2.4 Usability

- Thiết kế giao diện dễ sử dụng, điều hướng rõ ràng.
- Responsive (dùng media queries hoặc Bootstrap 5 ở mức tối thiểu).
- Có chuyển đổi giữa giao diện sáng/tối.

### 2.5 Maintainability

- Sử dụng mô hình tách riêng file: `model`, `view`, `controller` theo hướng thủ công.
- Ghi chú code đầy đủ, tuân theo quy chuẩn đặt tên PHP.

### 2.6 Compatibility

- Tương thích trình duyệt: Chrome, Firefox, Edge, Safari.
- Hiển thị tốt ở độ phân giải từ mobile (360px), đến desktop (1920px)

### 2.7 SEO & Accessibility

- Dùng thẻ HTML5 semantic (header, nav, section, article)
- Gắn thẻ meta: `description`, `keywords`, `viewport`.
- Đảm bảo tương thích screen reader.

---

## Key Pages

1. Home
2. Contact
3. Authentication (login, register)
4. User profile
5. Shopping cart
6. Product detail
7. Admin

