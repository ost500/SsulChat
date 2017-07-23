<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialApplied extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instagrams', function (Blueprint $table) {
            $table->boolean('applied')->default(true);
        });

        Schema::table('naver_news', function (Blueprint $table) {
            $table->boolean('applied')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instagrams', function (Blueprint $table) {
            Schema::table('instagrams', function (Blueprint $table) {
                $table->dropColumn('applied');
            });
            Schema::table('naver_news', function (Blueprint $table) {
                $table->dropColumn('applied');
            });
        });
    }
}
