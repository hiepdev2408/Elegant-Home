<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'name_person',
        'email_person',
        'address_person',
        'current_address',
        'phone_person',
        'status',
        'name_receiver',
        'email_receiver',
        'address_receiver',
        'phone_receiver',
        'total_amount',
        'status_orders',
    ];

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
