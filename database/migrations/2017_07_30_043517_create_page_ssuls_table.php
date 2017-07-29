<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSsulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_ssuls', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('page_id')->unsigned();
            $table->foreign('page_id')
                ->references('id')->on('pages')
                ->onDelete('cascade');

            $table->integer('ssul_id')->unsigned();
            $table->foreign('ssul_id')
                ->references('id')->on('ssuls')
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
        Schema::dropIfExists('page_ssuls');
    }
}
