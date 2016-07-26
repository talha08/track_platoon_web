<?php

namespace App\Http\Controllers\Api;

use App\User;
use Validator;
use Auth;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Input;
use OAuth;
use App\Http\Requests;
use Redirect;
use Session;

class LoginController extends Controller
{


    /*********************************************************
    // Social Login System
     ********************************************************/


    /**
     * Email login System
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function doLogin(Request $request)
    {
        $rules = array
        (
            'email'    => 'required',
            'password' => 'required'
        );
        $allInput = $request->all();
        $validation = Validator::make($allInput, $rules);

        // dd($allInput);


        if ($validation->fails())
        {
            return Response::json(['error'=>'email_and_username_not_match'], 403);
        } else
        {

            $credentials = array
            (
                'email'    => $allInput['email'],
                'password' => $allInput['password']
            );

            if (Auth::attempt($credentials))
            {
                $user = Auth::user()->id;
                return $user;
            } else
            {
                return Response::json(['error'=>'Something_went_wrong'], 403);
            }
        }

    }





    /*********************************************************
       // Social Login System
     ********************************************************/




    /**
     * Facebook Login System
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginWithFacebook(Request $request) {

          $user_fb_id = $request->user_fb_id;
          $social_id = User::where('type', '=', 'facebook')
                        ->where('social_id','=',$user_fb_id )->pluck('id');

        if(!empty($social_id)){

            return $social_id;

        }else{

            // store data
        }
    }






    /**
     * Google Login System
     * @param Request $request
     * @return mixed
     */
    public function loginWithGoogle(Request $request) {


        $user_gp_id = $request->user_gp_id;
        $social_id = User::where('type', '=', 'google')
            ->where('social_id','=',$user_gp_id )->pluck('id');

        if(!empty($social_id)){

            return $social_id;
        }else{


            // store data
        }


    }





    /**
     * Twitter Login System
     * @param Request $request
     * @return mixed
     */
    public function loginWithTwitter(Request $request) {


        $user_tt_id = $request->user_gp_id;
        $social_id = User::where('type', '=', 'twitter')
            ->where('social_id','=',$user_tt_id )->pluck('id');

        if(!empty($social_id)){

            return $social_id;
        }else{


            // store data
        }


    }





    public function normalSignUp(Request $request){

        $user = new User();

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = 'normal';
        if($user->save()){

        }

    }


}
