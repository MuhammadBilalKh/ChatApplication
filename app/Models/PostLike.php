<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostLike extends Model
{
    protected $table = 'post_likes';

    protected $primaryKey = 'post_like_id';

    protected $fillable = [
        'post_id',
        'user_id',
    ];

    /**
     * Get the post that was liked.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }

    /**
     * Get the user who liked the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
