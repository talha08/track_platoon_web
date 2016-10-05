<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class PostSolved extends Model
{
    protected $table ='app_post_solved';

    protected $with = ['postSolvedPhotos','postSolvedFiles'];

    /**
     * One to One relationship with Post
     * PostSolved belongsTo Post
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(){
        return $this->belongsTo('App\ApiModel\Post','post_id','id');
    }


    /**
     * One to many relationship with PostPhoto
     * Post Has Many PostPhoto
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postSolvedPhotos(){
        return $this->hasMany('App\ApiModel\PostSolvedPhoto','app_post_solved_id','id');
    }


    /**
     * One to many relationship with PostAttachment
     * Post Has Many PostAttachment
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postSolvedFiles(){
        return $this->hasMany('App\ApiModel\PostSolvedAttachment','app_post_solved_id','id');
    }

    /**
     * One to many relationship with PostSolvedVideo
     * Post Has Many PostSolvedVideo
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postSolvedVideos(){
        return $this->hasMany('App\ApiModel\PostSolvedVideo','app_post_solved_id','id');
    }




}
