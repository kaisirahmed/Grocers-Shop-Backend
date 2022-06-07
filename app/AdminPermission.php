<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $fillable = [
    	'admin_id',
    	'permission_id',
    ];
}
