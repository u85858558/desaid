<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    // accessor for the banner picture
    public function getBannerPictureAttribute($value) {
        return $value ? $value : '/const_asserts/default_banner_picture.png';
    }
}
