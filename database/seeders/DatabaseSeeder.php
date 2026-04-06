<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Phone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Tạo tài khoản Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);

        // 2. Tạo tài khoản User mẫu
        User::create([
            'name' => 'Nguyễn Văn A',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user'
        ]);

        // 3. Tạo danh mục
        $iphone = Category::create(['name' => 'iPhone']);
        $samsung = Category::create(['name' => 'Samsung']);
        $xiaomi = Category::create(['name' => 'Xiaomi']);

        // 4. Tạo sản phẩm mẫu
        Phone::create([
            'name' => 'iPhone 15 Pro Max 256GB',
            'price' => 29990000,
            'image' => 'iphone-15-pro-max.jpg',
            'description' => 'iPhone 15 Pro Max. Màn hình 6.7 inch, chip A17 Pro mạnh mẽ nhất.',
            'category_id' => $iphone->id,
            'sold' => 1500,
            'is_featured' => true
        ]);

        Phone::create([
            'name' => 'Samsung Galaxy S24 Ultra',
            'price' => 26990000,
            'image' => 'samsung-s24-ultra.jpg',
            'description' => 'Samsung Galaxy S24 Ultra với AI dịch thuật trực tiếp.',
            'category_id' => $samsung->id,
            'sold' => 1200,
            'is_featured' => true
        ]);

        Phone::create([
            'name' => 'Xiaomi 14 Pro',
            'price' => 18990000,
            'image' => 'xiaomi-14-pro.jpg',
            'description' => 'Siêu phẩm Xiaomi với ống kính Leica thế hệ mới.',
            'category_id' => $xiaomi->id,
            'sold' => 800,
            'is_featured' => false
        ]);
        
        Phone::create([
            'name' => 'iPhone 13 128GB',
            'price' => 13990000,
            'image' => 'iphone-13.jpg',
            'description' => 'Sản phẩm quốc dân của Apple.',
            'category_id' => $iphone->id,
            'sold' => 5000,
            'is_featured' => false
        ]);
    }
}
