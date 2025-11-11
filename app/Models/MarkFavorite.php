<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarkFavorite extends Model
{
    protected $fillable = ["post_id", "user_id"];

    protected $primaryKey = "mark_favorite_post_id";
}
