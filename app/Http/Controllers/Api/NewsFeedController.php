<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\Post;
use App\ApiModel\PostSubType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsFeedController extends Controller
{

    public function test(){
        $user = 1;
      return PostSubType::where('id',1)->pluck('post_type_id');
    }

    /**
     * NewsFeed
     *
     * @param Request $request
     * @url :
     * @param: user_id, filter[all,topic,campaign,help,report]
     *
     */
    public function newsFeed(Request $request)
    {
        $filter = $request->filter;

        if($filter == 'topic'){
            $feed = 1;
        }
        elseif($filter == 'campaign'){
            $feed = 2;
        }
        elseif($filter == 'help'){
            $feed = 3;
        }
        elseif($filter == 'report'){
            $feed = 4;
        }
        else{
            $feed = 5;
        }


    }


}
