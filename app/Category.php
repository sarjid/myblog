<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    //category
    public function posts(){
        return $this->hasMany(Post::class)->where('status',1);
    }


}
