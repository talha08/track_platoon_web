<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
use App\ApiModel\EmailLogin;
use App\ApiModel\SocialLogin;
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
    // Normal Login System
     ********************************************************/


    /**
     * Email login System
     *
     * Post Method
     * @param email. password
     * @param Request $request
     * @return user_id
     */
    public function normalLogin(Request $request)
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
            return Response::json(['error'=>'Validation failed'], 403);
        } else
        {

                $email   = $allInput['email'];
                $password = $allInput['password'];

                $user_id = EmailLogin::where('email', $email)->first();

                 $user_active = AppUser::where('id',$user_id->app_user_id)->first();


                if(!empty($user_id)){

                    if($user_active->is_active == 1 ){   // user active check

                        $user_pass = EmailLogin::where('id', $user_id->id)->pluck('password');
                        //Hash::check('INPUT PASSWORD', database password);
                        if(Hash::check($password, $user_pass)){

                            return Response::json(['user_id'=> $user_id->app_user_id], 200);
                        }else{
                            return Response::json(['error'=>'Wrong Password'], 403);
                        }
                    }else{
                        return Response::json(['error'=>'Unauthorized account, please confirm your account'], 403);
                    }

                }else{
                    return Response::json(['error'=>'No user found with this account'], 403);
                }

        }

    }





    /*********************************************************
       // Social Login System
     ********************************************************/


    /**
     * Social Login
     * Post Method
     * @param social_id,account_type= 2 or 3 ,name,email,profile_pic
     * @param Request $request
     * @return user_id
     */
    public function loginWithSocial(Request $request)
    {

        $social_id = $request->social_id;
        $account_type = $request->account_type;


        //facebook
        if ($account_type == 2) {

            $user_id = SocialLogin::where('social_login_id', '=', $social_id)->pluck('app_user_id');

            if (!empty($user_id)) {

                return Response::json(['user_id' => $user_id], 200);

            } else {

                $appUser = new AppUser();
                $appUser->name = $request->name;
                $appUser->profile_pic = $request->profile_pic;
                $appUser->is_active = 1;
                $appUser->account_type_id = $account_type;
                if ($appUser->save()) {

                    $social = new SocialLogin();
                    $social->app_user_id = $appUser->id;
                    $social->email = $request->email;
                    $social->social_login_id = $social_id;

                    if ($social->save()) {
                        return Response::json(['user_id' => $social->app_user_id, 'success' => 'Login successfully'], 200);
                    } else {
                        return Response::json(['error' => 'Something went wrong'], 403);
                    }
                } else {
                    return Response::json(['error' => 'Something went wrong'], 403);
                }
            }
        }




        //google

        elseif ($account_type == 3) {
            $user_id = SocialLogin::where('social_login_id', '=', $social_id)->pluck('app_user_id');

            if (!empty($user_id)) {

                return Response::json(['user_id' => $user_id], 200);

            } else {

                $appUser = new AppUser();
                $appUser->name = $request->name;
                $appUser->profile_pic = $request->profile_pic;
                $appUser->is_active = 1;
                $appUser->account_type_id = $account_type;
                if ($appUser->save()) {

                    $social = new SocialLogin();
                    $social->app_user_id = $appUser->id;
                    $social->email = $request->email;
                    $social->social_login_id = $social_id;

                    if ($social->save()) {
                        return Response::json(['user_id' => $social->app_user_id, 'success' => 'Login successfully'], 200);
                    } else {
                        return Response::json(['error' => 'Something went wrong'], 403);
                    }
                } else {
                    return Response::json(['error' => 'Something went wrong'], 403);
                }
            }
        }



        //twitter

        elseif ($account_type == 4) {
            $user_id = SocialLogin::where('social_login_id', '=', $social_id)->pluck('app_user_id');

            if (!empty($user_id)) {

                return Response::json(['user_id' => $user_id], 200);

            } else {

                $appUser = new AppUser();
                $appUser->name = $request->name;
                $appUser->profile_pic = $request->profile_pic;
                $appUser->is_active = 1;
                $appUser->account_type_id = $account_type;
                if ($appUser->save()) {

                    $social = new SocialLogin();
                    $social->app_user_id = $appUser->id;
                    $social->email = $request->email;
                    $social->social_login_id = $social_id;

                    if ($social->save()) {
                        return Response::json(['user_id' => $social->app_user_id, 'success' => 'Login successfully'], 200);
                    } else {
                        return Response::json(['error' => 'Something went wrong'], 403);
                    }
                } else {
                    return Response::json(['error' => 'Something went wrong'], 403);
                }
            }
        }



    }








}
