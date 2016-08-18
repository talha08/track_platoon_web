<?php

use Illuminate\Database\Seeder;
use App\ApiModel\City;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([ 'country_id' => 1,'name' => 'Dhaka']);
        City::create([ 'country_id' => 1,'name' => 'Sylhet']);
        City::create([ 'country_id' => 1,'name' => 'Comilla']);
        City::create([ 'country_id' => 1,'name' => 'Barishal']);
        City::create([ 'country_id' => 1,'name' => 'Chittagong']);
        City::create([ 'country_id' => 1,'name' => 'Feni']);
        City::create([ 'country_id' => 1,'name' => 'Khulna']);
        City::create([ 'country_id' => 1,'name' => 'Rajshahi']);
        City::create([ 'country_id' => 1,'name' => 'Rangpur']);
        City::create([ 'country_id' => 1,'name' => 'Kurigram']);
        City::create([ 'country_id' => 1,'name' => 'Tongi']);
        City::create([ 'country_id' => 1,'name' => 'Bogra']);

        City::create([ 'country_id' => 2,'name' => 'Mumbai']);
        City::create([ 'country_id' => 2,'name' => 'Kolkata']);


    }
}
