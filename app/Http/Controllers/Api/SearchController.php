<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
use App\ApiModel\Comment;
use App\ApiModel\FollowUser;
use App\ApiModel\Post;
use App\ApiModel\PostSubType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Mockery\CountValidator\Exception;
use Response;
use App\ApiModel\Interest;
class SearchController extends Controller
{

    //paginate
    public $limit = 10;


    /**
     * Post Search
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     *
     * Get Method
     * @param: search_text
     * @url: http://localhost:8000/api/v2/searchPostOrUser
     * @return: search json, 200
     *
     */
    public function searchPostOrUser(Request $request)
    {

        try {
            $text = '%' . $request->search_text . '%';

            $user = AppUser::where('name', 'LIKE', $text)->pluck('id');

            $posts = Post::with('user', 'postSolve', 'postFiles', 'postPhotos')
                ->where('posted_by', $user)
                ->orWhere('title', 'LIKE', $text)
                ->paginate($this->limit);

            foreach($posts as $post){
                $process = $this->progressLoop($post->id);
                $post['progress'] = $process;
            }
            return Response::json(['search' => $posts->toArray()], 200);
        } catch (Exception $ex) {
            return Response::json(['error' => 'No post found with this id'], 403);
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
     * Search Discover
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: search_text, filter[people,organization,topic,report,campaign,help]
     * @url: http://localhost:8000/api/v2/searchDiscover
     * @return: data json,200
     *
     */
    public function searchDiscover(Request $request)
    {

        try {
            //Topic,Report,Help,Campaign

            $text = '%'.$request->search_text.'%';
            $filter = $request->filter;
            $user = $request->user_id;


            if ($filter === 'people') {

                $follower = FollowUser::where('user_id',$user)->lists('following');
                $following = FollowUser::where('following',$user)->lists('user_id');

                $people = AppUser::where('user_type', 0)
                    ->where('id','!=',$user)
                    ->where('id', '!=', 1)
                    ->where('name', 'LIKE', $text)
                    ->whereNotIn('id',$follower)
                    ->whereNotIn('id',$following)
                    ->paginate($this->limit);
                //need to send location
                return Response::json(['data' => $people->toArray()], 200);
            }


            elseif ($filter === 'organization') {

                $follower = FollowUser::where('user_id',$user)->lists('following');
                $following = FollowUser::where('following',$user)->lists('user_id');

                $organization = AppUser::where('user_type', 1)
                    ->where('id','!=',$user)
                    ->where('name', 'LIKE', $text)
                    ->whereNotIn('id',$follower)
                    ->whereNotIn('id',$following)
                    ->paginate($this->limit);
                //need to send location
                return Response::json(['data' => $organization->toArray()], 200);
            }

            elseif ($filter === 'topic') {


                $interestIds = Interest::where('user_id',$user)
                    ->where('post_type',1)
                    ->lists('app_subType_id','app_subType_id');


                   $post = PostSubType::where('post_type_id', 1)
                    ->whereNotIn('id', $interestIds)
                    ->orderBy('name')
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);



                foreach($post as $pos ){
                    $total_post = Post::where('app_subType_id', $pos->id)->count();
                    $total_interest = Interest::where('app_subType_id', $pos->id)->count();

                    $pos['total_post'] = $total_post;
                    $pos['total_interest'] = $total_interest;
                }

                return Response::json([
                    'data' => $post->toArray()
                ], 200);
            }

            elseif ($filter === 'report') {

                $interestIds = Interest::where('user_id',$user)
                    ->where('post_type',2)
                    ->lists('app_subType_id','app_subType_id');


                $post = PostSubType::where('post_type_id', 2)
                    ->whereNotIn('id', $interestIds)
                    ->orderBy('name')
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);


                foreach($post as $pos ){
                    $total_post = Post::where('app_subType_id', $pos->id)->count();
                    $total_interest = Interest::where('app_subType_id', $pos->id)->count();

                    $pos['total_post'] = $total_post;
                    $pos['total_interest'] = $total_interest;
                }

                return Response::json([
                    'data' => $post->toArray()
                ], 200);
            }

            elseif ($filter === 'campaign') {

                $interestIds = Interest::where('user_id',$user)
                    ->where('post_type',4)
                    ->lists('app_subType_id','app_subType_id');


                $post = PostSubType::where('post_type_id', 4)
                    ->whereNotIn('id', $interestIds)
                    ->orderBy('name')
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);


                foreach($post as $pos ){
                    $total_post = Post::where('app_subType_id', $pos->id)->count();
                    $total_interest = Interest::where('app_subType_id', $pos->id)->count();

                    $pos['total_post'] = $total_post;
                    $pos['total_interest'] = $total_interest;
                }

                return Response::json([
                    'data' => $post->toArray()
                ], 200);
            }

            elseif ($filter === 'help') {

                $interestIds = Interest::where('user_id',$user)
                    ->where('post_type',3)
                    ->lists('app_subType_id','app_subType_id');


                $post = PostSubType::where('post_type_id', 3)
                    ->whereNotIn('id', $interestIds)
                    ->orderBy('name')
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);

                foreach($post as $pos ){
                    $total_post = Post::where('app_subType_id', $pos->id)->count();
                    $total_interest = Interest::where('app_subType_id', $pos->id)->count();

                    $pos['total_post'] = $total_post;
                    $pos['total_interest'] = $total_interest;
                }

                return Response::json([
                    'data' => $post->toArray()
                ], 200);
            }

            elseif ($filter === 'all') {

                $post = PostSubType::whereIn('post_type_id', [1, 2, 3, 4])
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);

                foreach($post as $pos ){
                    $total_post = Post::where('app_subType_id', $pos->id)->count();
                    $total_interest = Interest::where('app_subType_id', $pos->id)->count();

                    $pos['total_post'] = $total_post;
                    $pos['total_interest'] = $total_interest;
                }

                return Response::json([
                    'data' => $post->toArray()
                ], 200);
            }
            else {
                return Response::json(['error' => 'Something went wrong'], 403);
            }

        } catch (Exception $ex) {
            return Response::json(['error' => 'Something went wrong'], 403);
        }

    }


















}