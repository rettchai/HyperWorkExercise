<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shipping_address',
        'receipt_address',
        'summary_price',
    ];

    public function OrdersUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function OrdersDetail()
    {
        return $this->hasMany(OrdersDetail::class, 'orders_id', 'id');
    }
}
