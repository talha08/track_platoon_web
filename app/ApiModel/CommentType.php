<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class CommentType extends Model
{
    protected $table ='app_comment_type';



    /**
     * One to many relationship with Comment
     * CommentType Has Many Comment
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
        return $this->hasMany('App\ApiModel\Comment','app_comment_type_id','id');
    }



    /**
     * One to many relationship with SubComments
     * CommentType Has Many SubComment
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subComments(){
        return $this->hasMany('App\ApiModel\SubComment','app_comment_type_id','id');
    }



}
