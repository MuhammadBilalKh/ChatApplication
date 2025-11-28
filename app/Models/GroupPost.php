<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPost extends Model
{
    protected $primaryKey = 'group_post_id';

    protected $table = 'group_posts';

    protected $fillable = ['media', 'media_type',	'description',	'user_id',	'visibility',	'is_shared',	'original_post_id',	'likes_count',	'comments_count',	'shares_count',	'created_at',	'updated_at',	'group_id'];

    public function comments()
    {
        return $this->hasMany(GroupPostComment::class, 'post_id', 'group_post_id')
            ->whereNull('parent_comment_id')
            ->with('replies');
    }

    public function likes()
    {
        return $this->hasMany(GroupPostLike::class, 'post_id', 'post_id');
    }

    public function getLikedBy()
    {
        return $this->hasMany(GroupPostLike::class, 'post_id', 'post_id');
    }

    public function getMarkedFavorite()
    {
        return $this->hasMany(Group::class, 'group_id', 'group_id');
    }

    public function postCreatedBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function postMedia()
    {
        return $this->hasMany(GroupPostMedia::class, 'group_post_media_id', 'group_id');
    }

    public function replies()
    {
        return $this->hasMany(GroupPostComment::class, 'parent_comment_id', 'group_post_comment_id');
    }
}
