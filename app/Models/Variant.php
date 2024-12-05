<?php
namespace App\Models;

use App\Observers\VariantObserver;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'product_id',
        'sku',
        'stock',
        'price_modifier',
        'image'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes()
    {
        return $this->hasMany(VariantAttribute::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->product->base_price + $this->price_modifier;
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
