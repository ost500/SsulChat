<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSsulChattingsIdx extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ssul_chattings', function (Blueprint $table) {
            $table->index(['ssul_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ssul_chattings', function (Blueprint $table) {
            $table->dropIndex(['ssul_id', 'created_at']);
        });
    }
}
