<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\Post;
use App\ApiModel\PostSubType;
use Illuminate\Http\Request;
use App\ApiModel\FollowUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use Mockery\CountValidator\Exception;

class NewsFeedController extends Controller
{

    public $limit = 5 ;

    public function test(){
        $user = 1;
      return PostSubType::where('id',1)->pluck('post_type_id');
    }


    /**
     *
     * NewsFeed
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     *
     * @url : http://localhost:8000/api/v2/newsFeed
     * @param: user_id, filter[all,topic,campaign,help,report]
     * @return: json newsFeed 200
     */

    public function newsFeed(Request $request)
    {

            $filter = $request->filter;
             $user_id  = $request->user_id;

             $follower_ids = \DB::table('app_follow_users')->where('user_id', $user_id)->lists('following');

            if($filter === 'all'){
                 $posts = Post::with('user','postSolve','postFiles','postPhotos')
                    ->whereIn('posted_by', $follower_ids)
                    ->orWhere('posted_by',$user_id)
                    ->orderBy('id', 'desc')->paginate($this->limit);
                return Response::json(array('newsFeed'  => $posts->toArray()),200);

            }
            elseif($filter === 'topic'){
                $feed = 1;
                 $test = \DB::table('app_post')->where('post_type', $feed)->lists('id');
                 $posts = Post::with('user','postSolve','postFiles','postPhotos')
                    ->whereIn('id', $test)
                    ->whereIn('posted_by', $follower_ids)
                    ->orWhere('posted_by',$user_id)
                    ->orderBy('id', 'desc')->paginate($this->limit);
                return Response::json(array('newsFeed'  => $posts->toArray()),200);
            }
            elseif($filter === 'campaign'){
                $feed = 2;
                $test = \DB::table('app_post')->where('post_type', $feed)->lists('id');
                $posts = Post::with('user','postSolve','postFiles','postPhotos')
                    ->whereIn('id', $test)
                    ->whereIn('posted_by', $follower_ids)
                    ->orWhere('posted_by',$user_id)
                    ->orderBy('id', 'desc')->paginate($this->limit);
                return Response::json(array('newsFeed'  => $posts->toArray()),200);
            }
            elseif($filter === 'help'){
                $feed = 3;
                $test = \DB::table('app_post')->where('post_type', $feed)->lists('id');
                $posts = Post::with('user','postSolve','postFiles','postPhotos')
                    ->whereIn('id', $test)
                    ->whereIn('posted_by', $follower_ids)
                    ->orWhere('posted_by',$user_id)
                    ->orderBy('id', 'desc')->paginate($this->limit);
                return Response::json(array('newsFeed'  => $posts->toArray()),200);
            }
            elseif($filter === 'report'){
                $feed = 4;
                $test = \DB::table('app_post')->where('post_type', $feed)->lists('id');
                $posts = Post::with('user','postSolve','postFiles','postPhotos')
                    ->whereIn('id', $test)
                    ->whereIn('posted_by', $follower_ids)
                    ->orWhere('posted_by',$user_id)
                    ->orderBy('id', 'desc')->paginate($this->limit);
                return Response::json(array('newsFeed'  => $posts->toArray()),200);
            }
           else{
                return Response::json(['error' => 'No Data found'], 403);
            }



    }


}
