<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_comment', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('post_id')->unsigned();
            $table->integer('app_user_id')->unsigned();
            $table->integer('app_comment_type_id')->unsigned();


            $table->string('description');


            $table->foreign('post_id')->references('id')
                ->on('app_post')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('app_user_id')->references('id')
                ->on('app_user')
                ->onUpdate('cascade')->onDelete('cascade');


            $table->foreign('app_comment_type_id')->references('id')
                ->on('app_comment_type')
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
        Schema::drop('app_comment');
    }
}
