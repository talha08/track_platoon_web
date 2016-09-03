<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
use App\ApiModel\Interest;
use App\ApiModel\Post;
use App\ApiModel\PostSubType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;

class InterestController extends Controller
{
    //only for post category interest show
    //[topic,report,help,campaign]



    //pagination
    public $limit = 10;





    /**
     * new Interest
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Post method
     * @param: user_id, subType_id
     * @url: http://platoon.sustcse12.cf/api/v2/interestPostType
     * @return: success, error
     */
    public function interestPostType(Request $request){
            $user_id =$request->user_id;
            $subtype_id= $request->subType_id;
            $post = PostSubType::where('id',$subtype_id)->pluck('post_type_id');

            $interest = new Interest();
            $interest->user_id = $user_id;
            $interest->app_subType_id = $subtype_id;
            $interest->post_type = $post;
            if($interest->save()){
                return Response::json(['success' => 'Interest added successfully'], 200);
            }else{
                return Response::json(['error' => 'Something went wrong'], 403);
            }
    }










    /**
     * Show Interest
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: user_id, filter[topic,report,help,campaign]
     * @url: http://platoon.sustcse12.cf/api/v2/showInterest
     * @return: json data.
     */
    public function showInterest(Request $request){
        try {
            //Topic=1,Report=2,Help=3,Campaign=4

            $user_id = $request->user_id;
            $filter = $request->filter;


            if ($filter === 'topic') {
                $posts = Interest::with('postSubType')->where('post_type', 1)
                    ->where('user_id', '=', $user_id)
                    ->get();

                foreach($posts as $post ){
                    $total_post = Post::where('app_subType_id', $post->app_subType_id)->count();
                    $total_interest = Interest::where('app_subType_id', $post->app_subType_id)->count();

                    $post['total_post'] = $total_post;
                    $post['total_interest'] = $total_interest;
                }

                return Response::json(['data' => $posts], 200);
            }




            elseif ($filter === 'report') {
                $posts = Interest::with('postSubType')->where('post_type', 2)
                    ->where('user_id', '=', $user_id)
                    // ->paginate($this->limit);
                    ->get();

                foreach($posts as $post ){
                    $total_post = Post::where('app_subType_id', $post->app_subType_id)->count();
                    $total_interest = Interest::where('app_subType_id', $post->app_subType_id)->count();

                    $post['total_post'] = $total_post;
                    $post['total_interest'] = $total_interest;
                }


                return Response::json(['data' => $posts], 200);
            }



            elseif ($filter === 'campaign') {
                $posts = Interest::with('postSubType')->where('post_type', 3)
                    ->where('user_id', '=', $user_id)
                    ->get();

                foreach($posts as $post ){
                    $total_post = Post::where('app_subType_id', $post->app_subType_id)->count();
                    $total_interest = Interest::where('app_subType_id', $post->app_subType_id)->count();

                    $post['total_post'] = $total_post;
                    $post['total_interest'] = $total_interest;
                }

                return Response::json(['data' => $posts], 200);
            }



            elseif ($filter === 'help') {
                $posts = Interest::with('postSubType')->where('post_type', 4)
                    ->where('user_id', '=', $user_id)
                    ->get();

                foreach($posts as $post ){
                    $total_post = Post::where('app_subType_id', $post->app_subType_id)->count();
                    $total_interest = Interest::where('app_subType_id', $post->app_subType_id)->count();

                    $post['total_post'] = $total_post;
                    $post['total_interest'] = $total_interest;
                }

                return Response::json(['data' => $posts], 200);
            }



            elseif ($filter === 'all') {
                $posts = Interest::with('postSubType')->whereIn('post_type', [1, 2, 3, 4])
                    ->where('user_id', '=', $user_id)
                    ->get();

                foreach($posts as $post ){
                    $total_post = Post::where('app_subType_id', $post->app_subType_id)->count();
                    $total_interest = Interest::where('app_subType_id', $post->app_subType_id)->count();

                    $post['total_post'] = $total_post;
                    $post['total_interest'] = $total_interest;
                }

                return Response::json(['data' => $posts], 200);
            }


            else {
                $posts = Interest::with('postSubType')->whereIn('post_type', [1, 2, 3, 4])
                    ->where('user_id', '=', $user_id)
                    ->get();

                foreach($posts as $post ){
                    $total_post = Post::where('app_subType_id', $post->app_subType_id)->count();
                    $total_interest = Interest::where('app_subType_id', $post->app_subType_id)->count();

                    $post['total_post'] = $total_post;
                    $post['total_interest'] = $total_interest;
                }

                return Response::json(['data' => $posts], 200);
            }

        } catch (Exception $ex) {
            return Response::json(['error' => 'Something went wrong'], 403);
        }


    }






    /**
     * Interest Remove
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Post Method
     * @param: user_id, interest_id
     * @url: http://platoon.sustcse12.cf/api/v2/removeInterest
     * @return: success, error
     */
    public function removeInterest(Request $request){

        try{
            $user_id = $request->user_id;
            $interest_id = $request->interest_id;

            $inter = Interest::where('user_id', $user_id)
                    ->where('id',$interest_id);

            if($inter->delete()){
                return Response::json(['success' => 'Interest removed successfully'], 200);
            }else{
                return Response::json(['error' => 'Something went wrong'], 403);
            }

        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong'], 403);
        }

    }


}
