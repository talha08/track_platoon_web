<?php

namespace App\Http\Controllers\Api;

use App\ApiModel\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
        public function commentStore(Request $request){

            $comment = new Comment();
            
        }
}
