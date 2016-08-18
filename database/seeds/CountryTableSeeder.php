<?php

use Illuminate\Database\Seeder;
use App\ApiModel\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create(['name' => 'Bangladesh']);
        Country::create(['name' => 'India']);
        Country::create(['name' => 'Pakistan']);
        Country::create(['name' => 'Nepal']);
        Country::create(['name' => 'Bhutan']);
        Country::create(['name' => 'Senegal']);
        Country::create(['name' => 'Zimbabwe']);
        Country::create(['name' => 'Australia']);

    }
}
