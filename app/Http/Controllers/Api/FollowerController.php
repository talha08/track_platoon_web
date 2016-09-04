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

          $user_id = $request->user_id;
          $follower_id = $request->follower_id;

          $user = AppUser::where('id',$user_id)->first();
          $follower = FollowUser::where('user_id',$user_id )->where('following',$follower_id )->first();

          if(empty($follower)){
              if($user->can_followed == 1){
                  FollowUser::create([
                      'user_id' => $user_id,
                      'following' => $follower_id,
                      'status' => 2  //accept or direct follow
                  ]);
              }
              else{
                  FollowUser::create([
                      'user_id' => $user_id,
                      'following' => $follower_id,
                      'status' => 1  //request
                  ]);
              }
              return Response::json(['success' => 'Following successfully'], 200);
          }else{
              return Response::json(['error' => 'Duplicate entry', 'error_id'=> 100], 403);
          }

      }catch(Exception $ex){
          return Response::json(['error' => 'Something went wrong'], 403);
      }
    }






    /**
     * Show Follower Request
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: user_id
     * @url: /showFollowerRequest
     * @return: followerRequest json, 200 or error
     */
    public function showFollowerRequest(Request $request){
        try{
            $user = $request->user_id;
            $followers = \DB::table('app_follow_users')
                ->where('user_id',$user)
                ->where('status',1)  //request
                ->lists('following');
            // return    FollowUser::with('user')->where('user_id',$user)->get();
            $data = AppUser::whereIn('id',$followers )->paginate(10);

            return Response::json(['followerRequest' => $data->toArray()], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong'], 403);
        }
    }





    /**
     * Accept Follower
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Post Method
     * @param: user_id, follower_id
     * @url: /acceptFollowerRequest
     * @return: success, error_id=200
     */
    public function acceptFollowerRequest(Request $request){
        try{

            $user = $request->user_id;
            $follower = $request->follower_id;

            $user = AppUser::where('id',$user)->first();


                FollowUser::create([
                    'user_id' => $user,
                    'following' => $follower,
                    'status' => 2  //accept
                ]);

            return Response::json(['success' => 'Follower Added successfully'], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id'=>200], 403);
        }
    }


    /**
     * Reject Follower
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Post Method
     * @param: user_id, follower_id
     * @url: /rejectFollowerRequest
     * @return: success, error_id=200
     */
    public function rejectFollowerRequest(Request $request){
        try{

            $user = $request->user_id;
            $follower = $request->follower_id;

            $user = AppUser::where('id',$user)->first();


            FollowUser::create([
                'user_id' => $user,
                'following' => $follower,
                'status' => 3  //reject
            ]);

            return Response::json(['success' => 'Follower rejected successfully'], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id'=>200], 403);
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
            $followers = \DB::table('app_follow_users')
                ->where('following',$user)
                ->where('status',2)
                ->lists('user_id');
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
        $following = \DB::table('app_follow_users')
            ->where('user_id',$user)
            ->where('status',2)
            ->lists('following');
        // return    FollowUser::with('user')->where('user_id',$user)->get();
       $data = AppUser::whereIn('id',$following )->paginate(10);

            return Response::json(['following' => $data->toArray()], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong'], 403);
        }
    }


}
