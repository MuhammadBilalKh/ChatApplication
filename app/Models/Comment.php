<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'comment_text',
        'commented_by',
        'parent_comment_id',
        'post_id',
        'comment_type',
    ];

    public function commentPostedBy()
    {
        return $this->belongsTo(User::class, 'commented_by', 'user_id');
    }

    public function commentParent()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'parent_comment_id');
    }

    public function commentPost()
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id', 'comment_id');
    }

    public function setCommentTextAttribute($comment)
    {
        return $this->attributes['comment_text'] = Crypt::encrypt($comment);
    }

    public function getCommentTextAttribute($comment)
    {
        return Crypt::decrypt($comment);
    }
}
