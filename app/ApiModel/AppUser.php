<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    protected $table ='app_user';

    //protected $hidden = ['username','mobile','occupation','work_place','city','country','religion',
   // 'hide_email','hide_mobile','hide_occupation','hide_religion','hide_country','hide_work_place'
   // ];

    //protected $fillable = ['id'];
   // protected $guarded = array('id');


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



 /**
     * One to many relationship with Interest
     * User Has Many Interest
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interests(){
        return $this->hasMany('App\ApiModel\Interest','app_user_id','id');
    }





    /**
     * One to many relationship with Participate
     * Post Has Many Participate
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participates(){
        return $this->hasMany('App\ApiModel\Participate','user_id','id');
    }


}
