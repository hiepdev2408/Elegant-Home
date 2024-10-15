<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combination extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'product_attribute_id',
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function productAttribute(){
        return $this->belongsTo(ProductAttribute::class);
    }
}