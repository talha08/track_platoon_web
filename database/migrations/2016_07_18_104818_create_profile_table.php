<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();

            $table->string('name');
            $table->string('mobile_number');
            $table->string('sex');
            $table->string('profile_image_uri');
            $table->string('geo_location');
            $table->string('cover_image_uri');
            $table->string('address');
            $table->string('street_line_1');
            $table->string('street_line_2');
            $table->string('city');
            $table->string('zip_code');
            $table->string('region');
            $table->string('country');
            $table->string('birth_date');
            $table->string('religion');
            $table->string('high_school');
            $table->string('college');
            $table->string('university');
            $table->string('profession');
            $table->string('blood');


            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profile');
    }
}
