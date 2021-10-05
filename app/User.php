<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','username','image','about'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

     //category
     public function posts(){
        return $this->hasMany(Post::class);
    }


    //relation with comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }

      //relation with commentreplay
      public function replies(){
        return $this->hasMany(CommentReply::class);
    }

    //many to many relation with user and post.. so make another migration table post_user
    public function likedPosts(){
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
}
