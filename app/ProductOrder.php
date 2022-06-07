<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $fillable = [
        'product_id',
        'order_id',
        'product_name',
        'image',
        'image_type',
        'quantity',
        'unit_id',
        'price'
    ];
}
