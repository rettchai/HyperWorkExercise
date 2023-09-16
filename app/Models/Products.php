<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_th',
        'name_en',
        'price',
        'products_categories_id',
        'active',
    ];

    public function product_category()
    {
        return $this->hasOne(ProductsCategory::class, 'id', 'products_categories_id');
    }
}
