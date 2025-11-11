<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $primaryKey = "job_posting_id";

    protected $fillable = [
        "location",
        "job_type",
        "salary",
        "title",
        "is_remotely_available",
        "posted_by",
        "description",
        "application_email",
        "company_name",
        "company_url",
        "tagline",
        "video",
        "twitter_username",
        "company_logo",
        "publishing_status",
        "job_notes",
        "views_count",
    ];

    public function getPostedBy(){
        return $this->belongsTo(User::class, "user_id", "user_id");
    }

    public function setTitleAttribute($val){
        return $this->attributes['title'] = ucwords($val);
    }
}
