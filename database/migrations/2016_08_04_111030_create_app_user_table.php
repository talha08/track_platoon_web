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
            $table->string('profile_pic')->default('http://platoon.sustcse12.cf/upload/default/icon.jpg');
            $table->string('confirm_code');
            $table->string('is_active')->default(0);   // 0 inactive , 1 for active
            $table->string('user_type')->default(0);   //  0 for person, 1 for organization


           // $table->string('first_name')->nullable();
           // $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('mobile')->nullable();
            $table->string('occupation')->nullable();
            $table->string('work_place')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('religion')->nullable();


            $table->string('hide_email')->default(0); //1 hide, 0 show for all
            $table->string('hide_mobile')->default(0);
            $table->string('hide_occupation')->default(0);
            $table->string('hide_religion')->default(0);
            $table->string('hide_country')->default(0);
            $table->string('hide_work_place')->default(0);




            $table->string('is_banned')->default(0); // 1 for ban request, 2 for banned

            $table->string('can_followed')->default(1); // 1 can follow, 2 for cant, need to send request
            $table->string('can_view')->default(1); // 1 can view, 2 for cant



            $table->integer('account_type_id')->unsigned();  // 1 email login others social login
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
