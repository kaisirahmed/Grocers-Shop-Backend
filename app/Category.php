<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'parent_id',
        'name',
        'name_bn',
        'slug',
        'tags',
        'banner',
        'banner_type',
        'image',
        'image_type',
        'icon',
        'icon_type',
        'order_no',
        'status',
    ];

    protected $nullable = [
        'order_no',
        'icon',
        'icon_type'
    ];

    protected $casts = [
        'order_no' =>  'integer',
    ];

    public function getNameAttribute($name) {
        return ucwords($name);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subcategory()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('parent');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withTimestamps();
    }
}
