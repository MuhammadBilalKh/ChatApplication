<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = "product_id";

    protected $table = "products";

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'uploaded_by', "is_featured",
    ];

    protected $casts = [
        'attributes' => 'array',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductMedia::class, 'product_id', "product_id");
    }

    public function getCurrentPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }

    public function getUploader(){
        return $this->belongsTo(User::class, "uploaded_by", "user_id");
    }

    public function getHasDiscountAttribute()
    {
        return !is_null($this->sale_price) && $this->sale_price < $this->price;
    }

    public function setNameAttribute($val){
        return $this->attributes['name'] = ucwords($val);
    }
}
