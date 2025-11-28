<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPostMedia extends Model
{
    protected $primaryKey = "group_post_media_id";
    protected $table = "group_posts_media";

    protected $fillable = [
        "post_id",
        "media_type",
        "file_size",
        "file_path",
    ];

    public function getPost(){
        return $this->belongsTo(GroupPost::class, 'post_id', 'post_id');
    }
}
