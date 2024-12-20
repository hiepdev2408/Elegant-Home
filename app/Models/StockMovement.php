<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'variant_id',
        'quantity',
        'type',
        'Total_import_price',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }

}
