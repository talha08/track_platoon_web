<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppPostSubTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_post_subType', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->integer('post_type_id')->unsigned();
            $table->foreign('post_type_id')->references('id')
                ->on('app_post_type')
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
        Schema::drop('app_post_subType');
    }
}
