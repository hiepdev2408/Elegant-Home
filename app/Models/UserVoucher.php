<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVoucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'voucher_id',
    ];

    // Thiết lập mối quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Thiết lập mối quan hệ với Voucher
    public function voucher()
    {
        return $this->belongsTo(Vouchers::class);
    }
}
