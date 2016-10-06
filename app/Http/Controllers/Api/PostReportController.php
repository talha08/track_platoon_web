<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\City;
use App\ApiModel\Country;
use App\ApiModel\PostSubType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;
use App\ApiModel\Post;
use App\ApiModel\PostPhoto;
use App\ApiModel\PostAttachment;
use Intervention\Image\ImageManagerStatic as Image;

class PostReportController extends Controller
{



    /**
     * Report Post
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     *
     * Post method
     * @param app_subType_id(int), app_city_id(int), location (string), title, description, is_emergency(0 or 1),
         photo (multiple photo select), file (multiple select), hide_id (0 for none, 1 for hide), survey_among
     * @return success 200 or error 403
     */

    public function reportPost(Request $request){

        try{
            $topic = new Post();
            if($request->hide_id == 1 ){
                $topic->posted_by = 1;  // Annonymus user
            }else{
                $topic->posted_by = $request->user_id;
            }

            //post type
            $type = PostSubType::where('id',$request->app_subType_id)->pluck('post_type_id');

            //country
            $country_id = City::where('id',$request->app_city_id)->pluck('country_id');
            $country = Country::where('id', $country_id )->pluck('name');

            $topic->app_subType_id = $request->app_subType_id;
            $topic->app_city_id = $request->app_city_id;
            $topic->location = $request->location;

            $topic->survey_among = $request->survey_among;  // only for report
            $topic->country = $country;
            $topic->title = $request->title;
            $topic->description = $request->description;
            $topic->is_active = 1;
            $topic->is_emergency = $request->is_emergency;  //1 or 0
           // $topic->help_info = $request->help_info;

            $topic->post_type = $type;

            if($topic->save()){


                //multiple  photos
                if( $request->hasFile('photo')) {
                    $files = $request->photo;
                    foreach ($files as $file) {
                        $destinationPath = public_path() . '/upload/reportPostPhotos';
                        $extension = $file->getClientOriginalExtension();
                        $fileName = md5(rand(11111, 99999)) . '.' . $extension; // renameing image
                        $file->move($destinationPath, $fileName); // uploading file to given path

                        $photo = new PostPhoto();
                        $photo->app_post_id = $topic->id;
                        $photo->photo = '/upload/reportPostPhotos/' . $fileName;
                        $photo->save();
                    }
                }




                //multiple Attachment
                if( $request->hasFile('file')) {
                    $files = $request->file;
                    foreach ($files as $file) {
                        $destinationPath = public_path() . '/upload/reportPostAttachment';
                        $extension = $file->getClientOriginalExtension();
                        $fileName = md5(rand(11111, 99999)) . '.' . $extension; // renameing image
                        $file->move($destinationPath, $fileName); // uploading file to given path

                        $file = new PostAttachment();
                        $file->app_post_id = $topic->id;
                        $file->file = '/upload/reportPostAttachment/' . $fileName;
                        $file->save();
                    }
                }

                //gcm
                try{
                    Post::sendGcm($topic->id);  //call gcm function

                    return Response::json(['success' => 'Report Post Successfully and gcm send '], 200);
                }catch(Exception $ex){
                    return Response::json(['error' => 'Something went wrong to send gcm notification'], 403);
                }

            }
        }catch (Exception $e){
            return Response::json(['error' => 'Something went wrong'], 403);
        }

    }

}
