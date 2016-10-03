<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\Gcm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
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

        $gcm_id =Gcm::where('device_token','LIke',$device_token)->get();
        if(empty($gcm_id)){
            $gcm = new Gcm();
            $gcm->user_id = $user_id;
            $gcm->device_token = $device_token;
            if($gcm->save()){
                return Response::json(['success' => 'Device Token Added Successfully'], 200);
            }else{
                return Response::json(['error' => 'Something went wrong' , 'error_code'=>300], 403);
            }
        }else{
            return Response::json(['error' => 'Already in the list, Duplicate entry', 'error_code'=>100], 403);
        }

    }


    /**
     *
     * Logout
     * Get Method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: user_id
     * @url: /logout
     * return success, error (error_code =300)
     *
     */
    public function logout(Request $request){
        try{
             $user_id = $request->user_id;
             $deletedRows = Gcm::where('user_id',$user_id)->delete();

            return Response::json(['success' => 'Logout Successfully'], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_code'=>300], 403);
        }
    }




}
