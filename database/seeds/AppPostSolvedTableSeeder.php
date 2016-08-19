<?php

use Illuminate\Database\Seeder;
use App\ApiModel\PostSolved;

class AppPostSolvedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostSolved::create([
            'post_id' => 1,
            'title' => 'Topic Test',
            'description' => 'srtwerseyydty',
            'help_info' => 'xfthshtjfdj'

        ]);

    }
}
