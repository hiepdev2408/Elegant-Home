<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouseExport extends Model
{
    use HasFactory;
    protected $fillable = [
        'warehouse_id',
        'user_id',
        'quantity',
        'Shipment_date',
        'note',
    ];
    public function warehouse(){
        return $this->belongsTo(warehouse::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
