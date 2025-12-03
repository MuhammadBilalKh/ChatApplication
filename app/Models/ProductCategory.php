<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    protected $primaryKey = 'product_category_id';

    protected $fillable = [
        'name', 'slug', "product_id",
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
