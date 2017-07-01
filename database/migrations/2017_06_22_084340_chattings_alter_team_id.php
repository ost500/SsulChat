<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChattingsAlterTeamId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chattings', function (Blueprint $table) {

            $table->dropColumn('team_id');

        });
        Schema::table('chattings', function (Blueprint $table) {
            $table->integer('team_id')->unsigned()->index()->nullable()->after('user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chattings', function (Blueprint $table) {

            $table->dropColumn('team_id');

        });
        Schema::table('chattings', function (Blueprint $table) {
            $table->integer('team_id')->unsigned()->index();

        });
    }
}
