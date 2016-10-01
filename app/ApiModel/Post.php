<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;
use Davibennun\LaravelPushNotification\Facades\PushNotification;

class Post extends Model
{
    protected $table ='app_post';

   protected  $with =['postPhotos','postFiles','postSolve','postSubType','city','comments','user'];



    /**
     * One to many relationship with PostPhoto
     * Post Has Many PostPhoto
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postPhotos(){
        return $this->hasMany('App\ApiModel\PostPhoto','app_post_id','id');
    }


    /**
     * One to many relationship with PostAttachment
     * Post Has Many PostAttachment
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postFiles(){
        return $this->hasMany('App\ApiModel\PostAttachment','app_post_id','id');
    }




    /**
     * One to many relationship with AppUser
     * Post belongsTo AppUser
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\ApiModel\AppUser','posted_by','id');
    }



    /**
     * One to One relationship with PostSolved
     * Post has one PostSolved
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function postSolve(){
        return $this->hasOne('App\ApiModel\PostSolved','post_id','id');
    }



 //PostSubType
    public function postSubType()
    {
        return $this->belongsTo('App\ApiModel\PostSubType','app_subType_id','id');
    }



 //PostSubType
    public function city()
    {
        return $this->belongsTo('App\ApiModel\City','app_city_id','id');
    }



    /**
     * One to many relationship with Comment
     * Post Has Many Comment
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
        return $this->hasMany('App\ApiModel\Comment','post_id','id');
    }



    /**
     * One to many relationship with Participate
     * Post Has Many Participate
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participates(){
        return $this->hasMany('App\ApiModel\Participate','post_id','id');
    }









    /**
     * Gcm Notification for all type post
     * @param $post_id
     * @return bool
     */
    public static function sendGcm($post_id)
    {
        $post = Post::findOrFail($post_id);
        //gcm

        $tokens = Gcm::where('user_id', '!=', $post->posted_by)->get();  // getting the device token

        // Populate the device collection
        $args = [];

        foreach($tokens as $i =>  $token) {

            $args[$i] = PushNotification::Device($token->device_token);
            //return $i;
        }

        $devices = PushNotification::DeviceCollection($args);


        //$message = 'Hello this is test';
       $message = $post;

        // Send the notification to all devices in the collect
        $collection = PushNotification::app('appNameAndroid')
            ->to($devices)
            ->send($message);


        return true;

//
//        $deviceToken = Gcm::where('id',1)->pluck('device_token');
//        PushNotification::app('appNameAndroid')
//            ->to($deviceToken)
//            ->send('Hello World, i`m a push message');
    }


}

