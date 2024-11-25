<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_ORDER = [
        'pending'   => 'Chờ xác nhận',
        'comfirmed' => 'Đã xác nhận',
        'shipping'  => 'Đang giao hàng',
        'delivered' => 'Đã giao hàng',
        'canceled'  => 'Đơn hàng đã hủy',
    ];

    const STATUS_PAYMENT = [
        'unpaid' => 'Chưa thanh tóan',
        'paid'   => 'Đã thanh toán'
    ];

    const STATUS_ORDER_PENDING = 'pending';
    const STATUS_ORDER_COMFIRMED = 'comfirmed';
    const STATUS_ORDER_SHIPPING = 'shipping';
    const STATUS_ORDER_DELIVERED = 'delivered';
    const STATUS_ORDER_CANCELED = 'canceled';
    const STATUS_PAYMENT_UNPAID = 'unpaid';
    const STATUS_PAYMENT_PAID = 'paid';

    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'user_phone',
        'user_address',
        'user_address_all',
        'user_note',
        'is_ship_user_same_user',
        'ship_user_name',
        'ship_user_email',
        'ship_user_phone',
        'ship_user_address',
        'ship_user_note',
        'status_order',
        'status_payment',
        'total_amount'
    ];

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
