<?php

use Illuminate\Database\Seeder;
use App\ApiModel\SubComment;

class AppSubCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubComment::create([
            'app_comment_id' => 1,
           // 'post_id' => 1,
            'app_user_id' => 1,
            'app_comment_type_id' => 1,
            'description' => 'jhefakefa kjsefalf kjSZEfgla sjzkeGFaef JSEFgl',
        ]);
    }
}
