<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    //text
    public function searchPostOrUser(Request $request){

        $text = $request->search_text;

        $ips_list = \DB::table('app_post')->where('title', '=', '1')->limit(5);

        $recipes = DB::table("app_post")->select("id", "title")
            ->where("user_id", "=", $id);

        $items = DB::table("posts")->select("id", "title")
            ->where("user_id", "=", $id)
            ->union($recipes)
            ->paginate(5)->get();



    }


}
