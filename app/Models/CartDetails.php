<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'combination_id',
        'name',
    ];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function combination(){
        return $this->belongsTo(Combination::class);
    }
}
