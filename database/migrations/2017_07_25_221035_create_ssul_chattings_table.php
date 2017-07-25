<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSsulChattingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ssul_chattings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('ssul_id')->unsigned();

            $table->foreign('ssul_id')
                ->references('id')->on('ssuls')
                ->onDelete('cascade');

            $table->integer('chatting_id')->unsigned();

            $table->foreign('chatting_id')
                ->references('id')->on('chattings')
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
        Schema::dropIfExists('ssul_chattings');
    }
}
