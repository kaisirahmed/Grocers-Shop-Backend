<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    protected $fillable = [
    	'name',
		'image',
		'is_default',
		'gateway_link',
		'status',
    ];
}
