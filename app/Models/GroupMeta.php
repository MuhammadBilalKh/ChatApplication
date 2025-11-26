<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMeta extends Model
{
    protected $table = 'group_meta';

    protected $primaryKey = 'group_meta_id';

    protected $fillable = [
        'group_id',
        'privacy_setting',
        'invitation_permission',
        'album_permission',
        'friend_invitation',
    ];

    public function getGroup()
    {
        return $this->belongsTo(Group::class, 'group_id', 'group_id');
    }
}
