<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $primaryKey = "user_meta_id";

    protected $table = "users_meta";

    protected $fillable = ["user_id", "date_of_birth", "sex", "city", "country"];

    public function getMetaUser(){
        return $this->belongsTo(User::class, 'user_id', "user_id");
    }
}
