<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionStaff extends Model
{
    protected $fillable = [
    	'staff_id',
    	'permission_id',
    ];
}
