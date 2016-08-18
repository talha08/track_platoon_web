<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppPostAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_post_attachment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->integer('is_active')->default(1); //0 and 1

            $table->integer('app_post_id')->unsigned();
            $table->foreign('app_post_id')->references('id')
                ->on('app_post')
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
        Schema::drop('app_post_attachment');
    }
}
