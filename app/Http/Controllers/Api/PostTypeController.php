<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ApiModel\PostType;
use App\ApiModel\PostSubType;
use Response;
use Mockery\Exception;

class PostTypeController extends Controller
{



    /**
     * @return \Illuminate\Http\JsonResponse
     *
     * Post Type
     *
     * Get Method
     * @url: http://localhost:8000/api/v2/postType
     * @param none
     * return postType json 200 or error 403
     */
    public function postType(){


        try{
            $postType = PostType::all();

            return Response::json(['postType' => $postType], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong'], 403);
        }
    }





    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Post Sub type
     *
     * Get Method
     * @url: http://localhost:8000/api/v2/postSubType
     * @param postType_id
     * return postSubType json  200  or error 403
     */
    public function postSubType(Request $request){

        try{
            $postType_id = $request->postType_id;
            $subType = PostSubType::where('post_type_id', $postType_id )->get();

            return Response::json(['postSubType' => $subType], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong'], 403);
        }
    }

}
