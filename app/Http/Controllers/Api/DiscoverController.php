<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
use App\ApiModel\FollowUser;
use App\ApiModel\Interest;
use App\ApiModel\Post;
use App\ApiModel\PostSubType;
use Mockery\CountValidator\Exception;
use Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class DiscoverController extends Controller
{

    public $limit = 10 ;

    /**
     * Discover
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @url: /discover
     * @param: user_id, filter[people,organization,topic,report,campaign,help]
     * @return: json 200
     */
    public  function discover(Request $request){

       try{
           //Topic,Report,Help,Campaign

           $user = $request->user_id; // Auth user
           $filter = $request->filter;

           if ($filter === 'people') {

               $follower = FollowUser::where('user_id',$user)->lists('following');
               $following = FollowUser::where('following',$user)->lists('user_id');

               $people = AppUser::where( function($query) use ($filter, $user,$follower,$following ) {
                       $query->where('user_type', 0)
                            ->where('id','!=',$user)
                            ->where('id', '!=', 1)
                            ->whereNotIn('id',$follower)
                            ->whereNotIn('id',$following);
                        
                   }) 
                     ->orderBy('id', 'desc')
                     ->paginate($this->limit);
               //need to send location
               return Response::json(['data' => $people->toArray()], 200);
           }


           elseif ($filter === 'organization') {

               $follower = FollowUser::where('user_id',$user)->lists('following');
               $following = FollowUser::where('following',$user)->lists('user_id');

               $organization = AppUser::where( function($query) use ($filter, $user,$follower,$following ) {
                                    $query->where('user_type', 1)
                                    ->where('id','!=',$user)
                                    ->whereNotIn('id',$follower)
                                    ->whereNotIn('id',$following);
                               }) 
                             ->orderBy('id', 'desc')
                             ->paginate($this->limit);
               //need to send location
               return Response::json(['data' => $organization->toArray()], 200);
           }

           elseif ($filter === 'topic') {


                      $interestIds = Interest::where( function($query) use ( $user) {
                                $query->where('user_id', $user)
                                      ->where('post_type',1);
                            })->lists('app_subType_id','app_subType_id');


                       $post = PostSubType::where( function($query) use ( $interestIds) {
                                      $query->where('post_type_id', 1)
                                       ->whereNotIn('id', $interestIds)
                                       ->orderBy('name')
                                      
                                 }) 
                               ->orderBy('id', 'desc')
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

               $interestIds = Interest::where( function($query) use ( $user) {
                                $query->where('user_id', $user)
                                      ->where('post_type',2);
                            })->lists('app_subType_id','app_subType_id');

                $post = PostSubType::where( function($query) use (  $interestIds) {
                            $query->where('post_type_id', 2)
                             ->whereNotIn('id', $interestIds)
                             ->orderBy('name')
                           
                       }) 
                     ->orderBy('id', 'desc')
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

               $interestIds = Interest::where( function($query) use ( $user) {
                                $query->where('user_id', $user)
                                      ->where('post_type',4);
                            })->lists('app_subType_id','app_subType_id');


                 $post = PostSubType::where( function($query) use (  $interestIds) {
                            $query->where('post_type_id', 4)
                             ->whereNotIn('id', $interestIds)
                             ->orderBy('name')
                            
                       }) 
                     ->orderBy('id', 'desc')
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

              $interestIds = Interest::where( function($query) use ( $user) {
                                $query->where('user_id', $user)
                                      ->where('post_type',3);
                            })->lists('app_subType_id','app_subType_id');


                 $post = PostSubType::where( function($query) use ( $interestIds) {
                            $query->where('post_type_id', 3)
                             ->whereNotIn('id', $interestIds)
                             ->orderBy('name')
                          
                       }) 
                     ->orderBy('id', 'desc')
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
           else{
               return Response::json(['error' => 'Something went wrong'], 403);
           }
       }catch(Exception $ex){
           return Response::json(['error' => 'Something went wrong'], 403);
       }

    }





    /**
     * All Post associate with subCategory
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: subType_id (post sub category id)
     * @url: /discoverCategoryPost
     * @return: data json, 200
     */
    public function discoverCategoryPost(Request $request){
          $subType_id = $request->subType_id;

          $posts = Post::where('app_subType_id',$subType_id)
               ->orderBy('id', 'desc')
               ->paginate($this->limit);

        return Response::json(array('data'  => $posts->toArray()),200);
    }





}
