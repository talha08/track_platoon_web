<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppSocialLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_social_login', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('social_login_id');

            $table->integer('app_user_id')->unsigned();
            $table->foreign('app_user_id')
                ->references('id')
                ->on('app_user')
                ->onUpdate('cascade')
                ->onDelete('cascade');


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
        Schema::drop('app_social_login');
    }
}
