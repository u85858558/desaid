<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'post';

    protected $fillable = ['user_id', 'group_id', 'content', 'picture'];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'group_id' => 'integer',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function group(){
        return $this->belongsTo('App\Group');
    }

    public function comments(){
        return $this->hasMany('App\Comment')->latest();
    }

    public function likes(){
        return $this->morphMany('App\Like', 'likeable');
    }

    public function link(){
        return route('posts.show', [
            'group' => $this->group->id_string,
            'post' => $this->id,
        ]);
    }
}
