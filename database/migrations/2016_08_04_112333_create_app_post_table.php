<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_post', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('posted_by')->unsigned();
            $table->integer('app_subType_id')->unsigned();
            $table->string('country');
            $table->integer('app_city_id')->unsigned();   //city and country
            $table->string('location');   // specific location

            $table->string('title');

            $table->text('description');
            $table->integer('is_active')->default(1); // 1 or 0
            $table->integer('is_emergency'); //1 or 0
            $table->string('help_info')->nullable();
            $table->string('survey_among')->nullable();

            //for share
            // we save share post as a new post
            $table->boolean('is_share')->default(false);
            $table->integer('share_post_id')->nullable();


            //anonymous tracking
            $table->integer('anonymous_user')->nullable();


            $table->string('post_type');  //direct use of post type
            $table->string('participate')->nullable();

            $table->foreign('posted_by')->references('id')
                ->on('app_user')
                ->onUpdate('cascade')->onDelete('cascade');


            $table->foreign('app_subType_id')->references('id')
                ->on('app_post_subType')
                ->onUpdate('cascade')->onDelete('cascade');


            $table->foreign('app_city_id')->references('id')
                ->on('app_city')
                ->onUpdate('cascade')->onDelete('cascade');



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
        Schema::drop('app_post');
    }
}
