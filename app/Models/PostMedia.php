<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    protected $primaryKey = "post_media_id";
    protected $table = "post_media";

    protected $fillable = [
        "post_id",
        "media_type",
        "file_size",
        "file_path",
    ];
}
