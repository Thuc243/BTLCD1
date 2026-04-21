-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 21, 2026 lúc 01:58 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phone_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'iPhone', '2026-04-09 07:23:35', '2026-04-09 07:23:35'),
(2, 'Samsung', '2026-04-09 07:23:35', '2026-04-09 07:23:35'),
(3, 'Xiaomi', '2026-04-09 07:23:35', '2026-04-09 07:23:35'),
(4, 'OPPO', '2026-04-09 07:23:35', '2026-04-09 07:23:35'),
(5, 'Vivo', '2026-04-09 07:23:35', '2026-04-09 07:23:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_27_035359_create_phones_table', 1),
(5, '2026_03_27_040000_create_orders_table', 1),
(6, '2026_03_30_033244_create_categories_table', 1),
(7, '2026_03_30_034746_add_fields_to_phones_table', 1),
(8, '2026_04_06_035734_add_role_to_users_table', 1),
(9, '2026_04_09_100000_add_shipping_to_orders_table', 1),
(10, '2026_04_13_100000_create_reviews_table', 2),
(11, '2026_04_13_110000_create_password_reset_otps_table', 3),
(12, '2026_04_13_120000_add_google_id_to_users_table', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','cancelled') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `phone_number`, `address`, `total`, `status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 2, 'Nguyễn Văn A', '0901234567', '123 Nguyễn Huệ, Q1, HCM', 34990000.00, 'completed', 'COD', '2026-04-09 07:23:36', '2026-04-09 07:23:36'),
(2, 3, 'Trần Thị B', '0912345678', '456 Lê Lợi, Q3, HCM', 51980000.00, 'pending', 'QR', '2026-04-09 07:23:36', '2026-04-09 07:23:36'),
(3, 2, 'Nguyễn Văn A', '0901234567', '123 Nguyễn Huệ, Q1, HCM', 23990000.00, 'cancelled', 'COD', '2026-04-09 07:23:36', '2026-04-09 07:23:36'),
(4, 6, 'Lê Hữu Chinh', '0337312919', 'Đạo Trù - Tam Đảo - Phú Thọ', 28990000.00, 'completed', 'QR', '2026-04-19 18:44:42', '2026-04-19 18:45:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `phone_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `phone_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 34990000.00, '2026-04-09 07:23:36', '2026-04-09 07:23:36'),
(2, 2, 9, 1, 28990000.00, '2026-04-09 07:23:36', '2026-04-09 07:23:36'),
(3, 2, 11, 1, 22990000.00, '2026-04-09 07:23:36', '2026-04-09 07:23:36'),
(4, 3, 17, 1, 23990000.00, '2026-04-09 07:23:36', '2026-04-09 07:23:36'),
(5, 4, 2, 1, 28990000.00, '2026-04-19 18:44:42', '2026-04-19 18:44:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_otps`
--

CREATE TABLE `password_reset_otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phones`
--

CREATE TABLE `phones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sold` int(11) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phones`
--

INSERT INTO `phones` (`id`, `name`, `price`, `image`, `description`, `created_at`, `updated_at`, `is_featured`, `sold`, `category_id`) VALUES
(1, 'iPhone 16 Pro Max 256GB', 34990000, 'iphone16promax.png', 'iPhone 16 Pro Max - Siêu phẩm mới nhất của Apple với chip A18 Pro, màn hình Super Retina XDR 6.9 inch lớn nhất từ trước đến nay. Thiết kế titan cao cấp, camera 48MP nâng cấp mạnh mẽ và Apple Intelligence tích hợp.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.9 inch Super Retina XDR OLED, 120Hz ProMotion, 2868x1320\n• Chip: Apple A18 Pro (3nm thế hệ 2)\n• Camera sau: 48MP f/1.78 chính + 48MP Ultra Wide + 12MP Telephoto 5x\n• Camera trước: 12MP TrueDepth, Face ID\n• RAM: 8GB\n• Bộ nhớ: 256GB\n• Pin: 4685 mAh, sạc nhanh 27W, MagSafe 25W\n• Hệ điều hành: iOS 18\n• Chống nước: IP68\n• Trọng lượng: 227g\n• Đặc biệt: Nút Camera Control, khung Titan, USB-C 3.0, Apple Intelligence', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 1, 2100, 1),
(2, 'iPhone 16 Pro 128GB', 28990000, 'iphone16pro.png', 'iPhone 16 Pro với chip A18 Pro mạnh mẽ, nút Camera Control mới và khung titan siêu nhẹ. Trải nghiệm chơi game và chụp ảnh đỉnh cao.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.3 inch Super Retina XDR OLED, 120Hz ProMotion\n• Chip: Apple A18 Pro (3nm)\n• Camera sau: 48MP + 48MP Ultra Wide + 12MP Telephoto 5x\n• Camera trước: 12MP TrueDepth\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 3582 mAh, sạc nhanh 27W\n• Hệ điều hành: iOS 18\n• Chống nước: IP68\n• Đặc biệt: Camera Control, Titan, Apple Intelligence', '2026-04-09 07:23:35', '2026-04-19 18:44:42', 1, 1801, 1),
(3, 'iPhone 16 128GB', 22990000, 'iphone16.png', 'iPhone 16 với chip A18, camera 48MP và nút Camera Control hoàn toàn mới. Thiết kế sắc nét với nhiều màu sắc trẻ trung.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.1 inch Super Retina XDR OLED, 60Hz\n• Chip: Apple A18\n• Camera sau: 48MP + 12MP Ultra Wide\n• Camera trước: 12MP TrueDepth\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 3561 mAh\n• Hệ điều hành: iOS 18\n• Chống nước: IP68', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 1500, 1),
(4, 'iPhone 15 Pro Max 256GB', 29990000, 'iphone15promax.png', 'iPhone 15 Pro Max - Flagship đỉnh cao với chip A17 Pro 3nm, camera zoom quang 5x và thiết kế khung titan siêu nhẹ. Quay video ProRes 4K.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.7 inch Super Retina XDR, 120Hz ProMotion\n• Chip: Apple A17 Pro (3nm)\n• Camera sau: 48MP + 12MP UW + 12MP Telephoto 5x\n• Camera trước: 12MP\n• RAM: 8GB\n• Bộ nhớ: 256GB\n• Pin: 4422 mAh, sạc 27W\n• Hệ điều hành: iOS 17\n• Chống nước: IP68\n• Đặc biệt: Action Button, Titan, USB-C, ProRes 4K', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 1, 3500, 1),
(5, 'iPhone 15 128GB', 19990000, 'iphone15.png', 'iPhone 15 với Dynamic Island, camera 48MP và USB-C. Thiết kế kính mờ và viền nhôm.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.1 inch Super Retina XDR OLED\n• Chip: Apple A16 Bionic\n• Camera sau: 48MP + 12MP\n• Camera trước: 12MP\n• RAM: 6GB\n• Bộ nhớ: 128GB\n• Pin: 3349 mAh\n• Chống nước: IP68', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 4200, 1),
(6, 'iPhone 14 128GB', 16990000, 'iphone14.png', 'iPhone 14 giá tốt nhất với chip A15 Bionic vẫn cực mạnh.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.1 inch Super Retina XDR\n• Chip: Apple A15 Bionic\n• Camera sau: 12MP + 12MP\n• Camera trước: 12MP\n• RAM: 6GB\n• Bộ nhớ: 128GB\n• Pin: 3279 mAh\n• Chống nước: IP68', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 5500, 1),
(7, 'iPhone 13 128GB', 13990000, 'iphone13.png', 'Sản phẩm quốc dân Apple. Pin dùng cả ngày.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.1 inch Super Retina XDR\n• Chip: Apple A15 Bionic\n• Camera sau: 12MP + 12MP\n• RAM: 4GB\n• Bộ nhớ: 128GB\n• Pin: 3227 mAh\n• Chống nước: IP68', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 7000, 1),
(8, 'iPhone SE 2022 64GB', 10990000, 'iphonese.png', 'iPhone SE nhỏ gọn với chip A15 Bionic, Touch ID.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 4.7 inch Retina HD IPS\n• Chip: Apple A15 Bionic\n• Camera sau: 12MP\n• RAM: 4GB\n• Bộ nhớ: 64GB\n• Pin: 2018 mAh\n• Chống nước: IP67', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 3000, 1),
(9, 'Samsung Galaxy S24 Ultra 256GB', 28990000, 'galaxys24ultra.png', 'Galaxy S24 Ultra - AI Galaxy, camera 200MP, S Pen, khung titan.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.8 inch Dynamic AMOLED 2X, QHD+, 120Hz\n• Chip: Snapdragon 8 Gen 3 for Galaxy\n• Camera sau: 200MP + 12MP + 10MP 3x + 50MP 5x\n• Camera trước: 12MP\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 5000 mAh, sạc 45W\n• Chống nước: IP68\n• Đặc biệt: S Pen, Galaxy AI, Titan, Gorilla Armor', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 1, 2300, 2),
(10, 'Samsung Galaxy S24+ 256GB', 22990000, 'galaxys24.png', 'Galaxy S24+ với AI thông minh, màn lớn.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.7 inch Dynamic AMOLED 2X, FHD+, 120Hz\n• Chip: Exynos 2400\n• Camera sau: 50MP + 12MP + 10MP 3x\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 4900 mAh, sạc 45W\n• Đặc biệt: Galaxy AI, Circle to Search', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 1100, 2),
(11, 'Samsung Galaxy S24 128GB', 18990000, 'galaxys24.png', 'Galaxy S24 gọn nhẹ với Galaxy AI.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.2 inch Dynamic AMOLED 2X, FHD+, 120Hz\n• Chip: Exynos 2400\n• Camera sau: 50MP + 12MP + 10MP 3x\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 4000 mAh, sạc 25W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 1400, 2),
(12, 'Samsung Galaxy Z Fold5 256GB', 35990000, 'galaxyzfold5.png', 'Galaxy Z Fold5 - Gập cao cấp nhất.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình chính: 7.6 inch Dynamic AMOLED 2X, 120Hz\n• Màn hình phụ: 6.2 inch\n• Chip: Snapdragon 8 Gen 2\n• Camera sau: 50MP + 12MP + 10MP 3x\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 4400 mAh\n• Chống nước: IPX8', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 1, 500, 2),
(13, 'Samsung Galaxy Z Flip5 256GB', 22990000, 'galaxyzflip5.png', 'Galaxy Z Flip5 thời trang.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình chính: 6.7 inch Dynamic AMOLED 2X\n• Màn hình phụ: 3.4 inch Super AMOLED\n• Chip: Snapdragon 8 Gen 2\n• Camera sau: 12MP + 12MP\n• RAM: 8GB\n• Bộ nhớ: 256GB\n• Pin: 3700 mAh\n• Chống nước: IPX8', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 800, 2),
(14, 'Samsung Galaxy A55 5G 128GB', 9990000, 'generic_phone_blue.png', 'Galaxy A55 tầm trung cao cấp.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.6 inch Super AMOLED, FHD+, 120Hz\n• Chip: Exynos 1480\n• Camera sau: 50MP OIS + 12MP + 5MP\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 25W\n• Chống nước: IP67', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 3500, 2),
(15, 'Samsung Galaxy A35 5G 128GB', 7990000, 'generic_phone_blue.png', 'Galaxy A35 thiết kế đẹp.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.6 inch Super AMOLED, FHD+, 120Hz\n• Chip: Exynos 1380\n• Camera sau: 50MP OIS + 8MP + 5MP\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 25W\n• Chống nước: IP67', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 4000, 2),
(16, 'Samsung Galaxy A15 128GB', 4490000, 'generic_phone_dark.png', 'Galaxy A15 giá rẻ, pin trâu.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.5 inch Super AMOLED, FHD+, 90Hz\n• Chip: Helio G99\n• Camera sau: 50MP + 5MP + 2MP\n• RAM: 4GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 15W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 6000, 2),
(17, 'Xiaomi 14 Ultra 512GB', 23990000, 'xiaomi14ultra.png', 'Xiaomi 14 Ultra - 4 camera Leica, cảm biến 1 inch.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.73 inch LTPO AMOLED, 2K, 120Hz, 3000 nits\n• Chip: Snapdragon 8 Gen 3\n• Camera sau: 50MP 1\" Leica + 50MP UW + 50MP 3.2x + 50MP 5x\n• RAM: 16GB\n• Bộ nhớ: 512GB\n• Pin: 5300 mAh, sạc 90W + wireless 50W\n• Đặc biệt: 4 camera Leica Summilux, Sony LYT-900', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 1, 700, 3),
(18, 'Xiaomi 14 Pro 256GB', 18990000, 'xiaomi14.png', 'Xiaomi 14 Pro Leica, sạc 120W.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.73 inch LTPO AMOLED, 2K, 120Hz\n• Chip: Snapdragon 8 Gen 3\n• Camera sau: 50MP Leica + 50MP UW + 50MP 3.2x\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 4880 mAh, sạc 120W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 900, 3),
(19, 'Xiaomi 14 256GB', 14990000, 'xiaomi14.png', 'Xiaomi 14 nhỏ gọn mạnh mẽ.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.36 inch LTPO AMOLED, 1.5K, 120Hz\n• Chip: Snapdragon 8 Gen 3\n• Camera sau: 50MP Leica + 50MP UW + 50MP 3.2x\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 4610 mAh, sạc 90W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 1300, 3),
(20, 'Xiaomi POCO F6 Pro 256GB', 12990000, 'generic_phone_dark.png', 'POCO F6 Pro hiệu năng monster.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.67 inch AMOLED, 2K, 120Hz\n• Chip: Snapdragon 8 Gen 2\n• Camera sau: 50MP OIS + 8MP + 2MP\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 5000 mAh, sạc 120W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 1500, 3),
(21, 'Xiaomi Redmi Note 13 Pro+ 256GB', 8990000, 'redminote13proplus.png', 'Redmi Note 13 Pro+ camera 200MP, sạc 120W.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.67 inch AMOLED, FHD+, 120Hz\n• Chip: Dimensity 7200 Ultra\n• Camera sau: 200MP OIS + 8MP + 2MP\n• RAM: 8GB\n• Bộ nhớ: 256GB\n• Pin: 5000 mAh, sạc 120W\n• Chống nước: IP68', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 4500, 3),
(22, 'Xiaomi Redmi Note 13 128GB', 4990000, 'generic_phone_blue.png', 'Redmi Note 13 giá tốt.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.67 inch AMOLED, FHD+, 120Hz\n• Chip: Snapdragon 685\n• Camera sau: 108MP + 8MP + 2MP\n• RAM: 6GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 33W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 5500, 3),
(23, 'Xiaomi POCO X6 256GB', 6990000, 'generic_phone_blue.png', 'POCO X6 hiệu năng tốt.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.67 inch AMOLED, FHD+, 120Hz\n• Chip: Snapdragon 7s Gen 2\n• Camera sau: 64MP + 8MP + 2MP\n• RAM: 8GB\n• Bộ nhớ: 256GB\n• Pin: 5100 mAh, sạc 67W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 2800, 3),
(24, 'Xiaomi Redmi 13C 128GB', 3290000, 'generic_phone_dark.png', 'Redmi 13C giá rẻ, pin trâu.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.74 inch IPS LCD, HD+, 90Hz\n• Chip: Helio G85\n• Camera sau: 50MP + 2MP\n• RAM: 4GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 18W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 7000, 3),
(25, 'OPPO Find X7 Ultra 256GB', 22990000, 'findx7ultra.png', 'OPPO Find X7 Ultra - Hasselblad dual periscope.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.82 inch LTPO AMOLED, 2K, 120Hz\n• Chip: Snapdragon 8 Gen 3\n• Camera sau: 50MP + 50MP UW + 50MP 3x + 50MP 6x Hasselblad\n• RAM: 16GB\n• Bộ nhớ: 256GB\n• Pin: 5400 mAh, sạc 100W SUPERVOOC', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 1, 450, 4),
(26, 'OPPO Find N3 Flip 256GB', 19990000, 'generic_phone_green.png', 'OPPO Find N3 Flip thời trang Hasselblad.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình chính: 6.8 inch AMOLED, FHD+, 120Hz\n• Màn hình phụ: 3.26 inch AMOLED\n• Chip: Dimensity 9200\n• Camera sau: 50MP Hasselblad + 48MP + 32MP Tele\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 4300 mAh, sạc 44W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 600, 4),
(27, 'OPPO Reno 11 Pro 5G 256GB', 12990000, 'reno11pro.png', 'Reno 11 Pro thiết kế mỏng nhẹ.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.7 inch AMOLED, FHD+, 120Hz\n• Chip: Dimensity 8200\n• Camera sau: 50MP + 8MP + 32MP Tele 2x\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 4600 mAh, sạc 80W SUPERVOOC', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 900, 4),
(28, 'OPPO Reno 11 5G 128GB', 8990000, 'reno11pro.png', 'Reno 11 camera AI chân dung.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.7 inch AMOLED, FHD+, 120Hz\n• Chip: Dimensity 7050\n• Camera sau: 50MP + 8MP + 2MP\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 67W SUPERVOOC', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 1200, 4),
(29, 'OPPO A79 5G 128GB', 5990000, 'generic_phone_green.png', 'OPPO A79 5G giá tốt.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.72 inch IPS LCD, FHD+, 90Hz\n• Chip: Dimensity 6020\n• Camera sau: 50MP + 2MP\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 33W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 2200, 4),
(30, 'OPPO A58 128GB', 4490000, 'generic_phone_dark.png', 'OPPO A58 pin trâu.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.72 inch IPS LCD, FHD+, 90Hz\n• Chip: Helio G85\n• Camera sau: 50MP + 2MP\n• RAM: 6GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 33W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 3000, 4),
(31, 'OPPO A18 128GB', 3290000, 'generic_phone_dark.png', 'OPPO A18 giá rẻ.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.56 inch IPS LCD, HD+, 90Hz\n• Chip: Helio G85\n• Camera sau: 8MP + 2MP\n• RAM: 4GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 10W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 4500, 4),
(32, 'OPPO A38 128GB', 3790000, 'generic_phone_green.png', 'OPPO A38 siêu tiết kiệm.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.56 inch IPS LCD, HD+, 90Hz\n• Chip: Helio G85\n• Camera sau: 50MP + 2MP\n• RAM: 4GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 33W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 3800, 4),
(33, 'Vivo X100 Pro 256GB', 19990000, 'vivox100pro.png', 'Vivo X100 Pro camera ZEISS, zoom 4.3x.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.78 inch LTPO AMOLED, 2K, 120Hz\n• Chip: Dimensity 9300\n• Camera sau: 50MP ZEISS + 50MP UW + 64MP Tele 4.3x\n• RAM: 16GB\n• Bộ nhớ: 256GB\n• Pin: 5400 mAh, sạc 100W\n• Đặc biệt: Camera ZEISS APO, chip V3', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 1, 600, 5),
(34, 'Vivo V30 Pro 256GB', 12990000, 'vivov30pro.png', 'Vivo V30 Pro aura light chân dung.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.78 inch AMOLED, FHD+, 120Hz\n• Chip: Snapdragon 7 Gen 3\n• Camera sau: 50MP OIS + 50MP UW + 50MP Tele 2x\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 5000 mAh, sạc 80W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 750, 5),
(35, 'Vivo V30 128GB', 8990000, 'vivov30pro.png', 'Vivo V30 thiết kế sang trọng.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.78 inch AMOLED, FHD+, 120Hz\n• Chip: Snapdragon 7 Gen 3\n• Camera sau: 50MP OIS + 8MP UW\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 80W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 1000, 5),
(36, 'Vivo V29e 128GB', 7490000, 'generic_phone_blue.png', 'Vivo V29e mỏng nhẹ, selfie 50MP.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.67 inch AMOLED, FHD+, 120Hz\n• Chip: Snapdragon 695\n• Camera sau: 64MP + 8MP UW\n• Camera trước: 50MP\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 4800 mAh, sạc 44W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 1200, 5),
(37, 'Vivo Y36 128GB', 4490000, 'generic_phone_blue.png', 'Vivo Y36 trẻ trung, pin trâu.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.64 inch IPS LCD, FHD+, 90Hz\n• Chip: Snapdragon 680\n• Camera sau: 50MP + 2MP\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 18W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 2800, 5),
(38, 'Vivo Y27 128GB', 4990000, 'generic_phone_dark.png', 'Vivo Y27 giá tốt.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.64 inch IPS LCD, HD+, 90Hz\n• Chip: Helio G85\n• Camera sau: 50MP + 2MP\n• RAM: 6GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 15W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 2500, 5),
(39, 'Vivo Y17s 128GB', 3690000, 'generic_phone_green.png', 'Vivo Y17s giá rẻ sinh viên.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.56 inch IPS LCD, HD+, 60Hz\n• Chip: Helio G85\n• Camera sau: 50MP + 2MP\n• RAM: 4GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 15W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 4000, 5),
(40, 'Vivo T2x 5G 128GB', 4990000, 'generic_phone_blue.png', 'Vivo T2x gaming tầm trung.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.58 inch IPS LCD, FHD+, 120Hz\n• Chip: Dimensity 6300\n• Camera sau: 50MP + 2MP\n• RAM: 6GB\n• Bộ nhớ: 128GB\n• Pin: 6000 mAh, sạc 44W', '2026-04-09 07:23:35', '2026-04-09 07:23:35', 0, 1800, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2xjLH9YTTW9cc3jHiuUnk1On5BW6cxwE4WEsKRhd', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV3dsTTlHTHAxekVrT2drRUtBa0k3eHhvZE9TQlhnNWRncWJhS2pFNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0LzIiO3M6NToicm91dGUiO3M6MTQ6InByb2R1Y3QuZGV0YWlsIjt9czo0OiJjYXJ0IjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1776748082),
('qEAdYXPcAyqotKHJxoNfqgK4xUm6q3dO4eLwMCp5', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiclU5NEhteXptTFZkUmptQldNQm5GNXFKZEpiVWpjeG1QS0ZRMVNwaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1776747867);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `google_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Administrator', 'admin@gmail.com', NULL, NULL, '$2y$12$QSipw.oPWxSb6P1aacEURuL//0yjr/Qk5iicUAjPuUJStCHm9cSnm', NULL, '2026-04-09 07:23:35', '2026-04-09 07:23:35', 'admin'),
(2, 'Nguyễn Văn A', 'user@gmail.com', NULL, NULL, '$2y$12$m1MuK0Kvz6SDAq7hllh4NuXbHfCvH4oW.7z2kwR03wcirWk2AvANa', NULL, '2026-04-09 07:23:35', '2026-04-09 07:23:35', 'user'),
(3, 'Trần Thị B', 'user2@gmail.com', NULL, NULL, '$2y$12$IPtq4aiWm.P73IiJPa0Sr.uyjayDy2AhWBuAE2gkE1tl/2Q2sge4C', NULL, '2026-04-09 07:23:35', '2026-04-09 07:23:35', 'user'),
(4, 'Phạm Văn Phú', 'phudbrr@gmail.com', NULL, NULL, '$2y$12$mFyW05MyLvJgRnyOIz3gS.b50uJeU1NCKCTF8q7XyjYUkeNmdb/Wa', NULL, '2026-04-12 20:35:01', '2026-04-12 20:35:01', 'user'),
(5, 'Mai Anh Thức', 'maianhthuc2206@gmail.com', NULL, NULL, '$2y$12$m1M03XItZx7Es9yJx2tqMuOJAHLuC/xUX.55DRvFC0o1n.m/qjrkO', NULL, '2026-04-15 23:33:12', '2026-04-15 23:33:12', 'admin'),
(6, 'Lê Hữu Chinh', 'lechinh.12122003@gmail.com', NULL, NULL, '$2y$12$sDOO48Qulw9/BSwb0YFIhO0/iWVpAe4kZ99pHEPDYGsoBSB0uAW.y', NULL, '2026-04-19 18:43:39', '2026-04-19 18:43:39', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_phone_id_foreign` (`phone_id`);

--
-- Chỉ mục cho bảng `password_reset_otps`
--
ALTER TABLE `password_reset_otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_reset_otps_email_index` (`email`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phones_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_phone_id_foreign` (`phone_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_parent_id_foreign` (`parent_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `password_reset_otps`
--
ALTER TABLE `password_reset_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `phones`
--
ALTER TABLE `phones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_phone_id_foreign` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `phones`
--
ALTER TABLE `phones`
  ADD CONSTRAINT `phones_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_phone_id_foreign` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
