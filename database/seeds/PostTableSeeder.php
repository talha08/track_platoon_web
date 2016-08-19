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
            'app_subType_id' => 1,
            'app_city_id' => 1,
            'location' => 'Mirpur ds',
            'title' => 'Topic Test',
            'description' => 'srtwerseyydty',
            'is_emergency' => 1,
            'help_info' => 'xfthshtjfdj'

        ]);


        Post::create([
            'posted_by' => 1,
            'app_subType_id' => 1,
            'app_city_id' => 1,
            'location' => 'Mirpur es',
            'title' => 'Topic Test',
            'description' => 'srtwerseyydty',
            'is_emergency' => 1,
            'help_info' => '1fthdtj'

        ]);


        Post::create([
            'posted_by' => 1,
            'app_subType_id' => 1,
            'app_city_id' => 1,
            'location' => 'Mirpur cs',
            'title' => 'Topic Test',
            'description' => 'srtwerseyydty',
            'is_emergency' => 1,
            'help_info' => 'cfgethdtrhd'

        ]);

    }
}
