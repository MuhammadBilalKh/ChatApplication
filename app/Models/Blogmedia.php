<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;

class BlogMedia extends Model
{
    protected $primaryKey = "blog_media_id";

    protected $table = "blog_medias";

    protected $fillable = [
        "post_id",
        "file_path",
        "file_name",
        "mime_type",
        "fize_size",
        "media_type",
        'caption'
    ];

    public function getBlog(){
        return $this->belongsTo(Blog::class, 'blog_id', "post_id");
    }
}
