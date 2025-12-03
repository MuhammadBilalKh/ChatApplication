<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLineItem extends Model
{
    protected $primaryKey = "order_line_item_id";

    protected $table = "order_line_item";

    protected $fillable = [
        "user_id",
        "product_id",
        "quantity",
        "vendor_id",
        "status"
    ];

    public function getProductVendor(){
        return $this->belongsTo(User::class, 'vendor_id', "user_id");
    }

    public function getPurchase(){
        return $this->belongsTo(User::class, "user_id", "user_id");
    }

    public function getLineItemProduct(){
        return $this->belongsTo(Product::class, "product_id", "product_id");
    }
}
