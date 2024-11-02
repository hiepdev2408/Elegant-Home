<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug'; // Đặt trường `slug` là khóa tìm kiếm thay vì `id`
    }

    protected $fillable = [
        'name',
        'slug',
        'base_price',
        'price_sale',
        'img_thumbnail',
        'description',
        'user_manual',
        'content',
        'view',
        'is_active',
        'is_good_deal',
        'is_new',
        'is_show_home',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_good_deal' => 'boolean',
        'is_new' => 'boolean',
        'is_show_home' => 'boolean',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
