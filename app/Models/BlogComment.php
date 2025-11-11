<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $primaryKey = "blog_comment_id";

    protected $fillable = [
        "blog_comment_id",
        "blog_id",
        "comment_text",
        "commented_by",
        "parent_comment_id",
    ];

    public function blogCommentedBy(){
        return $this->belongsTo(User::class, 'user_id', 'commented_by');
    }

    public function blogCommentParent(){
        return $this->belongsTo(BlogComment::class, 'blog_comment_id', 'parent_comment_id');
    }
}
