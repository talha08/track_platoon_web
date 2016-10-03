<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;
use Davibennun\LaravelPushNotification\Facades\PushNotification;
use Mockery\CountValidator\Exception;
use Response;

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


        //....................................
        $followingIds = FollowUser::where('user_id',$post->posted_by)->lists('following'); //all user whom I follow
        $followerIds = FollowUser::where('following',$post->posted_by)->lists('user_id'); //all user who follow me
        //.....................................

        //following or follower id
        $userList = AppUser::where('id', '!=', 1)
                     ->lists('id');

        $following_follower_user = array_unique(array_merge($followingIds->toArray(), $followerIds->toArray()));  //merge two array
        $other_user = array_diff($userList->toArray(), $following_follower_user);




        $tokens = Gcm::where('user_id', '!=', 1)
              ->whereIn('user_id',$following_follower_user)
             ->get();  // getting the device token


        $tokens1 = Gcm::where('user_id', '!=', 1)
            ->whereIn('user_id',$other_user)
            ->get();  // getting the device token



        // Populate the device collection
        $args = [];
        $args1 = [];


        //for follower following
        foreach($tokens as $i =>  $token) {
            $args[$i] = PushNotification::Device($token->device_token);
            //return $i;
        }

        //for other user
        foreach($tokens1 as $ix =>  $token1) {
            $args1[$ix] = PushNotification::Device($token1->device_token);
            //return $i;
        }

        $devices = PushNotification::DeviceCollection($args);
        $devices1 = PushNotification::DeviceCollection($args1);







        //$message = 'Hello this is test';
         $posts =  Post::singlePost($post->id);
         $posts['is_following'] = true;
         $message = json_encode($posts);


        $posts1 =  Post::singlePost($post->id);
        $posts1['is_following'] = false;
        $message1 = json_encode($posts1);



        // Send the notification to all devices in the collect
        $collection = PushNotification::app('appNameAndroid')
            ->to($devices)
            ->send($message);

        $collection1 = PushNotification::app('appNameAndroid')
            ->to($devices1)
            ->send($message1);


         return true;
    }












    /**
     * Single Post with Progress bar
     *
     * @param $post_id_gcm
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: $post_id_gcm
     * @url: http://localhost:8000/api/v2/singlePost
     * @return: json progress, post 200
     */
    public static function singlePost($post_id_gcm){

        // survey among == report, campaign
        //topic=1 , report=2, help=3,campaign=4


            $post_id = $post_id_gcm;
            $post = Post::with('user','postSolve','postFiles','postPhotos','postSubType','city')->where('id',$post_id )->first();

            $comment = Comment::with('subComments')->where('post_id', $post->id)->get();

            $support =  Comment::where('post_id',$post->id)->where('app_comment_type_id', 1)->count();
            $unsupport =  Comment::where('post_id',$post->id)->where('app_comment_type_id', 2)->count();
            //$support = $comment->where('app_comment_type_id', 1)->count();
            //$unsupport = $comment->where('app_comment_type_id', 2)->count();
            $share = 0;




                if ($post->post_type == 2) {
                    //for progress calculation
                    $commentCount = count($comment);
                    $survey_among = $post->survey_among;
                    $progress = Post::progress($commentCount, $survey_among);

                    return [
                        'progress' => $progress,
                        'support'=>$support,
                        'unSupport' => $unsupport,
                        'share' => $share,
                        'post' => $post
                    ];

                }elseif($post->post_type == 4){
                    //for progress calculation
                    $commentCount = count($comment)+ $post->participate;
                    $survey_among = $post->survey_among;
                    $progress = Post::progress($commentCount, $survey_among);

                    return [
                        'progress' => $progress,
                        'support'=>$support,
                        'unSupport' => $unsupport,
                        'share' => $share,
                        'post' => $post

                    ];
                }
                else {
                    return [
                        'progress' => 'null',
                        'support'=>$support,
                        'unSupport' => $unsupport,
                        'share' => $share,
                        'post' => $post

                    ];
                }
    }



    /**
     * Progress bar Calculation
     *
     * @param $commentCount
     * @param $survey_among
     * @return float
     */
    public static  function progress($commentCount,$survey_among ){

        return  $calculate = ($commentCount/$survey_among) * 100 ;

    }



}

