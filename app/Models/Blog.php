<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $primaryKey = "user_blog_id";

    protected $fillable = [
        "blog_title",
        "description",
        "blog_media_path",
        "blog_media_type",
        "blog_posted_by",
    ];

    public function blogPostedBy(){
        return $this->belongsTo(User::class, 'user_id', 'blog_posted_by');
    }

    public function blogComments(){
        return $this->hasMany(BlogComment::class, 'blog_id', 'user_blog_id');
    }
}
