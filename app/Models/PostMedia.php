<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    protected $primaryKey = "post_media_id";
    protected $table = "post_media";

    protected $fillable = [
        "post_id",
        "media_type",
        "file_size",
        "file_path",
    ];

    public function getPost(){
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }
}
