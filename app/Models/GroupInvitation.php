<?php

namespace App\Models;

use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;

class GroupInvitation extends Model
{
    protected $primaryKey = "group_invitation_id";

    protected $fillable = ["invited_to", "invited_by", "invited_at", "status"];

    public function getInvitedBy(){
        return $this->belongsTo(User::class, "invited_by", "user_id");
    }

    public function getGroup(){
        return $this->belongsTo(Group::class, "group_id", "group_id");
    }
}
