<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class EmailLogin extends Model
{
    protected $table ='app_email_login';


    /**
     * One to One
     * EmailLogin belongsTo AppUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users(){
        return $this->belongsTo('App\ApiModel\AppUser','app_user_id','id');
    }

}
