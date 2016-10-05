<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class PostVideo extends Model
{
    protected $table ='app_post_video';
    protected $hidden = ['created_at', 'updated_at'];



    /**
     * One to many relationship with Post
     * PostPhoto belongsTo Post
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\ApiModel\Post','app_post_id','id');
    }
}
