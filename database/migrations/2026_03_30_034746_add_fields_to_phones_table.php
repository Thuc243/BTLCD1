<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('phones', function (Blueprint $table) {
            $table->boolean('is_featured')->default(0); // sản phẩm nổi bật
            $table->integer('sold')->default(0); // số lượng bán
            $table->unsignedBigInteger('category_id')->nullable(); // hãng

            // tạo khóa ngoại (nếu đã có bảng categories)
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phones', function (Blueprint $table) {

            // xóa khóa ngoại trước
            $table->dropForeign(['category_id']);

            // xóa cột
            $table->dropColumn([
                'is_featured',
                'sold',
                'category_id'
            ]);
        });
    }
};