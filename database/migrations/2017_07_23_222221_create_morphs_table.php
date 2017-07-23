<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMorphsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morphs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('ssul_id')->unsigned();

            $table->foreign('ssul_id')
                ->references('id')->on('ssuls')
                ->onDelete('cascade');

            $table->string('morph')->unique();

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
        Schema::dropIfExists('morphs');
    }
}
