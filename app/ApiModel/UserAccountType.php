<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class UserAccountType extends Model
{
    protected $table ='app_user_account_type';



    /**
     * One to many relationship with AppUser
     * UserAccountType Has Many AppUser
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(){
        return $this->hasMany('App\ApiModel\AppUser','account_type_id','id');
    }



}
