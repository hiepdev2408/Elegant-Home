<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model {
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'quantity',
        'used',
        'minimum_order_value',
        'start_date',
        'end_date',
    ];

    

   
   
}
