<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class FollowUser extends Model
{
    protected $table ='app_follow_users';


    /**
     * One to many relationship with AppUser
     * FollowUser belongsTo AppUser
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\ApiModel\AppUser','following','id');
    }

}
