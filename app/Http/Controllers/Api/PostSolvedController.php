<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\Post;
use App\ApiModel\PostAttachment;
use App\ApiModel\PostPhoto;
use App\ApiModel\PostSolved;
use App\ApiModel\PostSolvedAttachment;
use App\ApiModel\PostSolvedPhoto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Response;
use Intervention\Image\ImageManagerStatic as Image;

class PostSolvedController extends Controller
{

    /**
     * Post solved
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param: post_id, title, description, help_info
     * @url: http://localhost:8000/api/v2/postSolved
     * @return: success 200/ error 403
     */
    public function postSolved(Request $request){

        try{
            $solved = new PostSolved();
            $solved->post_id = $request->post_id;
            $solved->title = $request->title;
            $solved->description = $request->description;
            $solved->help_info = $request->help_info;
            if($solved->save()){

                $post = new Post();
                $post->is_active = 0;
                $post->save();

                //multiple  photos
                if( $request->hasFile('photo')) {
                    $files = $request->photo;
                    foreach ($files as $file) {

                        //getting the file extension
                        $extension = $file->getClientOriginalExtension();
                        $fileName = md5(rand(11111, 99999)) .time(). '.' . $extension; // renameing image
                        //path set
                        $img_url = 'upload/solvedPostPhoto/img-'.$fileName;

                        //resize and crop image using Image Intervention
                        //Image::make($file)->crop(558, 221, 0, 0)->save(public_path($img_url));
                        Image::make($file)->save(public_path($img_url));


                        $photo = new PostSolvedPhoto();
                        $photo->app_post_solved_id = $request->post_id;
                        $photo->photo =  $img_url;
                        $photo->save();
                    }
                }




                //multiple Attachment
                if( $request->hasFile('file')) {
                    $files = $request->file;
                    foreach ($files as $file) {
                        $destinationPath = public_path() . '/upload/solvedPostAttachment';
                        $extension = $file->getClientOriginalExtension();
                        $fileName = md5(rand(11111, 99999)) . '.' . $extension; // renameing image
                        $file->move($destinationPath, $fileName); // uploading file to given path

                        $file = new PostSolvedAttachment();
                        $file->app_post_solved_id = $request->post_id;
                        $file->file = '/upload/solvedPostAttachment/' . $fileName;
                        $file->save();
                    }
                }

                //gcm
                try{
                    Post::sendGcm($solved->post_id);  //call gcm function

                    return Response::json(['success' => 'Post Successfully Solved and gcm send '], 200);
                }catch(Exception $ex){
                    return Response::json(['error' => 'Something went wrong to send gcm notification'], 403);
                }

            }else{
                return Response::json(['error' => 'Something went wrong'], 403);
            }
        }catch(Exception $ex){
            return Response::json(['error' => 'Something went wrong'], 403);
        }

    }


    /**
     * Post Delete
     * Get Method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: user_id,post_id
     * @url: /postDelete
     * @return : success, error
     *
     */
    public function postDelete(Request $request){

        $user_id = $request->user_id;
        $post_id = $request->post_id;

        $post = Post::where('posted_by',$user_id)->where('id',$post_id)->first();

     if($post != null){
         if ($post->delete()) {

             $attachments = PostAttachment::where('app_post_id', $post_id)->get();
             if($attachments != null) {
                 foreach($attachments as $attachment){

                     if (\File::exists($attachment->file)) {
                         \File::delete($attachment->file);
                     }
                     $attachment->delete();

                 }
             }

             $photos = PostPhoto::where('app_post_id', $post_id)->get();
             if($photos != null) {

                foreach($photos as $photo){
                    if (\File::exists($photo->photo)) {
                        \File::delete($photo->photo);
                    }
                    $photo->delete();
                }

             }

           return Response::json(['success' => 'Post deleted successfully'], 200);
         }
     }
     else{
         return Response::json(['error' => 'The request post is not listed with this corresponding user'], 403);
     }
    }















}
