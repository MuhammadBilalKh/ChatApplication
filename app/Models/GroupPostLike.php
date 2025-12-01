<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPostLike extends Model
{
    protected $primaryKey = "group_post_like_id";

    protected $table = "group_posts_likes";

    protected $fillable = ["post_id", "user_id"];
}
