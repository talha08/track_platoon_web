<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\Comment;
use App\ApiModel\SubComment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;

class CommentController extends Controller
{

    //paginate
    public $limit = 10;




    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Comment
     * Post Method
     * @url: http://localhost:8000/api/v2/comment
     * @param post_id, user_id, comment_type_id(1 for support, 2 for unsupport), description
     * @return: success 200, error 403
     */
        public function commentStore(Request $request){

            $comment = new Comment();
            $comment->post_id = $request->post_id;
            $comment->app_user_id = $request->user_id;
            $comment->app_comment_type_id = $request->comment_type_id; //1 for support, 2 for unsupport
            $comment->description = $request->description;
            if($comment->save()){
                return Response::json(['success' => 'Comment post successfully'], 200);
            }else{
                return Response::json(['error' => 'Something went wrong'], 403);
            }
        }





        /**
         * @param Request $request
         * @return \Illuminate\Http\JsonResponse
         *
         * SubComment
         * Post Method
         * @url: http://localhost:8000/api/v2/subComment
         * @param comment_id, user_id, comment_type_id(1 for support, 2 for unsupport), description
         * @return success 200, error 403
         */
            public function subCommentStore(Request $request){

                $subComment = new SubComment();
                $subComment->app_comment_id = $request->comment_id;
                $subComment->app_user_id = $request->user_id;
                $subComment->app_comment_type_id = $request->comment_type_id;
                $subComment->description = $request->description;
                if($subComment->save()){
                    return Response::json(['success' => 'Comment post successfully'], 200);
                }else{
                    return Response::json(['error' => 'Something went wrong'], 403);
                }

            }






            /**
             * @param Request $request
             * @return \Illuminate\Http\JsonResponse
             * @url: http://localhost:8000/api/v2/checkCommentStatus
             *
             * Check Comment Status
             * Get Method
             * @param user_id, post_id
             * @return message 200 (3 types message with message_id)
             */
            public function checkCommentStatus(Request $request){

                  // $user_id = $request->user_id;
                   //$post_id = $request->post_id;

                //app_comment_type_id = 1 for support , 2 for support
                  $comment = Comment::where('post_id', $request->post_id)
                       ->where('app_user_id',$request->user_id)->first();


                 if( !empty($comment)){
                     if($comment->app_comment_type_id == 1){
                         return Response::json(['message' => 'User already support this post', 'message_id' => 1], 200);
                     }else{
                         return Response::json(['message' => 'User cant support this post', 'message_id' => 2], 200);
                     }
                 }else{
                     return Response::json(['message' => 'No comment found with user in this post', 'message_id' => 3], 200);
                 }
            }








            /**
             * Support Comment associate with post View
             *
             * @param Request $request
             * @return \Illuminate\Http\JsonResponse
             *
             * Get method
             * @param: post_id
             * @url: http://localhost:8000/api/v2/supportComment
             * @return: comment json,200
             */
            public function supportComment(Request $request){

                try{
                    $post_id = $request->post_id;
                    $comment = Comment::with('subComments','user')->where('post_id', $post_id)
                        ->where('app_comment_type_id',1)
                        ->paginate($this->limit);
                    return Response::json(['comment' => $comment->toArray()], 200);
                }
                catch(Exception $ex){
                    return Response::json(['error' => 'Something went wrong'], 403);
                }
            }





            /**
             * Un support Comment associate with post
             *
             * @param Request $request
             * @return \Illuminate\Http\JsonResponse
             *
             * Get method
             * @param: post_id
             * @url: http://localhost:8000/api/v2/unsupportComment
             * @return: comment json,200
             */
            public function unsupportComment(Request $request){

                try{
                    $post_id = $request->post_id;
                    $comment = Comment::with('subComments','user')->where('post_id', $post_id)
                        ->where('app_comment_type_id',2)
                        ->paginate($this->limit);
                    return Response::json(['comment' => $comment->toArray()], 200);
                }
                catch(Exception $ex){
                    return Response::json(['error' => 'Something went wrong'], 403);
                }
            }






    /**
         * SubComment associate with post Comment
         *
         * @param Request $request
         * @return \Illuminate\Http\JsonResponse
         *
         * Get method
         * @param: comment_id
         * @url: http://localhost:8000/api/v2/postsSubComment
         * @return: subComment json,200
         */
            public function postsSubComment(Request $request){
               try{
                   $comment_id = $request->comment_id;
                   $subComment = SubComment::where('app_comment_id', $comment_id)->paginate($this->limit);
                   return Response::json(['subComment' => $subComment->toArray()], 200);
               }
               catch(Exception $ex){
                   return Response::json(['error' => 'Something went wrong'], 403);
               }
            }















}
