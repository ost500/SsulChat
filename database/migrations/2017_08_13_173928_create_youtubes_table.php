<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYoutubesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtubes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('video_id')->unique();
            $table->string('title');

            $table->timestamps();
        });

        $newYoutubeUser = new User();
        $newYoutubeUser->email = "Youtube@youtube.com";
        $newYoutubeUser->name = "Youtube";
        $newYoutubeUser->password = bcrypt('secret');
        $newYoutubeUser->profile_img = "/images/Youtube.png";
        $newYoutubeUser->annony = 0;
        $newYoutubeUser->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('youtubes');
        /** @var User $youtubeUser */
        $youtubeUser = User::where('email','Youtube@youtube.com');
        if($youtubeUser->exists()){
            $youtubeUser = $youtubeUser->first();
            $youtubeUser->delete();
        }
    }
}
