<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'SKU',
        'stock',
        'price',
        'price_sale',
        'img_variant',
    ];

    public function combinations(){
        return $this->hasMany(Combination::class);
    }
}
