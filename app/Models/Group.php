<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $primaryKey = "group_id";

    protected $fillable = ["group_name", "group_description", "privacy", "profile_image", "cover_image", "created_by"];

    public function setGroupNameAttribute($val){
        return $this->attributes['group_name'] = ucwords($val);
    }

    public function setGroupDescriptionAttribute($val){
        return $this->attributes["group_description"] = ucfirst($val);
    }

    public function groupCreatedBy(){
        return $this->belongsTo(User::class, 'created_by', "user_id");
    }

    public function getMeta(){
        return $this->hasOne(GroupMeta::class, "group_id", "group_id");
    }

    public function getGroupMembers(){
        return $this->hasMany(User::class, "user_id", "user_id");
    }
}
