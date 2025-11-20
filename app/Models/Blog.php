<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blog_posts";

    protected $primaryKey = "user_blog_id";

    protected $fillable = [
        "title",
        "slug",
        "status",
        "content",
        "user_id",
        "visibility",
        'view_count',
        "is_featured",
        'published_at',
        "featured_image",
    ];

    public function blogPostedBy(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function blogComments(){
        return $this->hasMany(BlogComment::class, 'blog_id', 'user_blog_id');
    }

    public function getBlog(){
        return $this->hasMany(BlogMedia::class, 'post_id', "user_blog_id");
    }

    public function setTitleAttribute($val){
        return $this->attributes['title'] = ucwords($val);
    }
}
