<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_interest', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();

            $table->integer('app_subType_id')->unsigned();

            $table->string('post_type');  //direct use of post type

            $table->foreign('user_id')->references('id')
                ->on('app_user')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('app_subType_id')->references('id')
                ->on('app_post_subType')
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
        Schema::drop('app_interest');
    }
}
