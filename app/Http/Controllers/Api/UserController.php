<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
use App\ApiModel\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;

class UserController extends Controller
{


    /**
     * User Profile
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: user_id
     * @url: http://localhost:8000/api/v2/userProfile
     * @return: user json, 200
     */
    public function userProfile(Request $request){
        $user_id = $request->user_id;
        $accountType = AppUser::where('id',$user_id )->pluck('account_type_id');

        if($accountType != 1){
           $user =   AppUser::with('social')->where('id',$user_id )->first();
            return Response::json(['user' => $user], 200);
        }else{
            $user =   AppUser::with('normal')->where('id',$user_id )->first();
            return Response::json(['user' => $user], 200);
        }

    }


    /**
     * Post Associate With user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get method
     * @param: user_id
     * @return: post json,200
     */
    public function userPost(Request $request){
        try{
            $user_id = $request->user_id;
            $post = Post::where('posted_by',$user_id )->get();
            return Response::json(['post' => $post->toArray()], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong'], 403);
        }

    }

}
