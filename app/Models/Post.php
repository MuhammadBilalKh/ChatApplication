<?php

namespace App\Models;


use App\Models\User;
use App\Models\PostMedia;
use App\Models\MarkFavorite;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = "post_id";
    protected $fillable = [
        "description",
        "user_id",
        'visibility',
        'is_shared',
        'original_post_id',
        'likes_count',
        'comments_count',
        "new_joining_post",
        'shares_count',
        "is_profile_picture_change_post",
        'is_cover_picture_change_post',
        "is_new_friend_added_post",
        "is_profile_info_updated_post",
    ];

    public function postUploadedBy()
    {
        return $this->belongsTo(User::class, 'user_id', "user_id");
    }

    public function postMedia(){
        return $this->hasMany(PostMedia::class, 'post_id', "post_id");
    }

    public function setTitleAttribute($value){
        return $this->attributes['title'] = ucwords($value);
    }

    public static function createNewJoiningPost($username, $userID){
        return static::create([
            'description' => "$username became a registered member",
            'user_id' => $userID,
            'visibility' => POST_VISIBILITY_PUBLIC,
            'new_joining_post' => NEW_JOINING_USER_POST,
        ]);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'post_id')
            ->whereNull('parent_comment_id')
            ->with('replies');
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class, 'post_id', 'post_id');
    }

    public function getLikedBy(){
        return $this->hasMany(PostLike::class, 'post_id', "post_id");
    }

    public function getMarkedFavorite(){
        return $this->hasMany(MarkFavorite::class, "post_id", "post_id");
    }
}
