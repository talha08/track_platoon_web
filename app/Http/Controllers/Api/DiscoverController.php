<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
use App\ApiModel\Post;
use Mockery\CountValidator\Exception;
use Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class DiscoverController extends Controller
{


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

           $user = $request->user_id;
           $filter = $request->filter;

           if($filter === 'people'){
               $people = AppUser::where('user_type',0)->get();
               return Response::json(['data' => $people], 200);

           }elseif($filter === 'organization'){
               $organization = AppUser::where('user_type',1)->get();
               return Response::json(['data' => $organization], 200);
           }
           elseif($filter === 'topic'){
               $post = Post::where('post_type', 1)->get();
               return Response::json(['data' => $post], 200);
           }
           elseif($filter === 'report'){
               $post = Post::where('post_type', 2)->get();
               return Response::json(['data' => $post], 200);
           }
           elseif($filter === 'campaign'){
               $post = Post::where('post_type', 4)->get();
               return Response::json(['data' => $post], 200);
           }
           elseif($filter === 'help'){
               $post = Post::where('post_type', 3)->get();
               return Response::json(['data' => $post], 200);
           }
           else{
               return Response::json(['error' => 'Something went wrong'], 403);
           }
       }catch(Exception $ex){
           return Response::json(['error' => 'Something went wrong'], 403);
       }





    }










}
