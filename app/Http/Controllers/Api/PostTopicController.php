<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\AppUser;
use App\ApiModel\FollowUser;
use App\ApiModel\Gcm;
use App\ApiModel\Post;
use App\ApiModel\PostAttachment;
use App\ApiModel\PostPhoto;
use App\ApiModel\PostSubType;
use Illuminate\Http\Request;
use App\ApiModel\Country;
use App\ApiModel\City;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;
use Intervention\Image\ImageManagerStatic as Image;
use Davibennun\LaravelPushNotification\Facades\PushNotification;

class PostTopicController extends Controller
{





    //post table data

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *Topic Post
     *
     * Post method
     * @param app_subType_id(int), app_city_id(int), location (string), title, description, is_emergency(0 or 1), help_info,
     * photo (multiple photo select), file (multiple select)
     * @return success 200 or error 403
     */

    public function topicPost(Request $request){

       //  $request->all();
      try{

          //country
          $country_id = City::where('id',$request->app_city_id)->pluck('country_id');
          $country = Country::where('id', $country_id )->pluck('name');

          $type = PostSubType::where('id',$request->app_subType_id)->pluck('post_type_id');

          $topic = new Post();
          //$topic->posted_by = \Auth::user()->id;
          $topic->posted_by = $request->user_id;
          $topic->app_subType_id = $request->app_subType_id;
          $topic->app_city_id = $request->app_city_id;
          $topic->location = $request->location;
          $topic->country = $country;
          $topic->title = $request->title;
          $topic->description = $request->description;
          $topic->is_active = 1;
          $topic->is_emergency = $request->is_emergency;  //1 or 0
          $topic->help_info = $request->help_info;

          $topic->post_type = $type;

          if($topic->save()){



              //multiple  photos
              if( $request->hasFile('photo')) {

              $files = $request->file('photo');

                   //return count($files);
                  foreach($files as $file) {
                      //getting the file extension
                       $extension = $file->getClientOriginalExtension();

                       $fileName = md5(rand(11111, 99999)) .time().  '.' . $extension; // renameing image
                      //path set
                       $img_url = 'upload/topicPostPhotos/img-'.$fileName;


                      list($width, $height) = getimagesize($file);
                      $h = ($height/$width)*600;
                      Image::make($file)->resize(600, $h)->save(public_path($img_url));


                      $photo = new PostPhoto();
                      $photo->app_post_id = $topic->id;
                      $photo->photo =  $img_url;
                      $photo->save();
                 }


              }



             // multiple Attachment
              if( $request->hasFile('file')) {
                  $files = $request->file;
                  foreach ($files as $file) {
                      $destinationPath = public_path() . '/upload/topicPostAttachment';
                      $extension = $file->getClientOriginalExtension();
                      $fileName = md5(rand(11111, 99999)) . '.' . $extension; // renameing image
                      $file->move($destinationPath, $fileName); // uploading file to given path

                      $file = new PostAttachment();
                      $file->app_post_id = $topic->id;
                      $file->file = '/upload/topicPostAttachment/' . $fileName;
                      $file->save();
                  }
              }


              //gcm
               try{
                      Post::sendGcm($topic->id);  //call gcm function

                    return Response::json(['success' => 'Topic Post Successfully and gcm send '], 200);
                }catch(Exception $ex){
                   return Response::json(['error' => 'Something went wrong to send gcm notification'], 403);
              }


          }
      }catch (Exception $e){
          return Response::json(['error' => 'Something went wrong'], 403);
      }

    }












}



