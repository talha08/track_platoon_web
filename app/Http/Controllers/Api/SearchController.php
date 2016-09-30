<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
use App\ApiModel\Comment;
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

            $text = '%' . $request->search_text . '%'; // Auth user
            $filter = $request->filter;

            if ($filter === 'people') {
                $people = AppUser::where('user_type', 0)
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);
                //need to send location
                return Response::json(['data' => $people->toArray()], 200);
            }

            elseif ($filter === 'organization') {

                $organization = AppUser::where('user_type', 1)
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);
                //need to send location
                return Response::json(['data' => $organization->toArray()], 200);
            }

            elseif ($filter === 'topic') {
                $interest = Interest::where('post_type',1)->count();
                $totalPost = Post::where('post_type',1)->count();
                $posts = PostSubType::where('post_type_id', 1)
                     ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);


                foreach($posts as $post){
                    $process = $this->progressLoop($post->id);
                    $post['progress'] = $process;
                }


                return Response::json([
                    'interestPeople'=>$interest,
                    'totalPost' => $totalPost,
                    'data' => $posts->toArray()
                ], 200);
            }

            elseif ($filter === 'report') {
                $interest = Interest::where('post_type',2)->count();
                $totalPost = Post::where('post_type',2)->count();
                $posts = PostSubType::where('post_type_id', 2)
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);

                foreach($posts as $post){
                    $process = $this->progressLoop($post->id);
                    $post['progress'] = $process;
                }


                return Response::json([
                    'interestPeople'=>$interest,
                    'totalPost' => $totalPost,
                    'data' => $posts->toArray()
                ], 200);
            }

            elseif ($filter === 'campaign') {
                $interest = Interest::where('post_type',4)->count();
                $totalPost = Post::where('post_type',4)->count();
                $posts = PostSubType::where('post_type_id', 4)
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);

                foreach($posts as $post){
                    $process = $this->progressLoop($post->id);
                    $post['progress'] = $process;
                }

                return Response::json([
                    'interestPeople'=>$interest,
                    'totalPost' => $totalPost,
                    'data' => $posts->toArray()
                ], 200);
            }

            elseif ($filter === 'help') {
                $interest = Interest::where('post_type',3)->count();
                $totalPost = Post::where('post_type',3)->count();
                $posts = PostSubType::where('post_type_id', 3)
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);

                foreach($posts as $post){
                    $process = $this->progressLoop($post->id);
                    $post['progress'] = $process;
                }


                return Response::json([
                    'interestPeople'=>$interest,
                    'totalPost' => $totalPost,
                    'data' => $posts->toArray()
                ], 200);
            }

            elseif ($filter === 'all') {
                $interest = Interest::count();
                $totalPost = Post::count();
                $post = PostSubType::whereIn('post_type_id', [1, 2, 3, 4])
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);
                return Response::json([
                    'interestPeople'=>$interest,
                    'totalPost' => $totalPost,
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