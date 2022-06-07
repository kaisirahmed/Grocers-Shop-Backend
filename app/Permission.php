<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
    	'admin_id',
    	'create',
    	'edit',
    	'delete',
    	'view',
   	];

   	public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class);
    }
}
