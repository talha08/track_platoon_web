<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class PostAttachment extends Model
{
    protected $table ='app_post_attachment';

    protected $hidden = ['created_at', 'updated_at'];
    /**
     * One to many relationship with Post
     * PostAttachment belongsTo Post
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\ApiModel\Post','app_post_id','id');
    }

}
