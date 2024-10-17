<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
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

    public function productAttributes(){
        return $this->hasMany(ProductAttribute::class);
    }
    // public function group(){
    //     return $this->belongsTo(Group::class);
    // }
}
