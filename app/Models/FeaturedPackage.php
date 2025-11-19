<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedPackage extends Model
{
    protected $primaryKey = 'package_id';
    protected $fillable = [
        "package_name",
        "package_description",
        "price",
        "duration_days",
    ];
}
