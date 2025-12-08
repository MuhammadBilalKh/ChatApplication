<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $primaryKey = 'user_meta_id';

    protected $table = 'users_meta';

    protected $fillable = [
        'user_id', 'date_of_birth', 'sex', 'city', 'country',
        'email_on_group_joining_accepted_or_rejected',
        'email_on_receiving_request_for_private_group',
        'email_on_changing_group_role',
        'email_on_receiving_membership_invitation',
        'email_on_friend_request_accept',
        'email_on_friend_request_receive',
        'email_on_accept_membership_invitation',
        'email_on_sending_message',
        'email_on_reply_or_comment',
        'email_on_metion',
    ];

    public function getMetaUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
