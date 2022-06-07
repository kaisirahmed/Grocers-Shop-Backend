<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
     
    protected $fillabel = [
        'product_id',
        'quantity',
        'unit_id',
        'selling_quantity',
        'total_quantity',
    ];

    protected $nullable = [
        'selling_quantity',
        'total_quantity',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
