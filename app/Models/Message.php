<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $primarykey = "message_id";

    protected $fillable = [
        "sender_id",
        "recevier_id",
        "message_type",
        "attachment_path",
        "message",
    ];

    public function messageSentBy(){
        return $this->belongsTo(User::class, 'user_id', 'sender_id');
    }
}
