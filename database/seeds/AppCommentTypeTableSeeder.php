<?php

use Illuminate\Database\Seeder;
use App\ApiModel\CommentType;

class AppCommentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommentType::create(['name' => 'support']);
        CommentType::create(['name' => 'unsupport']);
    }
}
