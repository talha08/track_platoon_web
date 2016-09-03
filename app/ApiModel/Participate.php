<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class Participate extends Model
{
    protected $table = 'app_post_participate';


    /**
     * One to many relationship with AppUser
     * Participate belongsTo AppUser
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\ApiModel\AppUser','user_id','id');
    }



    /**
     * One to many relationship with Post
     * Participate belongsTo Post
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\ApiModel\Post','post_id','id');
    }

}
