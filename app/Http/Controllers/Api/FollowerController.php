<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
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
     * Post Method
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
     * Post Method
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

            if($item->delete()){
                return Response::json(['success' => 'UnFollowing successfully'], 200);
            }else{
                return Response::json(['error' => 'Something went wrong'], 403);
            }

        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong'], 403);
        }
    }




    /**
     * followerList
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get method
     * @param: user_id
     * @url: http://localhost:8000/api/v2/followerList
     * @return: json follower,200
     *
     */
    public function followerList(Request $request){
        try{
            $user = $request->user_id;
            $followers = \DB::table('app_follow_users')->where('user_id',$user)->lists('following');
            // return    FollowUser::with('user')->where('user_id',$user)->get();
            $data = AppUser::whereIn('id',$followers )->paginate(10);

            return Response::json(['follower' => $data->toArray()], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong'], 403);
        }
    }





    /**
     * following
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get method
     * @param: user_id
     * @url: http://localhost:8000/api/v2/followerList
     * @return: json following,200
     *
     */
    public function followingList(Request $request){
        try{
        $user = $request->user_id;
        $following = \DB::table('app_follow_users')->where('following',$user)->lists('user_id');
        // return    FollowUser::with('user')->where('user_id',$user)->get();
       $data = AppUser::whereIn('id',$following )->paginate(10);

            return Response::json(['following' => $data->toArray()], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong'], 403);
        }
    }


}
