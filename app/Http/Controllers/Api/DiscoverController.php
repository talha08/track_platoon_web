<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
use App\ApiModel\Interest;
use App\ApiModel\Post;
use App\ApiModel\PostSubType;
use Mockery\CountValidator\Exception;
use Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class DiscoverController extends Controller
{

    public $limit = 5 ;

    /**
     * Discover
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @url:
     * @param: user_id, filter[people,organization,topic,report,campaign,help]
     * @return: json 200
     */
    public  function discover(Request $request){

       try{
           //Topic,Report,Help,Campaign

           $user = $request->user_id; // Auth user
           $filter = $request->filter;

           if ($filter === 'people') {
               $people = AppUser::where('user_type', 0)
                   ->paginate($this->limit);
               //need to send location
               return Response::json(['data' => $people->toArray()], 200);
           }

           elseif ($filter === 'organization') {

               $organization = AppUser::where('user_type', 1)
                   ->paginate($this->limit);
               //need to send location
               return Response::json(['data' => $organization->toArray()], 200);
           }

           elseif ($filter === 'topic') {
               $interest = Interest::where('post_type',1)->count();
               $totalPost = Post::where('post_type',1)->count();
               $post = PostSubType::where('post_type_id', 1)
                   ->paginate($this->limit);

               return Response::json([
                   'interestPeople'=>$interest,
                   'totalPost' => $totalPost,
                   'data' => $post->toArray()
               ], 200);
           }

           elseif ($filter === 'report') {
               $interest = Interest::where('post_type',2)->count();
               $totalPost = Post::where('post_type',2)->count();
               $post = PostSubType::where('post_type_id', 2)
                   ->paginate($this->limit);
               return Response::json([
                   'interestPeople'=>$interest,
                   'totalPost' => $totalPost,
                   'data' => $post->toArray()
               ], 200);
           }

           elseif ($filter === 'campaign') {
               $interest = Interest::where('post_type',4)->count();
               $totalPost = Post::where('post_type',4)->count();
               $post = PostSubType::where('post_type_id', 4)
                   ->paginate($this->limit);
               return Response::json([
                   'interestPeople'=>$interest,
                   'totalPost' => $totalPost,
                   'data' => $post->toArray()
               ], 200);
           }

           elseif ($filter === 'help') {
               $interest = Interest::where('post_type',3)->count();
               $totalPost = Post::where('post_type',3)->count();
               $post = PostSubType::where('post_type_id', 3)
                   ->paginate($this->limit);
               return Response::json([
                   'interestPeople'=>$interest,
                   'totalPost' => $totalPost,
                   'data' => $post->toArray()
               ], 200);
           }

           elseif ($filter === 'all') {
               $interest = Interest::count();
               $totalPost = Post::count();
               $post = PostSubType::whereIn('post_type_id', [1, 2, 3, 4])
                   ->paginate($this->limit);
               return Response::json([
                   'interestPeople'=>$interest,
                   'totalPost' => $totalPost,
                   'data' => $post->toArray()
               ], 200);
           }
           else{
               return Response::json(['error' => 'Something went wrong'], 403);
           }
       }catch(Exception $ex){
           return Response::json(['error' => 'Something went wrong'], 403);
       }





    }










}
