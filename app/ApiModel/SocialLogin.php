<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model
{
    protected $table ='app_social_login';


    /**
     * One To One
     * SocialLogin belongsTo AppUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users(){
        return $this->belongsTo('App\ApiModel\AppUser','app_user_id','id');
    }
}
