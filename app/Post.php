<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    //category relation
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //user relation
     public function user(){
        return $this->belongsTo(User::class);
    }

    //relation to tags
    public function tags(){
        return $this->hasMany(Tag::class,'postID','id');
    }

    //define query scope
    //Published()
    public function scopePublished($query){
        return $query->where('status',1);
    }

    //relation with comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //many to many relationship with user and post so make another migration table post_user
    public function likedUsers(){
        return $this->belongsToMany(User::class);
    }


}
