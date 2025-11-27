<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $primaryKey = "blog_comment_id";

    protected $table = "user_blogs_comments";

    protected $fillable = [
        "blog_comment_id",
        "user_blog_id",
        "comment_text",
        "commented_by",
        "parent_comment_id",
    ];

    public function commentPostedBy(){
        return $this->belongsTo(User::class, 'commented_by', 'user_id');
    }

    public function commentParent(){
        return $this->belongsTo(BlogComment::class, 'blog_comment_id', 'parent_comment_id');
    }

    public function commentBlog(){
        return $this->belongsTo(Blog::class, "user_blog_id", "user_blog_id");
    }
}
