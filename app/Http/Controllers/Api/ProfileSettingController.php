<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
use App\ApiModel\EmailLogin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileSettingController extends Controller
{


    /**
     * Update UserName
     * Post Method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: user_id, username
     * @url: /updateUsername
     * @return: success 200, error(error_id = 403)
     */
    public function updateUsername(Request $request){

        try{
            $user_id = $request->user_id;
            $username = $request->username;

            AppUser::where('id',$user_id)->update([
                'username'=> $username
            ]);
            return Response::json(['success' => 'Username updated successfully'], 200);
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id' => 403], 403);

        }
    }







    /**
     * Update Email
     * Post Method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: user_id, email
     * @url: /updateEmail
     * @return: success 200, error
     */
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








    /**
     * Update Password
     * Post Method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: user_id, old_password, new_password
     * @url: /updatePassword
     * @return: success 200, error
     */
    public function updatePassword(Request $request){

        try{
            $user_id = $request->user_id;
            $old_password = $request->old_password;
            $password = $request->new_password;

            $emailLogin = EmailLogin::where('app_user_id',$user_id)->count();

                    if(!empty($emailLogin)){

                        $checkPass = EmailLogin::where('app_user_id',$user_id)->where('password',$old_password)->first();

                        if(!empty($checkPass)){

                            if($checkPass->account_type_id == 1) {
                                $checkPass->password = \Hash::make($password);
                                $checkPass->visible_pass = \Crypt::encrypt($password);

                                if($checkPass->save()){
                                    return Response::json(['success' => 'Password updated successfully'], 200);
                                }else{
                                    return Response::json(['error' => 'Something went wrong', 'error_id' => 300], 403);
                                }

                            }else{
                                return Response::json(['error' => 'Logged with social, Cant change password', 'error_id' => 100], 403);
                            }

                        }else{
                            return Response::json(['error' => 'wrong password inserted, please try again','error_id'=> 401 ], 403);
                        }

                    }else{
                        return Response::json(['error' => 'No user found with this user id', 'error_id' => 404], 403);
                    }




        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong', 'error_id' => 200], 403);

        }
    }







    /**
     * Update Mobile
     * Post Method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: user_id, mobile
     * @url: /updateMobile
     * @return: success 200, error
     */
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




    /**
     * Update Name
     * Post Method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: user_id, name
     * @url: /updateName
     * @return: success 200, error
     */
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





    /**
     * Update Occupation
     * Post Method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: user_id, occupation
     * @url: /updateOccupation
     * @return: success 200, error
     */
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




    /**
     * Update Work Place
     * Post Method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: user_id, work_place
     * @url: /updateWorkPlace
     * @return: success 200, error
     */
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




    /**
     * Update City
     * Post Method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: user_id, city
     * @url: /updateCity
     * @return: success 200, error
     */
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



    /**
     * Update Country
     * Post Method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: user_id, country
     * @url: /updateCountry
     * @return: success 200, error
     */
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





    /**
     * Update Country
     * Post Method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: user_id, image
     * @url: /changeProfileImage
     * @return: success 200, error
     */
    public function changeProfileImage(Request $request)
    {
        try
        {
            $user_id = $request->user_id;
            if ($request->hasFile('image'))
            {
                $user = AppUser::where('id', $user_id)->first();
                $prev_icon_url = $user->profile_pic;
                if ($prev_icon_url == \Request::root() . '/upload/default/icon.jpg')
                {

                    //

                }
                else
                {
                    if (\File::exists($prev_icon_url))
                    {
                        \File::delete($prev_icon_url);
                    }
                }

                $image = $request->file('image');
                $icon_url = '/upload/profile/icon-'.$user_id . rand(111111, 99999) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(45, 45)->save(public_path($icon_url));

                AppUser::where('id', $user_id)->update([
                    'profile_pic' => \Request::root().$icon_url
                ]);

                return Response::json(['success' => 'Image updated successfully'], 200);
            }
            else
            {
                return Response::json(['error' => 'image not selected', 'error_id' => 400], 403);
            }
        }

        catch(Exception $ex)
        {
            return Response::json(['error' => 'Something went wrong', 'error_id' => 400], 403);
        }
    }









}
