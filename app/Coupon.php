<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'product_id',
        'swap_product_id',
        'validity',
        'flat_amount',
        'status',
    ];
}
