<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories_th',
        'categories_en',
        'active',
    ];

    public function OrdersUser()
    {
        return $this->hasMany(Products::class, 'products_categories_id', 'id');
    }
}
