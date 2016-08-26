<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
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

            $post = Post::with('user', 'postSolve', 'postFiles', 'postPhotos')
                ->where('posted_by', $user)
                ->orWhere('title', 'LIKE', $text)
                ->paginate($this->limit);
            return Response::json(['search' => $post->toArray()], 200);
        } catch (Exception $ex) {
            return Response::json(['error' => 'No post found with this id'], 403);
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
                $post = PostSubType::where('post_type_id', 1)
                     ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);

                return Response::json([
                    'interestPeople'=>$interest,
                    'totalPost' => $totalPost,
                    'data' => $post->toArray()
                ], 200);
            }

            elseif ($filter === 'report') {
                $interest = Interest::where('post_type',2)->count();
                $totalPost = Post::where('post_type',2)->count();
                $post = PostSubType::where('post_type_id', 2)
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);
                return Response::json([
                    'interestPeople'=>$interest,
                    'totalPost' => $totalPost,
                    'data' => $post->toArray()
                ], 200);
            }

            elseif ($filter === 'campaign') {
                $interest = Interest::where('post_type',3)->count();
                $totalPost = Post::where('post_type',3)->count();
                $post = PostSubType::where('post_type_id', 3)
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);
                return Response::json([
                    'interestPeople'=>$interest,
                    'totalPost' => $totalPost,
                    'data' => $post->toArray()
                ], 200);
            }

            elseif ($filter === 'help') {
                $interest = Interest::where('post_type',4)->count();
                $totalPost = Post::where('post_type',4)->count();
                $post = PostSubType::where('post_type_id', 4)
                    ->where('name', 'LIKE', $text)
                    ->paginate($this->limit);
                return Response::json([
                    'interestPeople'=>$interest,
                    'totalPost' => $totalPost,
                    'data' => $post->toArray()
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