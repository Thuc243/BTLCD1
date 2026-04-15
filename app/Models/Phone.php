<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'category_id',
        'sold',
        'is_featured'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    /**
     * Điểm đánh giá trung bình (chỉ tính review gốc có rating)
     */
    public function avgRating(){
        return $this->reviews()->whereNull('parent_id')->whereNotNull('rating')->avg('rating') ?? 0;
    }

    /**
     * Số lượng đánh giá (chỉ tính review gốc)
     */
    public function reviewCount(){
        return $this->reviews()->whereNull('parent_id')->count();
    }
}