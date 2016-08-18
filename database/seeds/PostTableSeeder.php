<?php

use Illuminate\Database\Seeder;
use App\ApiModel\PostType;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostType::create(['name' => 'Topic']);
        PostType::create(['name' => 'Report']);
        PostType::create(['name' => 'Help']);
        PostType::create(['name' => 'Campaign']);
    }
}
