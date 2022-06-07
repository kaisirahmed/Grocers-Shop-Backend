<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Enums;

class Order extends Model
{
    use Enums;
    
    protected $fillable = [
        'user_id',
        'address_id',
        'product_id',
        'product_name',
        'quantity',
        'product_price',
        'price',
        'order_number',
        'invoice_number',
        'order_status',
        'payment_status',
        'payment_method',
        'order_date',
        'delivery_date',
        'discount_id',
        'coupon_id',
        'discount_amount',
        'delivery_charge',
        'delivery_man_id',
        'staff_id',
    ];

    protected $enumStatuses = [
        'order_status'
    ];

    protected $nullable = [
        'discount_id',
        'coupon_id',
        'discount_amount',
        'delivery_man_id',
        'staff_id',
        'order_number',
        'invoice_number',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function productOrders() {
        return $this->hasMany(ProductOrder::class);
    }
}
