<p align="center">
<a href="#" target="_blank">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300">
</a>
</p>

<h1 align="center">📱 Phone Shop - E-Commerce Website</h1>

<p align="center">
🚀 <strong>Xây dựng bằng Laravel 12 | 🛒 Website thương mại điện tử chuyên cung cấp thiết bị di động</strong>
</p>

---

## 🚀 Giới thiệu (Introduction)

**Phone Shop** là một hệ thống website thương mại điện tử bán điện thoại di động được phát triển bằng **Laravel 12**. 
Dự án được thiết kế mô phỏng một hệ thống thực tế với đầy đủ các nghiệp vụ từ mua sắm, thanh toán, quản lý đơn hàng cho đến phân quyền quản trị nội dung.

Mục tiêu của dự án:
- Dùng cho mục đích học tập và thực hành framework Laravel 12.
- Nắm vững kiến trúc MVC, Routing, Eloquent ORM, Middleware.
- Xây dựng hệ thống Authentication với đầy đủ Đăng nhập, Đăng ký, Quên mật khẩu (Xác thực OTP qua Email).
- Quản lý giỏ hàng và xử lý đơn đặt hàng chuyên nghiệp.

---

## 🎯 Chức năng nổi bật (Features)

### 👤 Giao diện Người dùng (Customer)
- **Trang chủ & Sản phẩm:** Xem danh sách thiết bị, lọc sản phẩm theo Thương hiệu (Apple, Samsung,...), xem chi tiết cấu hình và hình ảnh sản phẩm.
- **Giỏ hàng (Cart):** Thêm, sửa đổi số lượng, và xóa sản phẩm khỏi giỏ dễ dàng.
- **Thanh toán (Checkout):** Tiến hành đặt hàng hỗ trợ phương thức Ship COD và quét mã QR.
- **Tài khoản & Xác thực:** Đăng ký, Đăng nhập, Quên mật khẩu qua **mã OTP gửi về Email**, tích hợp đăng nhập an toàn.
- **Quản lý đơn hàng:** Theo dõi chi tiết lịch sử và trạng thái đơn hàng cá nhân.
- **Tương tác (Review):** Cho phép người dùng đánh giá xếp hạng và để lại bình luận cho sản phẩm (kèm tính năng phản hồi/xóa bình luận).

### 👑 Giao diện Quản trị viên (Admin Dashboard)
- **Bảng điều khiển (Dashboard):** Xem các báo cáo thống kê tổng quan cơ bản của hệ thống.
- **Quản lý Sản phẩm (Phones):** Thêm mới (Upload hình ảnh), cập nhật, và xóa sản phẩm.
- **Quản lý Danh mục (Categories):** Xây dựng nhóm/thương hiệu cho điện thoại.
- **Quản lý Đơn hàng (Orders):** Duyệt danh sách đơn đặt hàng, cập nhật các trạng thái (Wait, Processing, Shipping, Done, Cancelled).
- **Quản lý Nguời dùng (Users):** Xem và quản lý danh sách tài khoản khách hàng trong hệ thống.

---

## 🛠️ Công nghệ sử dụng (Tech Stack)

### Backend
- **Framework:** Laravel 12 (Yêu cầu PHP ^8.2)
- **Database:** MySQL (thông qua môi trường XAMPP / Laragon)
- **Authentication:** Laravel Auth (Tùy chỉnh OTP qua email), Laravel Socialite (Thiết lập đăng nhập Google)

### Frontend
- **Blade Template Engine**
- **Bootstrap 5** (Responsive layout)
- **Vite** (Module bundler để package CSS/JS)

---

## ⚙️ Hướng dẫn cài đặt (Installation)

### 1. Yêu cầu môi trường (Prerequisites)
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL Server (XAMPP / Laragon / Docker)

### 2. Tải và thiết lập dự án
Clone kho lưu trữ về máy:
```bash
git clone https://github.com/your-username/phone-shop.git
cd phone-shop
```

Cài đặt các gói thư viện PHP và Node.js:
```bash
composer install
npm install
```

### 3. Cấu hình Data & Mail (.env)
Tạo file `.env` từ file `.env.example`:
```bash
cp .env.example .env
```

Mở `.env` lên và điền thông số Database cũng như SMTP Mail (bắt buộc cấu hình SMTP để test chức năng Quên mật khẩu / OTP):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=phone_shop
DB_USERNAME=root
DB_PASSWORD=

# Cấu hình SMTP (ví dụ Gmail / Mailtrap)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=email_cua_ban@gmail.com
MAIL_PASSWORD=mat_khau_ung_dung
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. Migrate và sinh App Key
Khởi tạo bảng cơ sở dữ liệu và khóa bảo mật:
```bash
php artisan key:generate
php artisan migrate
```
*(Lưu ý: Nếu có database seeder, hãy dùng `php artisan migrate --seed`)*

### 5. Khởi động Web Server
Build Frontend assets:
```bash
npm run build
```

Chạy Server phát triển cục bộ:
```bash
php artisan serve
```

👉 **Truy cập:** `http://127.0.0.1:8000`

---

## 🔐 Tài khoản thử nghiệm (Test Accounts)

Bạn có thể tự đăng ký một tài khoản người dùng tại web để test tính năng hệ thống gửi OTP Email, hoặc cấu hình trên Database tài khoản Admin sau:

**👑 Quyền Admin:**
* **Email:** `admin@gmail.com`
* **Mật khẩu:** `123456`
* *(Chú ý: Trong bảng `users` ở DB, trường `role` phải đổi thành `admin`)*

---

## 📌 Hướng phát triển tiếp theo (Roadmap)
- [ ] 💳 Tích hợp các ví điện tử / cổng trực tuyến thực sự (VNPay, Momo).
- [ ] 📱 Tinh chỉnh Responsive cho màn hình thiết bị di động tốt hơn.
- [ ] 🔍 Tìm kiếm sản phẩm theo bộ lọc nâng cao (RAM, ROM, Mức giá).
- [ ] 📊 Xuất báo cáo, biểu đồ thống kê chuyên sâu.

---

## 📄 Giấy phép (License)

Dự án bán điện thoại này được phát hành dưới [giấy phép MIT](https://opensource.org/licenses/MIT). Thỏa sức thay đổi và sử dụng!
