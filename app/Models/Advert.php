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
        "price",
        "location",
        "posted_by",
        "ip_address",
        "category_id",
        "description",
        "phone_number",
        "approval_status",
        "advertisment_code",
        "advertisment_title",
        "featuring_expired_on",
    ];

    public function advertPostedBy(){
        return $this->belongsTo(User::class, 'posted_by', "user_id");
    }

    public function getAdvertMedia(){
        return $this->hasMany(AdvertMedia::class, 'advertisment_id', "advertisment_id");
    }

    public function setAdvertismentTitleAttribute($val){
        return $this->attributes['advertisment_title'] = ucwords($val);
    }

    public function getCategory(){
        return $this->hasOne(Category::class, "category_id", "category_id");
    }
}
