<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'variant_attribute_id',
        'quantity',
        'total_amount',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function variantAttribute(){
        return $this->belongsTo(VariantAttribute::class);
    }
}
