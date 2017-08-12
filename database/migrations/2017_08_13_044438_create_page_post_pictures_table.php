<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagePostPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_post_pictures', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('page_post_id')->unsigned()->index();
            $table->foreign('page_post_id')
                ->references('id')->on('page_posts')
                ->onDelete('cascade');

            $table->string('photo');
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
        Schema::dropIfExists('page_post_pictures');
    }
}
