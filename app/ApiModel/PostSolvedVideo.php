<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class PostSolvedVideo extends Model
{
    protected $table = 'app_post_solved_video';

    protected $hidden = ['created_at', 'updated_at'];
    /**
     * One to many relationship with Post
     * PostAttachment belongsTo Post
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\ApiModel\PostSolved','app_post_solved_id','id');
    }
}
