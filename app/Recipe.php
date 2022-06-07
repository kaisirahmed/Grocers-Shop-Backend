<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'product_id',
        'banner',
        'title',
        'slug',
        'serves',
        'preparation_time',
        'coock_time',
        'status',
    ];
}
