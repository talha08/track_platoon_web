<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    protected $table ='app_user';




    /**
     * One to many relationship with FollowUser
     * User Has Many FollowUser
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function follower(){
        return $this->hasMany('App\ApiModel\FollowUser','following','id');
    }




    /**
     * One to many relationship with UserAccountType
     * AppUser belongsTo UserAccountType
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userAccountType()
    {
        return $this->belongsTo('App\ApiModel\UserAccountType','account_type_id','id');
    }


    /**
     * One to One relationship with SocialLogin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function social(){
        return $this->hasOne('App\ApiModel\SocialLogin','app_user_id','id');
    }




    /**
     * One to One relationship with EmailLogin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function normal(){
        return $this->hasOne('App\ApiModel\EmailLogin','app_user_id','id');
    }




    /**
     * One to many relationship with Post
     * User Has Many Post
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(){
        return $this->hasMany('App\ApiModel\Post','posted_by','id');
    }




    /**
     * One to many relationship with Comment
     * User Has Many Comment
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
        return $this->hasMany('App\ApiModel\Comment','app_user_id','id');
    }



    /**
     * One to many relationship with Comment
     * User Has Many SubComment
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subComments(){
        return $this->hasMany('App\ApiModel\SubComment','app_user_id','id');
    }




}
