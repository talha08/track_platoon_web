<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\FollowUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;

class FollowerController extends Controller
{

    /**
     * Follow
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: user_id,follower_id
     * @url: http://localhost:8000/api/v2/follow
     * @return: success, 200/ error , 403
     */
    public function follow(Request $request){
      try{
          $user = $request->user_id;
          $follower = $request->follower_id;

          FollowUser::create([
              'user_id' => $user,
              'following' => $follower
          ]);

          return Response::json(['success' => 'Following successfully'], 200);
      }catch(Exception $ex){
          return Response::json(['error' => 'Something went wrong'], 403);
      }
    }


    /**
     * UnFollow
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: user_id,follower_id
     * @url: http://localhost:8000/api/v2/unFollow
     * @return: success, 200/ error , 403
     */
    public function unFollow(Request $request){
        try{
            $user = $request->user_id;
            $follower = $request->follower_id;


            $item = FollowUser::where('user_id',$user)
                                ->where('following',$follower );
            $item->delete();


            return Response::json(['success' => 'UnFollowing successfully'], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong'], 403);
        }
    }


}
