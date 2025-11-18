<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertMedia extends Model
{
    protected $primaryKey = 'advertisments_media_id';

    protected $table = 'advertisments_media';

    protected $fillable = [
        'advertisment_id',
        'media_path',
        'media_type',
    ];

    public function getMediaAdvertisment()
    {
        return $this->belongsTo(Advert::class, 'advertisment_id', 'advertisment_id');
    }
}
