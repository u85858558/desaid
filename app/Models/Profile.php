<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function getProfilePictureAttribute($value) {
        return $value ? $value : '/const_assets/default_profile_picture.png';
    }

}
