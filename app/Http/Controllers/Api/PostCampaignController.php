<?php
namespace App\Http\Controllers\Api;


use App\ApiModel\PostSubType;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use Response;
use Intervention\Image\ImageManagerStatic as Image;
use App\ApiModel\Post;
use App\ApiModel\PostAttachment;
use App\ApiModel\PostPhoto;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class PostCampaignController extends Controller
{



    /**
     * Campaign Post
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     *
     * Post method
     * @param app_subType_id(int), app_city_id(int), location (string), title, description, is_emergency(0 or 1),
    photo (multiple photo select), file (multiple select), survey_among, help_info, survey_among
     * @return success 200 or error 403
     */
    public function campaignPost(Request $request){
        try{
            $type = PostSubType::where('id',$request->app_subType_id)->pluck('post_type_id');

            $campaign = new Post();
            $campaign->posted_by = $request->user_id;
            $campaign->app_subType_id = $request->app_subType_id;
            $campaign->post_type = $request->app_subType_id;
            $campaign->app_city_id = $request->app_city_id;
            $campaign->location = $request->location;
            $campaign->survey_among = $request->survey_among;  // only for report
            $campaign->title = $request->title;
            $campaign->description = $request->description;
            $campaign->is_active = 1;
            $campaign->is_emergency = $request->is_emergency;  //1 or 0
            $campaign->help_info = $request->help_info;

            $campaign->post_type = $type;

            if($campaign->save()){


                //multiple  photos
                if( $request->hasFile('photo')) {
                    $files = $request->photo;
                    foreach ($files as $file) {
                        //getting the file extension
                        $extension = $file->getClientOriginalExtension();
                        $fileName = md5(rand(11111, 99999)) . '.' . $extension; // renameing image
                        //path set
                        $img_url = 'upload/campaignPostPhotos/img-'.$fileName;
                        //resize and crop image using Image Intervention
                        //Image::make($file)->crop(558, 221, 0, 0)->save(public_path($img_url));
                        Image::make($file)->resize(558, 221)->save(public_path($img_url));
                        $photo = new PostPhoto();
                        $photo->app_post_id = $campaign->id;
                        $photo->photo =  $img_url;
                        $photo->save();
                    }
                }


                //multiple Attachment
                if( $request->hasFile('file')) {
                    $files = $request->file;
                    foreach ($files as $file) {
                        $destinationPath = public_path() . '/upload/campaignPostAttachment';
                        $extension = $file->getClientOriginalExtension();
                        $fileName = md5(rand(11111, 99999)) . '.' . $extension; // renameing image
                        $file->move($destinationPath, $fileName); // uploading file to given path
                        $file = new PostAttachment();
                        $file->app_post_id = $campaign->id;
                        $file->file = '/upload/campaignPostAttachment/' . $fileName;
                        $file->save();
                    }
                }



                return Response::json(['success' => 'Campaign Post Successfully Posted'], 200);
            }
        }catch (Exception $e){
            return Response::json(['error' => 'Something went wrong'], 403);
        }
    }










}