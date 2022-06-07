<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cms extends Model
{
    use SoftDeletes;
     
    protected $fillable = [
        'name',
        'name_bn',
        'slug',
        'content',
        'content_bn',
        'meta_title',
        'meta_title_bn',
        'meta_tags',
        'meta_description',
        'visibility',
        'status',
    ];

    protected $nullable = [
        'meta_title',
        'meta_title_bn',
        'meta_tags',
        'meta_description',
    ];
}
