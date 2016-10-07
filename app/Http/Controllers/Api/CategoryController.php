<?php

namespace App\Http\Controllers\APi;

use App\ApiModel\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ApiModel\Post;
use Response;

class CategoryController extends Controller
{

    public $limit = 10 ;


    /**
     * Post Associate with Sub Category
     * Get method
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @param: category_id
     * @url: categoryPost
     * @return: json SubCatPost
     */
    public function categoryPost(Request $request)
    {

        $category_id = $request->category_id;
        $posts = Post::with('user','postSolve','postFiles','postPhotos','postSubType')
                    ->where('app_subType_id',$category_id)
                    ->orderBy('id', 'desc')
                    ->paginate($this->limit);


            foreach($posts as $post){
                $process = $this->progressLoop($post->id);
                $post['progress'] = $process;
            }

            return Response::json(array('SubCatPost'  => $posts->toArray()),200);

        }





    public function progressLoop($post_id){

        $post = Post::where('id',$post_id)->first();

        if ($post->post_type == 2 ) {
            $comment = Comment::with('subComments')->where('post_id', $post_id)->get();
            //for progress calculation
            $commentCount = count($comment);
            $survey_among = $post->survey_among;

            return $calculate = ($commentCount / $survey_among) * 100;
        }elseif($post->post_type == 4){

            $comment = Comment::with('subComments')->where('post_id', $post_id)->get();
            //for progress calculation
            $commentCount = count($comment) + $post->participate;
            $survey_among = $post->survey_among;

            return $calculate = ($commentCount / $survey_among) * 100;
        }

        else{
            return $calculate = null;
        }

    }










}
