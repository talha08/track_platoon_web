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
            $table->integer('app_city_id')->unsigned();

            $table->string('title');
            $table->string('description');
            $table->integer('is_active');
            $table->integer('is_emergency');
            $table->string('help_info');


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
