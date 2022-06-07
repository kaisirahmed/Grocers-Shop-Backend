<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $fillable = [
    	'site_name',
    	'slogan',
		'logo',
		'logo_type',
    	'meta_title',
    	'meta_description',
    	'meta_tags',
    ];
}
