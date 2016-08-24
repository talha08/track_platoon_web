<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\PostSolved;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;

class PostSolvedController extends Controller
{

    /**
     * Post solved
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: post_id, title, description, help_info
     * @url: http://localhost:8000/api/v2/postSolved
     * @return: success 200/ error 403
     */
    public function postSolved(Request $request){

        try{
            $solved = new PostSolved();
            $solved->post_id = $request->post_id;
            $solved->title = $request->title;
            $solved->description = $request->description;
            $solved->help_info = $request->help_info;
            if($solved->save()){
                return Response::json(['success' => 'Post Successfully Solved'], 200);
            }else{
                return Response::json(['error' => 'Something went wrong'], 403);
            }
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong'], 403);
        }

    }







}
