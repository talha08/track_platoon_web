<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class PostSolved extends Model
{
    protected $table ='app_post_solved';




    /**
     * One to One relationship with Post
     * PostSolved belongsTo Post
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(){
        return $this->belongsTo('App\ApiModel\Post','post_id','id');
    }
}
