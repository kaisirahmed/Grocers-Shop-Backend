<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeCategory extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'name_bn',
        'slug',
        'tag_id',
        'image',
        'status',
    ];
}
