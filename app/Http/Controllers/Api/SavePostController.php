<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\Post;
use App\ApiModel\Save;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;

class SavePostController extends Controller
{


    /**
     * Save Post
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Post Method
     * @param: user_id, post_id
     * @url: /savePostByUser
     * @return: success, error (error_id =200)
     */
    public function savePostByUser(Request $request){
            $user_id = $request->user_id;
            $post_id = $request->post_id;

            $save = new Save();
            $save->user_id = $user_id;
            $save->post_id = $post_id;
            if($save->save()){
                return Response::json(['success' => 'Post Save Successfully'], 200);
            }else{
                return Response::json(['error' => 'Something went wrong', 'error_id'=>200], 403);
            }
    }







    /**
     * View Save Post
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: user_id
     * @url: /savePostView
     * @return: savePost json
     */
    public function savePostView(Request $request){

       try{
           $user_id =$request->user_id;
           $post_ids = Save::where('user_id', $user_id)->lists('post_id');
           $post = Post::with('user','postSolve','postFiles','postPhotos','postSubType')->whereIn('id',$post_ids)->get();

           return Response::json(['savePost' => $post ], 200);

       }catch(Exception $ex){
           return Response::json(['error' => 'Something went wrong', 'error_id'=>200], 403);
       }

    }





    /**
     * Remove Save Post
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Post Method
     * @param: user_id, post_id
     * @url: /removeSavePost
     * @return: success, error(error_id = 200)
     */
    public function removeSavePost(Request $request){

        $user_id = $request->user_id;
        $post_id = $request->post_id;

        $post = Save::where('user_id',$user_id )->where('post_id',$post_id)->first();
        if($post->delete()){
            return Response::json(['success' => 'Remove Post successfully  from save post'], 200);
        }else{
            return Response::json(['error' => 'Something went wrong', 'error_id'=>200], 403);
        }
    }





















}
