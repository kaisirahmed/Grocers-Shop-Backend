<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'mobile_number',
        'area',
        'address',
        'area_bn',
        'is_default',
    ];
}
