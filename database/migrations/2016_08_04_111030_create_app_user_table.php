<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
           // $table->string('type');
            $table->string('profile_pic')->default('/upload/default/icon.jpg');
            $table->string('confirm_code');
            $table->string('is_active')->default(0);   // 0 inactive , 1 for active
            $table->string('user_type')->default(0);   //  0 for person, 1 for organization

            $table->string('is_banned')->default(0); // 1 for ban request, 2 for banned



            $table->integer('account_type_id')->unsigned();
            $table->foreign('account_type_id')->references('id')
                ->on('app_user_account_type')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->rememberToken();
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
        Schema::drop('app_user');
    }
}
