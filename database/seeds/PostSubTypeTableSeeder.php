<?php

use Illuminate\Database\Seeder;
use App\ApiModel\PostSubType;

class PostSubTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostSubType::create([ 'post_type_id' => 1,'name' => 'X']);
        PostSubType::create([ 'post_type_id' => 1,'name' => 'Y']);
        PostSubType::create([ 'post_type_id' => 1,'name' => 'Z']);

        PostSubType::create([ 'post_type_id' => 2,'name' => 'X']);
        PostSubType::create([ 'post_type_id' => 2,'name' => 'Y']);
        PostSubType::create([ 'post_type_id' => 2,'name' => 'Z']);

        PostSubType::create([ 'post_type_id' => 3,'name' => 'X']);
        PostSubType::create([ 'post_type_id' => 3,'name' => 'Y']);
        PostSubType::create([ 'post_type_id' => 3,'name' => 'Z']);

        PostSubType::create([ 'post_type_id' => 4,'name' => 'X']);
        PostSubType::create([ 'post_type_id' => 4,'name' => 'Y']);
        PostSubType::create([ 'post_type_id' => 4,'name' => 'Z']);
    }
}
