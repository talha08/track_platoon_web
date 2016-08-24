<?php

use Illuminate\Database\Seeder;
use App\ApiModel\AppUser;

class AppUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppUser::create([
            'name' => 'Anonymous',
            'profile_pic' => '/upload/default/icon.jpg',
            'is_active' => 1,
            'user_type' => 0,
            'account_type_id' => 1,
        ]);

        AppUser::create([
            'name' => 'Tanvy',
            'profile_pic' => '/upload/default/icon.jpg',
            'is_active' => 1,
            'user_type' => 0,
            'account_type_id' => 1,
        ]);

    }
}
