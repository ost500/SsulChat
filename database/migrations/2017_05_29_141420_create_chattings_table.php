<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChattingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chattings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->integer('user_id')->unsigned()->index();

            $table->integer('channel_id')->unsigned()->index();

            $table->integer('team_id')->unsigned()->index();

            $table->string('ipaddress');
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
        Schema::dropIfExists('chattings');
    }
}
