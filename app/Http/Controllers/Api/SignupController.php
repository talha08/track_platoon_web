<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\EmailLogin;
use Illuminate\Http\Request;
use App\ApiModel\AppUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use EllipseSynergie\ApiResponse;
use Mockery\CountValidator\Exception;
use Response;

class SignupController extends Controller
{


    /**
     * Random number Generate For Confirmation Code
     *
     * @return string
     */
     public static function genRandomString() {
            $length = 4;
            $characters = '0123456789ABCDEFGHIZKLMNOPQRSTUVWXYZ';
            $string = '';

            for ($p = 0; $p < $length; $p++) {
                $string .= $characters[mt_rand(0, strlen($characters) - 1)];
            }

               return $string;
     }







    /**
     * Email Sign Up
     * Post Method
     * @param email,password,name, account_type  = (0 for person, 1 for organization)
     * @param Request $request
     * @return success, 200
     */
    public function register(Request $request){

         $email = $request->email;
        $password = $request->password;
        $name = $request->name;
        $user_type = $request->account_type;


        $confirm_code = $this->genRandomString();

        $user_exists= EmailLogin::where('email', $email)->count();


        if(empty($user_exists)){


                $user = new AppUser();
                $user->name = $name;
                $user->user_type = $user_type; //0 for person, 1 for organization
                $user->confirm_code = $confirm_code;
                $user->account_type_id = 1;

                if($user->save()){
                    $email_register = new EmailLogin();
                    $email_register->app_user_id = $user->id;
                    $email_register->email = $email;
                    $email_register->visible_pass = \Crypt::encrypt($password);
                    $email_register->password = \Hash::make($password);

                    if($email_register->save()){

                        try{
                            \Mail::send('emails.activation', ['confirm_code'=>$confirm_code],
                                function($message) {
                                    $message->to(\Input::get('email'))
                                        ->subject('Verify your Confirmation Code');
                                });
                            return Response::json(['success'=>'User successfully added, Confirmation code sent'], 200);

                        }catch(Exception $e){
                            return Response::json(['error'=>'Confirmation code sending Problem'], 403);
                        }


                    }else{

                        return Response::json(['error'=>'Confirmation code sending Problem'], 403);
                    }
                }else{

                    return Response::json(['error'=>'Something went wrong'], 403);
                }


        }else{
            return Response::json(['error'=>'User Already Exists'], 403);
        }



    }









    /**
     * Account Confirmation
     * Post Method
     * @param email,confirm_code,
     * @param Request $request
     * @return user_id
     */
    public function confirmAccount(Request $request){

        $confirm_code = $request->confirm_code;
        $email = $request->email;

        $user_email_login_id = EmailLogin::where('email', $email)->pluck('app_user_id');
         $database_code= AppUser::where('id',$user_email_login_id )->pluck('confirm_code');

        if($database_code === $confirm_code ){

            $user = AppUser::findOrFail($user_email_login_id);

            $user->confirm_code = null;
            $user->is_active = 1;
            if($user->save()){
                return Response::json(['user_id'=> $user_email_login_id], 200);
            }else{

                return Response::json(['error'=>'Something went wrong'], 403);
            }
        }else{
            return Response::json(['error'=>'Code not matched'], 403);
        }

    }


    /**
     * Resend Confirmation Code
     * Post method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: email
     * @url: /resendConfirmationCode
     * @return: success,error
     *
     */
  public function resendConfirmationCode(Request $request){
        $email = $request->email;

          $user_id= EmailLogin::where('email', $email)->pluck('app_user_id');
          $confirm_code = AppUser::where('id',$user_id )->pluck('confirm_code');

      try{
          \Mail::send('emails.activation', ['confirm_code'=>$confirm_code],
              function($message) {
                  $message->to(\Input::get('email'))
                      ->subject('Verify your Confirmation Code');
              });
          return Response::json(['success'=>'Confirmation code sent'], 200);

      }catch(Exception $e){
          return Response::json(['error'=>'Confirmation code sending Problem'], 403);
      }

  }




}
