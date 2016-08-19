<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;

class UserBannedController extends Controller
{


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Post Method
     * @url: http://localhost:8000/api/v2/userBanRequest
     * @param user_id
     * return success 200 or error 403
     */
    public function userBanRequest(Request $request){

       try{
           $user_id = $request->user_id;

           AppUser::where('id',$user_id )->update([
               'is_banned' => 1,
           ]);
           return Response::json(['success' => 'Request sent successfully'], 200);
       }catch(Exception $ex){
           return Response::json(['error' => 'Something went wrong'], 403);
       }
    }




}
