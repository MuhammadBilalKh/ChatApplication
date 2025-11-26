<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $primarykey = "message_id";

    protected $fillable = [
        "message",
        "sender_id",
        "receiver_id",
        "message_type",
        "attachment_path",
    ];

    public function messageSentBy(){
        return $this->belongsTo(User::class, 'user_id', 'sender_id');
    }

    public function messageReceiveBy(){
        return $this->belongsTo(User::class, 'user_id', "recevier_id");
    }

    public function setMessageAttribute($val){
        return $this->attributes['message'] = Crypt::encrypt($val);
    }

    public function getMessageAttribute($val){
        return Crypt::decrypt($val);
    }
}
