<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    protected $primaryKey =  "product_media_id";
    protected $table = "product_medias";

    protected $fillable = [
        "product_id",
        "file_path",
        "media_type",
    ];

    public function getMediaProduct(){
        return $this->belongsTo(Product::class, 'product_id', "product_id");
    }
}
