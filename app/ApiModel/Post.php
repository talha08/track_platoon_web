<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table ='app_post';





    /**
     * One to many relationship with PostPhoto
     * Post Has Many PostPhoto
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postPhotos(){
        return $this->hasMany('App\ApiModel\PostPhoto','app_post_id','id');
    }


    /**
     * One to many relationship with PostAttachment
     * Post Has Many PostAttachment
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postFiles(){
        return $this->hasMany('App\ApiModel\PostAttachment','app_post_id','id');
    }




    /**
     * One to many relationship with AppUser
     * Post belongsTo AppUser
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\ApiModel\AppUser','posted_by','id');
    }



    /**
     * One to One relationship with PostSolved
     * Post has one PostSolved
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function postSolve(){
        return $this->hasOne('App\ApiModel\PostSolved','post_id','id');
    }

}

