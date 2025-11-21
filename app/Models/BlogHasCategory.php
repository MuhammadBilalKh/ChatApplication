<?php

namespace App\Models;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class BlogHasCategory extends Model
{
    protected $primaryKey = "blog_has_category_id";

    protected $fillable = ["category_id", "blog_id"];

    public function UploadedBlog(){
        return $this->belongsTo(Blog::class, "blog_id", "blog_id");
    }

    public function CreatedCategory(){
        return $this->belongsTo(Category::class, 'category_id', "category_id");
    }
}
