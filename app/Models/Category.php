<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = "category_id";

    protected $fillable = ["category_title", "status"];

    public function setCategoryTitleAttribute($val){
        return $this->attributes["category_title"] = ucwords($val);
    }
}
