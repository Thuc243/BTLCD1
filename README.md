<p align="center">
<a href="#" target="_blank">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300">
</a>
</p>

<h1 align="center">📱 Phone Shop - Website bán điện thoại</h1>

<p align="center">
🚀 Xây dựng bằng Laravel | 🛒 Website thương mại điện tử cơ bản
</p>

---

## 🚀 Giới thiệu

**Phone Shop** là một website bán điện thoại được phát triển bằng **Laravel**, mô phỏng hệ thống thương mại điện tử thực tế với đầy đủ chức năng cho người dùng và quản trị viên.

Dự án giúp:

* Quản lý sản phẩm
* Xử lý đơn hàng
* Quản lý khách hàng
* Cung cấp trải nghiệm mua sắm online

---

## 🎯 Chức năng chính

### 👤 Người dùng (User)

* 🏠 Xem sản phẩm
* 🛒 Thêm vào giỏ hàng
* 💳 Thanh toán (COD + QR)
* 📦 Theo dõi đơn hàng
* 🔐 Đăng ký / Đăng nhập

---

### 👑 Quản trị viên (Admin)

* 📊 Dashboard thống kê
* 📱 Quản lý sản phẩm (thêm / xóa)
* 📦 Quản lý đơn hàng
* 👥 Quản lý khách hàng
* 💳 Quản lý phương thức thanh toán

---

## 🛠️ Công nghệ sử dụng

* Backend: PHP (Laravel)
* Database: MySQL (XAMPP)
* Frontend: Blade + Bootstrap 5
* Authentication: Laravel Auth

---

## 📂 Cấu trúc dự án

```
app/
 ├── Models/
 ├── Http/Controllers/

resources/views/
 ├── user/
 ├── admin/
 ├── layout/

routes/
 └── web.php

database/
 └── migrations/
```

---

## ⚙️ Cài đặt dự án

### 1. Clone project

```
git clone https://github.com/your-username/phone-shop.git
cd phone-shop
```

---

### 2. Cài thư viện

```
composer install
```

---

### 3. Cấu hình môi trường

```
cp .env.example .env
```

Sửa `.env`:

```
DB_DATABASE=phone_shop
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4. Tạo database

```
php artisan key:generate
php artisan migrate
```

---

### 5. Chạy project

```
php artisan serve
```

👉 Truy cập:

```
http://127.0.0.1:8000
```

---

## 🔐 Tài khoản mẫu

### 👑 Admin

* Email: [admin@gmail.com](mailto:admin@gmail.com)
* Password: 123456
* (Cần set `role = admin` trong database)

---

## 📸 Demo

* Trang user: xem sản phẩm, giỏ hàng
* Trang admin: quản lý hệ thống

---

## 📌 Hướng phát triển

* 💳 Thanh toán online (VNPay, Momo)
* 📱 Responsive mobile
* 🔍 Tìm kiếm nâng cao
* ⭐ Đánh giá sản phẩm
* 📊 Thống kê doanh thu

---

## 👨‍💻 Tác giả

* Dự án học tập Laravel
* Xây dựng hệ thống web bán hàng cơ bản

---

## 📄 License

Dự án sử dụng giấy phép MIT.
