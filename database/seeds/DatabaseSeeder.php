<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EntrustTableSeeder::class);

        $this->call(AccounttypeSeeder::class);
        $this->call(AppUserTableSeeder::class);
        $this->call(AppEmailUserTableSeeder::class);


        $this->call(CountryTableSeeder::class);
        $this->call(CityTableSeeder::class);


        $this->call(PostTypeTableSeeder::class);
        $this->call(PostSubTypeTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(AppPostSolvedTableSeeder::class);


        $this->call(AppCommentTypeTableSeeder::class);
        $this->call(AppCommentTableSeeder::class);
        $this->call(AppSubCommentTableSeeder::class);


        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        Model::reguard();
    }
}
