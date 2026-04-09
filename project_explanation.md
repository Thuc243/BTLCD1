# Giải Thích Mã Nguồn Dự Án Phone Shop

Dự án này là một website bán hàng điện thoại được xây dựng trên framework **Laravel 12**, sử dụng kiến trúc **MVC (Model-View-Controller)** và hệ thống phân quyền (RBAC).

---

## 1. Kiến Trúc Tổng Quan (MVC)

Dự án tuân thủ cấu trúc chuẩn của Laravel:
- **Models (`app/Models`)**: Định nghĩa dữ liệu và các mối quan hệ (Relationships) giữa các bảng.
- **Controllers (`app/Http/Controllers`)**: Xử lý logic nghiệp vụ và điều hướng dữ liệu.
- **Views (`resources/views`)**: Giao diện người dùng sử dụng Blade Template Engine.
- **Routes (`routes/web.php`)**: Định nghĩa các đường dẫn của website.

---

## 2. Hệ Thống Cơ Sở Dữ Liệu (Models)

Dự án bao gồm các bảng chính:
- **User**: Lưu thông tin người dùng và vai trò (`role`: 'admin' hoặc 'user').
- **Phone**: Thông tin sản phẩm (tên, giá, ảnh, mô tả, hãng).
- **Category**: Danh mục hãng điện thoại (iPhone, Samsung, Xiaomi...).
- **Order & OrderItem**: Lưu thông tin đơn hàng và chi tiết các sản phẩm trong đơn hàng đó.

**Mối quan hệ chính:**
- `Phone` belongsTo `Category`.
- `Order` belongsTo `User`.
- `Order` hasMany `OrderItem`.
- `OrderItem` belongsTo `Phone`.

---

## 3. Phân Quyền & Bảo Mật

### Middleware `IsAdmin`
Nằm tại: `app/Http/Middleware/IsAdmin.php`.
- **Chức năng**: Kiểm tra xem người dùng đã đăng nhập chưa và có phải là `admin` không.
- **Sử dụng**: Được áp dụng cho tất cả các đường dẫn bắt đầu bằng `/admin` trong `routes/web.php`. Nếu không phải admin, người dùng sẽ bị đẩy về trang chủ.

### Auth Controllers
Dự án sử dụng các Controller trong `app/Http/Controllers/Auth` để xử lý Đăng nhập, Đăng ký và Đăng xuất một cách bảo mật.

---

## 4. Các Bộ Điều Khiển Chính (Controllers)

### ShopController (Frontend)
- `home()`: Hiển thị trang chủ, tìm kiếm và lọc sản phẩm.
- `add()`: Thêm sản phẩm vào giỏ hàng (sử dụng **Session**).
- `cart()`: Hiển thị và cập nhật giỏ hàng.
- `checkout()` & `order()`: Xử lý quy trình thanh toán và lưu đơn hàng vào DB.

### AdminController (Backend)
Đây là "bộ não" của người quản lý:
- `dashboard()`: Thống kê nhanh số lượng sản phẩm, đơn hàng và người dùng.
- `phones()`: CRUD (Thêm, Sửa, Xóa) sản phẩm điện thoại. Xử lý tải ảnh lên thư mục `public/uploads`.
- `orders()`: Quản lý đơn hàng, xem chi tiết và cập nhật trạng thái (Chờ, Hoàn tất, Hủy).
- `users()`: Danh sách thành viên trong hệ thống.

---

## 5. Giao Diện (Views)

Giao diện được xây dựng bằng **Bootstrap 5** và **Lucide Icons**:
- **Layouts (`resources/views/layout`)**: Chứa khung xương chung cho web (`user.blade.php`) và trang quản trị (`admin.blade.php`).
- **User Views**: Tập trung vào trải nghiệm mua sắm hiện đại, card sản phẩm có hiệu ứng hover.
- **Admin Views**: Bảng dữ liệu gọn gàng, hệ thống Badge màu sắc để phân biệt trạng thái đơn hàng.

---

## 6. Các Tệp Bổ Trợ Đặc Biệt

- **`download_images.php`**: Một script hỗ trợ tự động tải hoặc tạo ảnh placeholder chuyên nghiệp cho sản phẩm nếu dữ liệu mẫu chưa có ảnh thực tế (Sử dụng thư viện GD của PHP).
- **`DatabaseSeeder.php`**: Chứa dữ liệu mẫu để khởi tạo nhanh hệ thống (tài khoản admin, sản phẩm mẫu).

---

## 7. Cách Cài Đặt & Khởi Chạy

1. Tạo database tên `phone_shop` trong PHPMyAdmin.
2. Cập nhật file `.env` (DB_USERNAME, DB_PASSWORD).
3. Chạy lệnh:
   ```bash
   php artisan migrate:fresh --seed
   ```
4. Đăng nhập Admin: `admin@gmail.com` | Pass: `12345678`
