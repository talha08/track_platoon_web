<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class SubComment extends Model
{
    protected $table ='app_subComment';



    /**
     * One to many relationship with CommentType
     * SubComment belongsTo CommentType
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commentType()
    {
        return $this->belongsTo('App\ApiModel\CommentType','app_comment_type_id','id');
    }






    /**
     * One to many relationship with Comment
     * SubComment belongsTo Comment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment()
    {
        return $this->belongsTo('App\ApiModel\Comment','app_comment_id','id');
    }



    /**
     * One to many relationship with AppUser
     * SubComment belongsTo AppUser
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\ApiModel\AppUser','app_user_id','id');
    }



}
