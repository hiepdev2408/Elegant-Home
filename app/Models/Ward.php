<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    protected $table = 'wards';

    protected $primaryKey = 'code';

    public $incrementing = false;

    public function district(){
        return $this->belongsTo(District::class, 'district_code', 'code');
    }

    public function users(){
        return $this->hasMany(User::class, 'ward_id', 'code');
    }
}