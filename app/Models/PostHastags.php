<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;

class PostHastags extends Model
{
    protected $primaryKey = "blog_tag_id";

    protected $table = "post_tags";

    protected $fillable = ["tag_id", "blog_id"];

    public function getTagBlog(){
        return $this->belongsTo(Blog::class, "user_blog_id", "blog_id");
    }

    public function getTags(){
        return $this->belongsTo(Tag::class, "tag_id", "tag_id");
    }
}
