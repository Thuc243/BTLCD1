<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Phone;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $admin = User::create(['name'=>'Administrator','email'=>'admin@gmail.com','password'=>bcrypt('12345678'),'role'=>'admin']);
        $u1 = User::create(['name'=>'Nguyễn Văn A','email'=>'user@gmail.com','password'=>bcrypt('12345678'),'role'=>'user']);
        $u2 = User::create(['name'=>'Trần Thị B','email'=>'user2@gmail.com','password'=>bcrypt('12345678'),'role'=>'user']);

        $ip = Category::create(['name'=>'iPhone']);
        $ss = Category::create(['name'=>'Samsung']);
        $xm = Category::create(['name'=>'Xiaomi']);
        $op = Category::create(['name'=>'OPPO']);
        $vv = Category::create(['name'=>'Vivo']);

        // ═══ iPHONE ═══
        Phone::create(['name'=>'iPhone 16 Pro Max 256GB','price'=>34990000,'image'=>'iphone16promax.png','category_id'=>$ip->id,'sold'=>2100,'is_featured'=>true,
            'description'=>"iPhone 16 Pro Max - Siêu phẩm mới nhất của Apple với chip A18 Pro, màn hình Super Retina XDR 6.9 inch lớn nhất từ trước đến nay. Thiết kế titan cao cấp, camera 48MP nâng cấp mạnh mẽ và Apple Intelligence tích hợp.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.9 inch Super Retina XDR OLED, 120Hz ProMotion, 2868x1320\n• Chip: Apple A18 Pro (3nm thế hệ 2)\n• Camera sau: 48MP f/1.78 chính + 48MP Ultra Wide + 12MP Telephoto 5x\n• Camera trước: 12MP TrueDepth, Face ID\n• RAM: 8GB\n• Bộ nhớ: 256GB\n• Pin: 4685 mAh, sạc nhanh 27W, MagSafe 25W\n• Hệ điều hành: iOS 18\n• Chống nước: IP68\n• Trọng lượng: 227g\n• Đặc biệt: Nút Camera Control, khung Titan, USB-C 3.0, Apple Intelligence"]);

        Phone::create(['name'=>'iPhone 16 Pro 128GB','price'=>28990000,'image'=>'iphone16pro.png','category_id'=>$ip->id,'sold'=>1800,'is_featured'=>true,
            'description'=>"iPhone 16 Pro với chip A18 Pro mạnh mẽ, nút Camera Control mới và khung titan siêu nhẹ. Trải nghiệm chơi game và chụp ảnh đỉnh cao.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.3 inch Super Retina XDR OLED, 120Hz ProMotion\n• Chip: Apple A18 Pro (3nm)\n• Camera sau: 48MP + 48MP Ultra Wide + 12MP Telephoto 5x\n• Camera trước: 12MP TrueDepth\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 3582 mAh, sạc nhanh 27W\n• Hệ điều hành: iOS 18\n• Chống nước: IP68\n• Đặc biệt: Camera Control, Titan, Apple Intelligence"]);

        Phone::create(['name'=>'iPhone 16 128GB','price'=>22990000,'image'=>'iphone16.png','category_id'=>$ip->id,'sold'=>1500,'is_featured'=>false,
            'description'=>"iPhone 16 với chip A18, camera 48MP và nút Camera Control hoàn toàn mới. Thiết kế sắc nét với nhiều màu sắc trẻ trung.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.1 inch Super Retina XDR OLED, 60Hz\n• Chip: Apple A18\n• Camera sau: 48MP + 12MP Ultra Wide\n• Camera trước: 12MP TrueDepth\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 3561 mAh\n• Hệ điều hành: iOS 18\n• Chống nước: IP68"]);

        Phone::create(['name'=>'iPhone 15 Pro Max 256GB','price'=>29990000,'image'=>'iphone15promax.png','category_id'=>$ip->id,'sold'=>3500,'is_featured'=>true,
            'description'=>"iPhone 15 Pro Max - Flagship đỉnh cao với chip A17 Pro 3nm, camera zoom quang 5x và thiết kế khung titan siêu nhẹ. Quay video ProRes 4K.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.7 inch Super Retina XDR, 120Hz ProMotion\n• Chip: Apple A17 Pro (3nm)\n• Camera sau: 48MP + 12MP UW + 12MP Telephoto 5x\n• Camera trước: 12MP\n• RAM: 8GB\n• Bộ nhớ: 256GB\n• Pin: 4422 mAh, sạc 27W\n• Hệ điều hành: iOS 17\n• Chống nước: IP68\n• Đặc biệt: Action Button, Titan, USB-C, ProRes 4K"]);

        Phone::create(['name'=>'iPhone 15 128GB','price'=>19990000,'image'=>'iphone15.png','category_id'=>$ip->id,'sold'=>4200,'is_featured'=>false,
            'description'=>"iPhone 15 với Dynamic Island, camera 48MP và USB-C. Thiết kế kính mờ và viền nhôm.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.1 inch Super Retina XDR OLED\n• Chip: Apple A16 Bionic\n• Camera sau: 48MP + 12MP\n• Camera trước: 12MP\n• RAM: 6GB\n• Bộ nhớ: 128GB\n• Pin: 3349 mAh\n• Chống nước: IP68"]);

        Phone::create(['name'=>'iPhone 14 128GB','price'=>16990000,'image'=>'iphone14.png','category_id'=>$ip->id,'sold'=>5500,'is_featured'=>false,
            'description'=>"iPhone 14 giá tốt nhất với chip A15 Bionic vẫn cực mạnh.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.1 inch Super Retina XDR\n• Chip: Apple A15 Bionic\n• Camera sau: 12MP + 12MP\n• Camera trước: 12MP\n• RAM: 6GB\n• Bộ nhớ: 128GB\n• Pin: 3279 mAh\n• Chống nước: IP68"]);

        Phone::create(['name'=>'iPhone 13 128GB','price'=>13990000,'image'=>'iphone13.png','category_id'=>$ip->id,'sold'=>7000,'is_featured'=>false,
            'description'=>"Sản phẩm quốc dân Apple. Pin dùng cả ngày.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.1 inch Super Retina XDR\n• Chip: Apple A15 Bionic\n• Camera sau: 12MP + 12MP\n• RAM: 4GB\n• Bộ nhớ: 128GB\n• Pin: 3227 mAh\n• Chống nước: IP68"]);

        Phone::create(['name'=>'iPhone SE 2022 64GB','price'=>10990000,'image'=>'iphonese.png','category_id'=>$ip->id,'sold'=>3000,'is_featured'=>false,
            'description'=>"iPhone SE nhỏ gọn với chip A15 Bionic, Touch ID.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 4.7 inch Retina HD IPS\n• Chip: Apple A15 Bionic\n• Camera sau: 12MP\n• RAM: 4GB\n• Bộ nhớ: 64GB\n• Pin: 2018 mAh\n• Chống nước: IP67"]);

        // ═══ SAMSUNG ═══
        Phone::create(['name'=>'Samsung Galaxy S24 Ultra 256GB','price'=>28990000,'image'=>'galaxys24ultra.png','category_id'=>$ss->id,'sold'=>2300,'is_featured'=>true,
            'description'=>"Galaxy S24 Ultra - AI Galaxy, camera 200MP, S Pen, khung titan.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.8 inch Dynamic AMOLED 2X, QHD+, 120Hz\n• Chip: Snapdragon 8 Gen 3 for Galaxy\n• Camera sau: 200MP + 12MP + 10MP 3x + 50MP 5x\n• Camera trước: 12MP\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 5000 mAh, sạc 45W\n• Chống nước: IP68\n• Đặc biệt: S Pen, Galaxy AI, Titan, Gorilla Armor"]);

        Phone::create(['name'=>'Samsung Galaxy S24+ 256GB','price'=>22990000,'image'=>'galaxys24.png','category_id'=>$ss->id,'sold'=>1100,'is_featured'=>false,
            'description'=>"Galaxy S24+ với AI thông minh, màn lớn.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.7 inch Dynamic AMOLED 2X, FHD+, 120Hz\n• Chip: Exynos 2400\n• Camera sau: 50MP + 12MP + 10MP 3x\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 4900 mAh, sạc 45W\n• Đặc biệt: Galaxy AI, Circle to Search"]);

        Phone::create(['name'=>'Samsung Galaxy S24 128GB','price'=>18990000,'image'=>'galaxys24.png','category_id'=>$ss->id,'sold'=>1400,'is_featured'=>false,
            'description'=>"Galaxy S24 gọn nhẹ với Galaxy AI.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.2 inch Dynamic AMOLED 2X, FHD+, 120Hz\n• Chip: Exynos 2400\n• Camera sau: 50MP + 12MP + 10MP 3x\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 4000 mAh, sạc 25W"]);

        Phone::create(['name'=>'Samsung Galaxy Z Fold5 256GB','price'=>35990000,'image'=>'galaxyzfold5.png','category_id'=>$ss->id,'sold'=>500,'is_featured'=>true,
            'description'=>"Galaxy Z Fold5 - Gập cao cấp nhất.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình chính: 7.6 inch Dynamic AMOLED 2X, 120Hz\n• Màn hình phụ: 6.2 inch\n• Chip: Snapdragon 8 Gen 2\n• Camera sau: 50MP + 12MP + 10MP 3x\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 4400 mAh\n• Chống nước: IPX8"]);

        Phone::create(['name'=>'Samsung Galaxy Z Flip5 256GB','price'=>22990000,'image'=>'galaxyzflip5.png','category_id'=>$ss->id,'sold'=>800,'is_featured'=>false,
            'description'=>"Galaxy Z Flip5 thời trang.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình chính: 6.7 inch Dynamic AMOLED 2X\n• Màn hình phụ: 3.4 inch Super AMOLED\n• Chip: Snapdragon 8 Gen 2\n• Camera sau: 12MP + 12MP\n• RAM: 8GB\n• Bộ nhớ: 256GB\n• Pin: 3700 mAh\n• Chống nước: IPX8"]);

        Phone::create(['name'=>'Samsung Galaxy A55 5G 128GB','price'=>9990000,'image'=>'generic_phone_blue.png','category_id'=>$ss->id,'sold'=>3500,'is_featured'=>false,
            'description'=>"Galaxy A55 tầm trung cao cấp.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.6 inch Super AMOLED, FHD+, 120Hz\n• Chip: Exynos 1480\n• Camera sau: 50MP OIS + 12MP + 5MP\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 25W\n• Chống nước: IP67"]);

        Phone::create(['name'=>'Samsung Galaxy A35 5G 128GB','price'=>7990000,'image'=>'generic_phone_blue.png','category_id'=>$ss->id,'sold'=>4000,'is_featured'=>false,
            'description'=>"Galaxy A35 thiết kế đẹp.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.6 inch Super AMOLED, FHD+, 120Hz\n• Chip: Exynos 1380\n• Camera sau: 50MP OIS + 8MP + 5MP\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 25W\n• Chống nước: IP67"]);

        Phone::create(['name'=>'Samsung Galaxy A15 128GB','price'=>4490000,'image'=>'generic_phone_dark.png','category_id'=>$ss->id,'sold'=>6000,'is_featured'=>false,
            'description'=>"Galaxy A15 giá rẻ, pin trâu.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.5 inch Super AMOLED, FHD+, 90Hz\n• Chip: Helio G99\n• Camera sau: 50MP + 5MP + 2MP\n• RAM: 4GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 15W"]);

        // ═══ XIAOMI ═══
        Phone::create(['name'=>'Xiaomi 14 Ultra 512GB','price'=>23990000,'image'=>'xiaomi14ultra.png','category_id'=>$xm->id,'sold'=>700,'is_featured'=>true,
            'description'=>"Xiaomi 14 Ultra - 4 camera Leica, cảm biến 1 inch.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.73 inch LTPO AMOLED, 2K, 120Hz, 3000 nits\n• Chip: Snapdragon 8 Gen 3\n• Camera sau: 50MP 1\" Leica + 50MP UW + 50MP 3.2x + 50MP 5x\n• RAM: 16GB\n• Bộ nhớ: 512GB\n• Pin: 5300 mAh, sạc 90W + wireless 50W\n• Đặc biệt: 4 camera Leica Summilux, Sony LYT-900"]);

        Phone::create(['name'=>'Xiaomi 14 Pro 256GB','price'=>18990000,'image'=>'xiaomi14.png','category_id'=>$xm->id,'sold'=>900,'is_featured'=>false,
            'description'=>"Xiaomi 14 Pro Leica, sạc 120W.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.73 inch LTPO AMOLED, 2K, 120Hz\n• Chip: Snapdragon 8 Gen 3\n• Camera sau: 50MP Leica + 50MP UW + 50MP 3.2x\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 4880 mAh, sạc 120W"]);

        Phone::create(['name'=>'Xiaomi 14 256GB','price'=>14990000,'image'=>'xiaomi14.png','category_id'=>$xm->id,'sold'=>1300,'is_featured'=>false,
            'description'=>"Xiaomi 14 nhỏ gọn mạnh mẽ.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.36 inch LTPO AMOLED, 1.5K, 120Hz\n• Chip: Snapdragon 8 Gen 3\n• Camera sau: 50MP Leica + 50MP UW + 50MP 3.2x\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 4610 mAh, sạc 90W"]);

        Phone::create(['name'=>'Xiaomi POCO F6 Pro 256GB','price'=>12990000,'image'=>'generic_phone_dark.png','category_id'=>$xm->id,'sold'=>1500,'is_featured'=>false,
            'description'=>"POCO F6 Pro hiệu năng monster.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.67 inch AMOLED, 2K, 120Hz\n• Chip: Snapdragon 8 Gen 2\n• Camera sau: 50MP OIS + 8MP + 2MP\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 5000 mAh, sạc 120W"]);

        Phone::create(['name'=>'Xiaomi Redmi Note 13 Pro+ 256GB','price'=>8990000,'image'=>'redminote13proplus.png','category_id'=>$xm->id,'sold'=>4500,'is_featured'=>false,
            'description'=>"Redmi Note 13 Pro+ camera 200MP, sạc 120W.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.67 inch AMOLED, FHD+, 120Hz\n• Chip: Dimensity 7200 Ultra\n• Camera sau: 200MP OIS + 8MP + 2MP\n• RAM: 8GB\n• Bộ nhớ: 256GB\n• Pin: 5000 mAh, sạc 120W\n• Chống nước: IP68"]);

        Phone::create(['name'=>'Xiaomi Redmi Note 13 128GB','price'=>4990000,'image'=>'generic_phone_blue.png','category_id'=>$xm->id,'sold'=>5500,'is_featured'=>false,
            'description'=>"Redmi Note 13 giá tốt.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.67 inch AMOLED, FHD+, 120Hz\n• Chip: Snapdragon 685\n• Camera sau: 108MP + 8MP + 2MP\n• RAM: 6GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 33W"]);

        Phone::create(['name'=>'Xiaomi POCO X6 256GB','price'=>6990000,'image'=>'generic_phone_blue.png','category_id'=>$xm->id,'sold'=>2800,'is_featured'=>false,
            'description'=>"POCO X6 hiệu năng tốt.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.67 inch AMOLED, FHD+, 120Hz\n• Chip: Snapdragon 7s Gen 2\n• Camera sau: 64MP + 8MP + 2MP\n• RAM: 8GB\n• Bộ nhớ: 256GB\n• Pin: 5100 mAh, sạc 67W"]);

        Phone::create(['name'=>'Xiaomi Redmi 13C 128GB','price'=>3290000,'image'=>'generic_phone_dark.png','category_id'=>$xm->id,'sold'=>7000,'is_featured'=>false,
            'description'=>"Redmi 13C giá rẻ, pin trâu.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.74 inch IPS LCD, HD+, 90Hz\n• Chip: Helio G85\n• Camera sau: 50MP + 2MP\n• RAM: 4GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 18W"]);

        // ═══ OPPO ═══
        Phone::create(['name'=>'OPPO Find X7 Ultra 256GB','price'=>22990000,'image'=>'findx7ultra.png','category_id'=>$op->id,'sold'=>450,'is_featured'=>true,
            'description'=>"OPPO Find X7 Ultra - Hasselblad dual periscope.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.82 inch LTPO AMOLED, 2K, 120Hz\n• Chip: Snapdragon 8 Gen 3\n• Camera sau: 50MP + 50MP UW + 50MP 3x + 50MP 6x Hasselblad\n• RAM: 16GB\n• Bộ nhớ: 256GB\n• Pin: 5400 mAh, sạc 100W SUPERVOOC"]);

        Phone::create(['name'=>'OPPO Find N3 Flip 256GB','price'=>19990000,'image'=>'generic_phone_green.png','category_id'=>$op->id,'sold'=>600,'is_featured'=>false,
            'description'=>"OPPO Find N3 Flip thời trang Hasselblad.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình chính: 6.8 inch AMOLED, FHD+, 120Hz\n• Màn hình phụ: 3.26 inch AMOLED\n• Chip: Dimensity 9200\n• Camera sau: 50MP Hasselblad + 48MP + 32MP Tele\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 4300 mAh, sạc 44W"]);

        Phone::create(['name'=>'OPPO Reno 11 Pro 5G 256GB','price'=>12990000,'image'=>'reno11pro.png','category_id'=>$op->id,'sold'=>900,'is_featured'=>false,
            'description'=>"Reno 11 Pro thiết kế mỏng nhẹ.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.7 inch AMOLED, FHD+, 120Hz\n• Chip: Dimensity 8200\n• Camera sau: 50MP + 8MP + 32MP Tele 2x\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 4600 mAh, sạc 80W SUPERVOOC"]);

        Phone::create(['name'=>'OPPO Reno 11 5G 128GB','price'=>8990000,'image'=>'reno11pro.png','category_id'=>$op->id,'sold'=>1200,'is_featured'=>false,
            'description'=>"Reno 11 camera AI chân dung.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.7 inch AMOLED, FHD+, 120Hz\n• Chip: Dimensity 7050\n• Camera sau: 50MP + 8MP + 2MP\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 67W SUPERVOOC"]);

        Phone::create(['name'=>'OPPO A79 5G 128GB','price'=>5990000,'image'=>'generic_phone_green.png','category_id'=>$op->id,'sold'=>2200,'is_featured'=>false,
            'description'=>"OPPO A79 5G giá tốt.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.72 inch IPS LCD, FHD+, 90Hz\n• Chip: Dimensity 6020\n• Camera sau: 50MP + 2MP\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 33W"]);

        Phone::create(['name'=>'OPPO A58 128GB','price'=>4490000,'image'=>'generic_phone_dark.png','category_id'=>$op->id,'sold'=>3000,'is_featured'=>false,
            'description'=>"OPPO A58 pin trâu.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.72 inch IPS LCD, FHD+, 90Hz\n• Chip: Helio G85\n• Camera sau: 50MP + 2MP\n• RAM: 6GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 33W"]);

        Phone::create(['name'=>'OPPO A18 128GB','price'=>3290000,'image'=>'generic_phone_dark.png','category_id'=>$op->id,'sold'=>4500,'is_featured'=>false,
            'description'=>"OPPO A18 giá rẻ.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.56 inch IPS LCD, HD+, 90Hz\n• Chip: Helio G85\n• Camera sau: 8MP + 2MP\n• RAM: 4GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 10W"]);

        Phone::create(['name'=>'OPPO A38 128GB','price'=>3790000,'image'=>'generic_phone_green.png','category_id'=>$op->id,'sold'=>3800,'is_featured'=>false,
            'description'=>"OPPO A38 siêu tiết kiệm.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.56 inch IPS LCD, HD+, 90Hz\n• Chip: Helio G85\n• Camera sau: 50MP + 2MP\n• RAM: 4GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 33W"]);

        // ═══ VIVO ═══
        Phone::create(['name'=>'Vivo X100 Pro 256GB','price'=>19990000,'image'=>'vivox100pro.png','category_id'=>$vv->id,'sold'=>600,'is_featured'=>true,
            'description'=>"Vivo X100 Pro camera ZEISS, zoom 4.3x.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.78 inch LTPO AMOLED, 2K, 120Hz\n• Chip: Dimensity 9300\n• Camera sau: 50MP ZEISS + 50MP UW + 64MP Tele 4.3x\n• RAM: 16GB\n• Bộ nhớ: 256GB\n• Pin: 5400 mAh, sạc 100W\n• Đặc biệt: Camera ZEISS APO, chip V3"]);

        Phone::create(['name'=>'Vivo V30 Pro 256GB','price'=>12990000,'image'=>'vivov30pro.png','category_id'=>$vv->id,'sold'=>750,'is_featured'=>false,
            'description'=>"Vivo V30 Pro aura light chân dung.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.78 inch AMOLED, FHD+, 120Hz\n• Chip: Snapdragon 7 Gen 3\n• Camera sau: 50MP OIS + 50MP UW + 50MP Tele 2x\n• RAM: 12GB\n• Bộ nhớ: 256GB\n• Pin: 5000 mAh, sạc 80W"]);

        Phone::create(['name'=>'Vivo V30 128GB','price'=>8990000,'image'=>'vivov30pro.png','category_id'=>$vv->id,'sold'=>1000,'is_featured'=>false,
            'description'=>"Vivo V30 thiết kế sang trọng.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.78 inch AMOLED, FHD+, 120Hz\n• Chip: Snapdragon 7 Gen 3\n• Camera sau: 50MP OIS + 8MP UW\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 80W"]);

        Phone::create(['name'=>'Vivo V29e 128GB','price'=>7490000,'image'=>'generic_phone_blue.png','category_id'=>$vv->id,'sold'=>1200,'is_featured'=>false,
            'description'=>"Vivo V29e mỏng nhẹ, selfie 50MP.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.67 inch AMOLED, FHD+, 120Hz\n• Chip: Snapdragon 695\n• Camera sau: 64MP + 8MP UW\n• Camera trước: 50MP\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 4800 mAh, sạc 44W"]);

        Phone::create(['name'=>'Vivo Y36 128GB','price'=>4490000,'image'=>'generic_phone_blue.png','category_id'=>$vv->id,'sold'=>2800,'is_featured'=>false,
            'description'=>"Vivo Y36 trẻ trung, pin trâu.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.64 inch IPS LCD, FHD+, 90Hz\n• Chip: Snapdragon 680\n• Camera sau: 50MP + 2MP\n• RAM: 8GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 18W"]);

        Phone::create(['name'=>'Vivo Y27 128GB','price'=>4990000,'image'=>'generic_phone_dark.png','category_id'=>$vv->id,'sold'=>2500,'is_featured'=>false,
            'description'=>"Vivo Y27 giá tốt.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.64 inch IPS LCD, HD+, 90Hz\n• Chip: Helio G85\n• Camera sau: 50MP + 2MP\n• RAM: 6GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 15W"]);

        Phone::create(['name'=>'Vivo Y17s 128GB','price'=>3690000,'image'=>'generic_phone_green.png','category_id'=>$vv->id,'sold'=>4000,'is_featured'=>false,
            'description'=>"Vivo Y17s giá rẻ sinh viên.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.56 inch IPS LCD, HD+, 60Hz\n• Chip: Helio G85\n• Camera sau: 50MP + 2MP\n• RAM: 4GB\n• Bộ nhớ: 128GB\n• Pin: 5000 mAh, sạc 15W"]);

        Phone::create(['name'=>'Vivo T2x 5G 128GB','price'=>4990000,'image'=>'generic_phone_blue.png','category_id'=>$vv->id,'sold'=>1800,'is_featured'=>false,
            'description'=>"Vivo T2x gaming tầm trung.\n\n📱 THÔNG SỐ KỸ THUẬT:\n• Màn hình: 6.58 inch IPS LCD, FHD+, 120Hz\n• Chip: Dimensity 6300\n• Camera sau: 50MP + 2MP\n• RAM: 6GB\n• Bộ nhớ: 128GB\n• Pin: 6000 mAh, sạc 44W"]);

        // ═══ ORDERS ═══
        $o1 = Order::create(['user_id'=>$u1->id,'customer_name'=>'Nguyễn Văn A','phone_number'=>'0901234567','address'=>'123 Nguyễn Huệ, Q1, HCM','total'=>34990000,'status'=>'completed','payment_method'=>'COD']);
        OrderItem::create(['order_id'=>$o1->id,'phone_id'=>1,'quantity'=>1,'price'=>34990000]);
        $o2 = Order::create(['user_id'=>$u2->id,'customer_name'=>'Trần Thị B','phone_number'=>'0912345678','address'=>'456 Lê Lợi, Q3, HCM','total'=>51980000,'status'=>'pending','payment_method'=>'QR']);
        OrderItem::create(['order_id'=>$o2->id,'phone_id'=>9,'quantity'=>1,'price'=>28990000]);
        OrderItem::create(['order_id'=>$o2->id,'phone_id'=>11,'quantity'=>1,'price'=>22990000]);
        $o3 = Order::create(['user_id'=>$u1->id,'customer_name'=>'Nguyễn Văn A','phone_number'=>'0901234567','address'=>'123 Nguyễn Huệ, Q1, HCM','total'=>23990000,'status'=>'cancelled','payment_method'=>'COD']);
        OrderItem::create(['order_id'=>$o3->id,'phone_id'=>17,'quantity'=>1,'price'=>23990000]);
    }
}
