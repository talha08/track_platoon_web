<?php

use Illuminate\Database\Seeder;
use App\ApiModel\EmailLogin;

class AppEmailUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmailLogin::create([
            'app_user_id' => 1,
            'email' => 'anonymous@platoon.com',
            'password' => Hash::make('a'),
            'visible_pass' => Crypt::encrypt('a')

        ]);

        EmailLogin::create([
            'app_user_id' => 2,
            'email' => 'tanvy@gmail.com',
            'password' => Hash::make('a'),
            'visible_pass' => Crypt::encrypt('a')

        ]);
    }
}
