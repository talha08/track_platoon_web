<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppFollowUserTable extends Migration
{
    public function up()
    {
        Schema::create('app_follow_users', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('app_user')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('following')->unsigned();
            $table->foreign('following')->references('id')->on('app_user')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['following', 'user_id']);
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
        Schema::drop('app_follow_users');
    }
}
