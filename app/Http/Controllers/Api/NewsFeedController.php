<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\Comment;
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

    public $limit = 10 ;




    /**
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

            //$process = $this->progressLoop(1);

             $follower_ids = \DB::table('app_follow_users')->where('user_id', $user_id)->lists('following');



            if($filter === 'all'){

                $posts = Post::with('user','postSolve','postFiles','postPhotos','postSubType')
                     ->whereIn('posted_by', $follower_ids)
                     ->orWhere('posted_by',$user_id)
                     ->orderBy('id', 'desc')
                     ->paginate($this->limit);


                   foreach($posts as $post){
                       $process = $this->progressLoop($post->id);
                       $post['progress'] = $process;
                   }

                 return Response::json(array('newsFeed'  => $posts->toArray()),200);

            }



            elseif($filter === 'topic'){
                $feed = 1;
                 $test = \DB::table('app_post')->where('post_type', $feed)->lists('id');
                 $posts = Post::with('user','postSolve','postFiles','postPhotos','postSubType')
                     ->whereIn('id', $test)
                     ->orWhereIn('posted_by', $follower_ids)
                     ->orWhere('posted_by',$user_id)
                     ->orderBy('id', 'desc')->paginate($this->limit);
                return Response::json(array('newsFeed'  => $posts->toArray()),200);
            }

            elseif($filter === 'campaign'){
                $feed = 4;
                $test = \DB::table('app_post')->where('post_type', $feed)->lists('id');
                $posts = Post::with('user','postSolve','postFiles','postPhotos','postSubType','city')
                    ->where(function ($query)use ($follower_ids,$user_id, $test){
                     return  $query ->whereIn('id', $test)
                                    ->whereIn('posted_by', $follower_ids)
                                    ->orWhere('posted_by',$user_id);
                    })
                   // ->orWhereIn('posted_by', $follower_ids)
                  //  ->orWhere('posted_by',$user_id)
                    ->orderBy('id', 'desc')
                    ->paginate($this->limit);

                    foreach($posts as $post){
                        $process = $this->progressLoop($post->id);
                        $post['progress'] = $process;
                    }

               return Response::json(array('newsFeed'  => $posts->toArray()),200);
            }


            elseif($filter === 'help'){
                $feed = 3;
                $test = \DB::table('app_post')->where('post_type', $feed)->lists('id');
                $posts = Post::with('user','postSolve','postFiles','postPhotos','postSubType')
                    ->whereIn('id', $test)
                    ->orWhereIn('posted_by', $follower_ids)
                    ->orWhere('posted_by',$user_id)
                    ->orderBy('id', 'desc')->paginate($this->limit);
                return Response::json(array('newsFeed'  => $posts->toArray()),200);
            }


            elseif($filter === 'report'){
                $feed = 2;
                $test = \DB::table('app_post')->where('post_type', $feed)->lists('id');
                $posts = Post::with('user','postSolve','postFiles','postPhotos','postSubType')
                    ->whereIn('id', $test)
                    ->orWhereIn('posted_by', $follower_ids)
                    ->orWhere('posted_by',$user_id)
                    ->orderBy('id', 'desc')
                    ->paginate($this->limit);

                foreach($posts as $post){
                    $process = $this->progressLoop($post->id);
                    $post['progress'] = $process;
                }
                return Response::json(array('newsFeed'  => $posts->toArray()),200);
            }
           else{
                return Response::json(['error' => 'No Data found'], 403);
            }



    }









    public function progressLoop($post_id){

        $post = Post::where('id',$post_id)->first();

        if ($post->post_type == 2 ) {
            $comment = Comment::with('subComments')->where('post_id', $post_id)->get();
            //for progress calculation
            $commentCount = count($comment);
            $survey_among = $post->survey_among;

            return $calculate = ($commentCount / $survey_among) * 100;
        }elseif($post->post_type == 4){

            $comment = Comment::with('subComments')->where('post_id', $post_id)->get();
            //for progress calculation
            $commentCount = count($comment) + $post->participate;
            $survey_among = $post->survey_among;

            return $calculate = ($commentCount / $survey_among) * 100;
        }

        else{
            return $calculate = null;
        }

    }






    /**
     * Single Post with Progress bar
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: post_id
     * @url: http://localhost:8000/api/v2/singlePost
     * @return: json progress, post 200
     */
    public function singlePost(Request $request){

         // survey among == report, campaign
         //topic=1 , report=2, help=3,campaign=4

               try{
                   $post_id = $request->post_id;
                   $post = Post::with('user','postSolve','postFiles','postPhotos','postSubType','city')->where('id',$post_id )->first();

                    $comment = Comment::with('subComments')->where('post_id', $post->id)->get();

                   $support =  Comment::where('post_id',$post->id)->where('app_comment_type_id', 1)->count();
                   $unsupport =  Comment::where('post_id',$post->id)->where('app_comment_type_id', 2)->count();
                    //$support = $comment->where('app_comment_type_id', 1)->count();
                    //$unsupport = $comment->where('app_comment_type_id', 2)->count();
                    $share = 0;

                if(!empty($post)) {
                    if ($post->post_type == 2) {
                        //for progress calculation
                        $commentCount = count($comment);
                        $survey_among = $post->survey_among;
                        $progress = $this->progress($commentCount, $survey_among);

                        return Response::json([
                            'progress' => $progress,
                            'support'=>$support,
                            'unSupport' => $unsupport,
                            'share' => $share,
                            'post' => $post
                        ], 200);

                    }elseif($post->post_type == 4){
                        //for progress calculation
                        $commentCount = count($comment)+ $post->participate;
                        $survey_among = $post->survey_among;
                        $progress = $this->progress($commentCount, $survey_among);

                        return Response::json([
                            'progress' => $progress,
                            'support'=>$support,
                            'unSupport' => $unsupport,
                            'share' => $share,
                            'post' => $post
                        ], 200);
                    }
                    else {
                        return Response::json([
                            'progress' => 'null',
                            'support'=>$support,
                            'unSupport' => $unsupport,
                            'share' => $share,
                            'post' => $post
                        ], 200);
                    }
                }else{
                    return Response::json(['error' => 'No post found with this id'], 403);
                }

               }catch(Exception $ex){
                   return Response::json(['error' => 'Something went wrong'], 403);
        }

    }




    /**
     * Progress bar Calculation
     *
     * @param $commentCount
     * @param $survey_among
     * @return float
     */
    public function progress($commentCount,$survey_among ){

       return  $calculate = ($commentCount/$survey_among) * 100 ;

    }








}
