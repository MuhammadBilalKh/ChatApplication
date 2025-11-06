<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendShip extends Model
{
    protected $table = "friendships";

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'status'
    ];

    protected $primaryKey = "friendship_id";

    public function getSender()
    {
        return $this->belongsTo(User::class, 'user_id', "sender_id");
    }

    public function getReceiver()
    {
        return $this->belongsTo(User::class, 'user_id', "receiver_id");
    }
}
