<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarkFavoriteGroupPost extends Model
{
    protected $primaryKey = "mark_favorite_group_post_id";

    protected $table = "mark_favorite_group_posts";

    protected $fillable = ["user_id", 'post_id'];

    public function getGroupPost(){
        return $this->belongsTo(GroupPost::class, 'group_id', "post_id");
    }
}
