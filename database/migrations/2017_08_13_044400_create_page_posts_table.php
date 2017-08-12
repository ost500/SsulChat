<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_posts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('fb_unique_id')->index();
            $table->integer('page_id')->unsigned()->index();
            $table->foreign('page_id')
                ->references('id')->on('pages')
                ->onDelete('cascade');

            $table->text('message');
            $table->string('main_photo');

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
        Schema::dropIfExists('page_posts');
    }
}
