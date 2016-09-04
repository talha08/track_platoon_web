<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\Participate;
use App\ApiModel\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;

class ParticipateController extends Controller
{


    /**
     * Participate
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Post Method
     * @param: user_id, post_id
     * @url: /postParticipate
     * @return: success, error(error_id =200)
     */
    public function postParticipate(Request $request){

      try{
          $user_id = $request->user_id;
          $post_id = $request->post_id;

          Participate::create([
              'user_id' => $user_id,
              'post_id' => $post_id

          ]);

          $part = Post::where('id',$post_id )->pluck('participate');
          $part_new = $part +1 ;
          Post::where('id',$post_id )->update([
              'participate' => $part_new
          ]);
          return Response::json(['success'=>'Successfully Participated'], 200);
      }catch(Exception $ex){
          return Response::json(['error'=>'Something went wrong', 'error_id'=> 200], 403);
      }


    }



    /**
     * Show Participate List
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: post_id
     * @url: /viewParticipate
     * @return: participate json, error(error_id =200)
     */
    public function viewParticipate(Request $request){

       try{
           $post_id = $request->post_id;
           $participate = Participate::with('user','post')->where('post_id', $post_id )->get();
           return Response::json(['participate'=>$participate], 200);
       }catch(Exception $ex){
           return Response::json(['error'=>'Something went wrong', 'error_id'=> 200], 403);
       }
    }


    /**
     * checkParticipateStatus
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: user_id, post_id
     * @url: /checkParticipateStatus
     * @return: success[eligible to participate(success_id =>200)]  or error[Already Participated(error_id => 300)]
     */
    public  function checkParticipateStatus(Request $request){
        $user_id = $request->user_id;
        $post_id = $request->post_id;

        $post_participate = Participate::where('user_id',$user_id)->where('post_id',$post_id)->first();

        if(empty($post_participate)){
            return Response::json(['success'=>'Eligible to participate', 'success_id'=> 200], 200);
        }else{
            return Response::json(['error'=>'Already participated', 'error_id'=> 300], 403);
        }
    }

}
