<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use Response;
use Intervention\Image\ImageManagerStatic as Image;
use App\ApiModel\Post;
use App\ApiModel\PostAttachment;
use App\ApiModel\PostPhoto;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostHelpController extends Controller
{



    /**
     * Help Post
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     *
     * Post method
     * @param app_subType_id(int), app_city_id(int), location (string), title, description, is_emergency(0 or 1), help_info,
       photo (multiple photo select), file (multiple select), user_id
     * @return success 200 or error 403
     */

    public function helpPost(Request $request){

        try{
            $topic = new Post();
            //$topic->posted_by = \Auth::user()->id;
            $topic->posted_by = $request->user_id;
            $topic->app_subType_id = $request->app_subType_id;
            $topic->app_city_id = $request->app_city_id;
            $topic->location = $request->location;

            $topic->title = $request->title;
            $topic->description = $request->description;
            $topic->is_active = 1;
            $topic->is_emergency = $request->is_emergency;  //1 or 0
            $topic->help_info = $request->help_info;
            if($topic->save()){



                //multiple  photos
                if( $request->hasFile('photo')) {
                    $files = $request->photo;
                    foreach ($files as $file) {

                        //getting the file extension
                        $extension = $file->getClientOriginalExtension();
                        $fileName = md5(rand(11111, 99999)) . '.' . $extension; // renameing image
                        //path set
                        $img_url = 'upload/helpPostPhotos/img-'.$fileName;

                        //resize and crop image using Image Intervention
                        //Image::make($file)->crop(558, 221, 0, 0)->save(public_path($img_url));
                        Image::make($file)->resize(558, 221)->save(public_path($img_url));


                        $photo = new PostPhoto();
                        $photo->app_post_id = $topic->id;
                        $photo->photo =  $img_url;
                        $photo->save();
                    }
                }




                //multiple Attachment
                if( $request->hasFile('file')) {
                    $files = $request->file;
                    foreach ($files as $file) {
                        $destinationPath = public_path() . '/upload/helpPostAttachment';
                        $extension = $file->getClientOriginalExtension();
                        $fileName = md5(rand(11111, 99999)) . '.' . $extension; // renameing image
                        $file->move($destinationPath, $fileName); // uploading file to given path

                        $file = new PostAttachment();
                        $file->app_post_id = $topic->id;
                        $file->file = '/upload/helpPostAttachment/' . $fileName;
                        $file->save();
                    }
                }


                return Response::json(['success' => 'Help Post Successfully Posted '], 200);
            }
        }catch (Exception $e){
            return Response::json(['error' => 'Something went wrong'], 403);
        }

    }


}
