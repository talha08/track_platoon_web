<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_city', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')
                ->on('app_country')
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
        Schema::drop('app_city');
    }
}
