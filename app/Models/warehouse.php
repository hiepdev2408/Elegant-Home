<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouse extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=[
      'product_id',
      'user_id',
      'quantity',
      'price_import',
      'date_import',
      'Date_manufacture',
      'Total_amount'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
