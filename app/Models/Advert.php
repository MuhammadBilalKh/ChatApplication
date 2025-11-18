<?php

namespace App\Models;

use App\Models\User;
use App\Models\AdvertMedia;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $primaryKey = "advertisment_id";

    protected $table = "advertisments";

    protected $fillable = [
        "phone_number",
        "posted_by",
        "advertisment_title",
        "category_id",
        "description",
        "price",
        "location",
        "advertisment_code",
        "approval_status",
    ];

    public function adverPostedBy(){
        return $this->belongsTo(User::class, 'user_id', "posted_by");
    }

    public function getAdverMedia(){
        return $this->hasMany(AdvertMedia::class, 'advertisment_id', "advertisment_id");
    }

    public function setAdvertismentTitleAttribute($val){
        return $this->attributes['advertisment_title'] = ucwords($val);
    }
}
