<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Cấp quyền admin cho maianhthuc2206@gmail.com
     */
    public function up(): void
    {
        DB::table('users')
            ->where('email', 'maianhthuc2206@gmail.com')
            ->update(['role' => 'admin']);
    }

    /**
     * Đổi lại thành user
     */
    public function down(): void
    {
        DB::table('users')
            ->where('email', 'maianhthuc2206@gmail.com')
            ->update(['role' => 'user']);
    }
};
