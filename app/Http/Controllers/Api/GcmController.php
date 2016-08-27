<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\Gcm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
class GcmController extends Controller
{

    /**
     * @param Request $request
     *
     * Post method
     * @param: user_id , device_token
     * @url: /gcmStore
     * @return success, error
     */
    public function gcmStore(Request $request){

        $user_id = $request->user_id;
        $device_token  = $request->device_token;


        $gcm = new Gcm();
        $gcm->user_id = $user_id;
        $gcm->device_token = $device_token;
        if($gcm->save()){
            return Response::json(['success' => 'Topic Post Successfully'], 200);
        }else{
            return Response::json(['error' => 'Something went wrong'], 403);
        }
    }
}
