<?php

namespace App\Models;

use App\Models\Advert;
use Illuminate\Database\Eloquent\Model;

class FeaturedAdvert extends Model
{
    protected $primaryKey = "featured_advertisments_id";

    protected $table = "featured_advertisments";

    protected $fillable = [
        "advertisment_id",
        "is_featured",
        "package_id",
    ];

    public function getAdvertisment(){
        return $this->hasOne(Advert::class, 'advertisment_id', "advertisment_id");
    }
}
