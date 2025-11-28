<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPostComment extends Model
{
    protected $primaryKey = 'group_post_comment_id';

    protected $table = 'group_post_comments';

    protected $fillable = ['comment_text', 'commented_by', 'parent_comment_id', 'post_id', 'comment_type'];

    public function commentPostedBy()
    {
        return $this->belongsTo(User::class, 'commented_by', 'user_id');
    }

    public function commentParent()
    {
        return $this->belongsTo(GroupPostComment::class, 'parent_comment_id', 'group_post_comment_id');
    }

    public function commentPost()
    {
        return $this->belongsTo(GroupPost::class, 'post_id', 'group_post_id');
    }

    public function replies()
    {
        return $this->hasMany(GroupPostComment::class, 'parent_comment_id', 'group_post_comment_id');
    }
}
