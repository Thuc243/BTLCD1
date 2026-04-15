<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'phone_id',
        'user_id',
        'parent_id',
        'rating',
        'content',
    ];

    /**
     * Người viết đánh giá
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Sản phẩm được đánh giá
     */
    public function phone()
    {
        return $this->belongsTo(Phone::class);
    }

    /**
     * Bình luận cha (nếu là reply)
     */
    public function parent()
    {
        return $this->belongsTo(Review::class, 'parent_id');
    }

    /**
     * Các reply của bình luận này
     */
    public function replies()
    {
        return $this->hasMany(Review::class, 'parent_id')->with('replies', 'user')->oldest();
    }

    /**
     * Kiểm tra đây là review gốc (có rating) hay reply
     */
    public function isReply()
    {
        return $this->parent_id !== null;
    }
}
