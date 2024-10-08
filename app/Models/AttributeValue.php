<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_id',
        'value'
    ];

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }

    public function productVariants(){
        return $this->belongsToMany(ProductVariant::class, 'product_variant_attribute_value', 'attribute_value_id', 'product_variant_id');
    }
}
