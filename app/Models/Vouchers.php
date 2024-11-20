<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model {
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_amount',
        'discount_percent',
        'start_date',
        'end_date',
        'usage_limit',
        'used_count',
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'product_voucher','voucher_id','product_id');
    }
    // Hàm kiểm tra tính hợp lệ của voucher
    public function isValid()
    {
        return $this->start_date <= now() && $this->end_date >= now();
    }

    // Hàm tính toán tổng tiền với voucher
   
}
