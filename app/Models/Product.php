<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const TYPE_HAVE_VARIATION = 'có biến thể';
    const TYPE_NO_VARIATION = 'không có biến thể';

    protected $fillable = [
        'name',
        'slug',
        'base_price',
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

    public function categories(){
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function galleries(){
        return $this->hasMany(Gallery::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
