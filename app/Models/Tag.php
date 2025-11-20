<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $primaryKey = "tag_id";

    protected $table = "tags";

    protected $fillable = ["name", "slug"];

    public function setNameAttribute($val){
        return $this->attributes['name'] = ucfirst($val);
    }
}
