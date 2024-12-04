<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'quantity',
        'total_amount',
    ];

    protected static function boot()
    {
        parent::boot();

        // Sự kiện "saving" sẽ được kích hoạt trước khi lưu bản ghi
        static::saving(function ($orderDetail) {
            // Nếu có `variant_id`, thì `product_id` phải là null
            if ($orderDetail->variant_id) {
                $orderDetail->product_id = null;
            }
            // Ngược lại, nếu không có `variant_id`, phải có `product_id`
            elseif ($orderDetail->product_id) {
                $orderDetail->variant_id = null;
            } else {
                throw new ModelNotFoundException('Order item must have either a product_id or a variant_id.');
            }
        });
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function variant(){
        return $this->belongsTo(Variant::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
