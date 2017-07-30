<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_img')->nullable();
            $table->boolean('annony')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        for($i=0; $i<=100; ++$i){
            App\User::create([
                'name' => '익명'.$i,
                'email' => "anonymous{$i}@osteng.com",
                'annony' => true,
                'profile_img' => '/images/user-img.png',
                'password' => bcrypt('!@#$%^&*()')
            ]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

}
