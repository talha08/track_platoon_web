<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class PostSubType extends Model
{
    protected $table ='app_post_subType';
    protected $hidden = ['created_at', 'updated_at'];

    protected $with = ['postType'];

    /**
     * One to many relationship with PostType
     * PostSubType belongsTo PostType
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function postType()
    {
        return $this->belongsTo('App\ApiModel\PostType','post_type_id','id');
    }


    //post table
    public function posts(){
        return $this->hasMany('App\ApiModel\Post','app_subType_id','id');
    }



    //interest table
    public function interests(){
        return $this->hasMany('App\ApiModel\Interest','app_subType_id','id');
    }



}
