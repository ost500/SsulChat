<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNaverNewsSsulId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('naver_news', function (Blueprint $table) {
            $table->integer('ssul_id')->unsigned()->nullable()->after('id');

            $table->foreign('ssul_id')
                ->references('id')->on('ssuls')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('naver_news', function (Blueprint $table) {
            $table->dropForeign(['ssul_id']);
            $table->dropColumn('ssul_id');
        });
    }
}
