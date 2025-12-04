<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $table = 'orders';

    protected $fillable = [
        'cart_id', 'user_id', 'order_number', 'payment_method', 'status', 'subtotal', 'tax', 'discount', 'total', 'billing_name', 'billing_email', 'billing_phone', 'billing_address',
        'company_name',
        'region', "notes",
    ];

    public function getLineItems(){
        return $this->hasMany(OrderLineItem::class, 'order_line_item_id', "order_id");
    }

    public function setBillingNameAttribute($val){
        return $this->attributes['billing_name'] = ucwords($val);
    }

    public function orderPlacedBy(){
        return $this->belongsTo(User::class, 'user_id', "user_id");
    }
}
