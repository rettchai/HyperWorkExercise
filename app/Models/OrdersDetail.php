<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'orders_id',
        'products_id',
        'products_name_th',
        'products_name_en',
        'price',
    ];

    public function product_detail()
    {
        return $this->hasOne(Products::class, 'id', 'products_id');
    }
}
