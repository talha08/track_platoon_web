<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table ='app_comment';


    /**
     * One to many relationship with CommentType
     * Comment belongsTo CommentType
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commentType()
    {
        return $this->belongsTo('App\ApiModel\CommentType','app_comment_type_id','id');
    }




    /**
     * One to many relationship with SubComment
     * Comment Has Many SubComment
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subComments(){
        return $this->hasMany('App\ApiModel\SubComment','app_comment_id','id');
    }




    /**
     * One to many relationship with AppUser
     * Comment belongsTo AppUser
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\ApiModel\AppUser','app_user_id','id');
    }


//    /**
//     * One to many relationship with Post
//     * Comment belongsTo Post
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
    public function post()
    {
        return $this->belongsTo('App\ApiModel\Post','post_id','id');
    }




}
