<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppPostSolvedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_post_solved', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('post_id')->unsigned();


            $table->string('title');
            $table->string('description');
            $table->string('help_info')->nullable();

            $table->foreign('post_id')->references('id')
                ->on('app_post')
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
        Schema::drop('app_post_solved');
    }
}
