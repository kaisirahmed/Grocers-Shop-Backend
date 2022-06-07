<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'name_bn',
        'sub_name',
        'sub_name_bn',
        'slug',
        'slug_bn',
        'category_id',
        'price',
        'image',
        'image_type',
        'description',
        'discount_amount',
        'discount_percentage',
        'sale_price',
        'special_offer',
        'special_image',
        'special_image_type',
        'quantity',
        'unit_id',
        'status',
        'meta_title',
        'meta_tags',
        'meta_description',
    ];

    protected $nullable = [
        'sub_name',
        'sub_name_bn',
        'discount_amount',
        'discount_percentage',
        'sale_price',
        'special_offer',
        'special_image',
        'special_image_type',
        'meta_title',
        'meta_tags',
        'meta_description',
    ];

    public function unit() 
    {
        return $this->belongsTo(Unit::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)
                    ->withTimestamps();
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

}
