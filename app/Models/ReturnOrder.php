<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'reason',
        'total_amount',
        'refund_on',
        'note',
        'email'
    ];


    public function order()
    {
        $this->belongsTo(Order::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function proveRefunds()
    {
        $this->hasMany(ProveRefund::class);
    }
}
