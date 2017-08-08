<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMorphLogsChattingId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('morph_logs', function (Blueprint $table) {

            $table->integer('chatting_id')->unsigned()->index();
            $table->foreign('chatting_id')
                ->references('id')->on('chattings')
                ->onDelete('cascade');

            $table->unique(['chatting_id','morph_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('morph_logs', function (Blueprint $table) {
            $table->dropForeign(['chatting_id']);
            $table->dropColumn('chatting_id');
        });
    }
}
