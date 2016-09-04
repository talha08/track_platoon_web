<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
use App\ApiModel\EmailLogin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;

class ProfileSettingController extends Controller
{





    public function updateUsername(Request $request){

        try{
            $user_id = $request->user_id;
            $username = $request->username;

            AppUser::where('id',$user_id)->update([
                'username'=> $username
            ]);
            return Response::json(['success' => 'Username updated successfully'], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id' => 200], 403);

        }
    }








    public function updateEmail(Request $request){

        try{
            $user_id = $request->user_id;
            $email = $request->email;

            $emailLogin = EmailLogin::where('app_user_id',$user_id)->first();
            if(!empty($emailLogin)){
                $emailLogin->email = $email;
                if($emailLogin->save()){
                    return Response::json(['success' => 'Email updated successfully'], 200);
                }else{
                    return Response::json(['error' => 'Something went wrong', 'error_id' => 200], 403);
                }
            }else{
                return Response::json(['error' => 'Logged with social, Cant change email', 'error_id' => 100], 403);
            }

        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id' => 200], 403);

        }
    }









    public function updatePassword(Request $request){

        try{
            $user_id = $request->user_id;
            $password = $request->password;

            $emailLogin = EmailLogin::where('app_user_id',$user_id)->first();
            if(!empty($emailLogin)){

                $emailLogin->password = \Hash::make($password);
                $emailLogin->visible_pass = \Crypt::encrypt($password);

                if($emailLogin->save()){
                    return Response::json(['success' => 'Password updated successfully'], 200);
                }else{
                    return Response::json(['error' => 'Something went wrong', 'error_id' => 200], 403);
                }
            }else{
                return Response::json(['error' => 'Logged with social, Cant change password', 'error_id' => 100], 403);
            }

        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id' => 200], 403);

        }
    }








    public function updateMobile(Request $request){

        try{
            $user_id = $request->user_id;
            $mobile = $request->mobile;

            AppUser::where('id',$user_id)->update([
                'mobile'=> $mobile
            ]);
            return Response::json(['success' => 'Mobile Number updated successfully'], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id' => 200], 403);

        }
    }




    public function updateName(Request $request){

        try{
            $user_id = $request->user_id;
            $name = $request->name;

            AppUser::where('id',$user_id)->update([
                'name'=> $name
            ]);
            return Response::json(['success' => 'Name updated successfully'], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id' => 200], 403);

        }
    }






    public function updateOccupation(Request $request){

        try{
            $user_id = $request->user_id;
            $occupation = $request->occupation;

            AppUser::where('id',$user_id)->update([
                'occupation'=> $occupation
            ]);
            return Response::json(['success' => 'Occupation updated successfully'], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id' => 200], 403);

        }
    }





    public function updateWorkPlace(Request $request){

        try{
            $user_id = $request->user_id;
            $work_place = $request->work_place;

            AppUser::where('id',$user_id)->update([
                'work_place'=> $work_place
            ]);
            return Response::json(['success' => 'Work Place updated successfully'], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id' => 200], 403);

        }
    }





    public function updateCity(Request $request){

        try{
            $user_id = $request->user_id;
            $city = $request->city;

            AppUser::where('id',$user_id)->update([
                'city'=> $city
            ]);
            return Response::json(['success' => 'City updated successfully'], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id' => 200], 403);

        }
    }




    public function updateCountry(Request $request){

        try{
            $user_id = $request->user_id;
            $country = $request->country;

            AppUser::where('id',$user_id)->update([
                'country'=> $country
            ]);
            return Response::json(['success' => 'Country updated successfully'], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id' => 200], 403);

        }
    }












}
