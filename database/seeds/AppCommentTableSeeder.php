<?php

use Illuminate\Database\Seeder;
use App\ApiModel\Comment;

class AppCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            'post_id' => 1,
            'app_user_id' => 1,
            'app_comment_type_id' => 1,
            'description' => 'jhefakefa kjsefalf kjSZEfgla sjzkeGFaef JSEFgl',
        ]);
    }
}
