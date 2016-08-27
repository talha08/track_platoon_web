<?php

use Illuminate\Database\Seeder;
use App\ApiModel\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'posted_by' => 1,
            'app_subType_id' => 12,
            'app_city_id' => 1,
            'location' => 'Mirpur ds',
            'title' => 'Topic Test',
            'description' => 'srtwerseyydty',
            'is_emergency' => 1,
            'help_info' => 'xfthshtjfdj',
            'post_type' => 4,
            'survey_among' => 10000,
            'country' => 'Bangladesh'

        ]);


        Post::create([
            'posted_by' => 1,
            'app_subType_id' => 1,
            'app_city_id' => 1,
            'location' => 'Mirpur es',
            'title' => 'Topic Test',
            'description' => 'srtwerseyydty',
            'is_emergency' => 1,
            'help_info' => '1fthdtj',
            'post_type' => 1,
            'country' => 'Bangladesh'

        ]);


        Post::create([
            'posted_by' => 1,
            'app_subType_id' => 1,
            'app_city_id' => 1,
            'location' => 'Mirpur cs',
            'title' => 'Topic Test',
            'description' => 'srtwerseyydty',
            'is_emergency' => 1,
            'help_info' => 'cfgethdtrhd',
            'post_type' => 1,
            'country' => 'Bangladesh'

        ]);

    }
}
