<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    // Định dạng tên bảng
    protected $table = 'provinces';

    // Định dạng khóa chính
    protected $primaryKey = 'code';

    public $incrementing = false;

    public function districts(){
        return $this->hasMany(District::class, 'province_code', 'code');

        /**
         * Ở đây province_code là khóa ngoại của bảng districts
         * code là khóa chính của bảng provinces
         */
    }

    public function users(){
        return $this->hasMany(User::class, 'province_id', 'code');
    }
}
