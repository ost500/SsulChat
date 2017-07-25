<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccountsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $names = ["NaverNews", "Instagram", "Twitter", 'Facebook'];

        foreach($names as $socialName){
            $socialUser = new User();
            $socialUser->name = $socialName;

            $lowSocialName = strtolower($socialName);

            $socialUser->email = "{$socialName}@{$lowSocialName}.com";
            $socialUser->password = bcrypt("social");
            $socialUser->annony = false;
            $socialUser->profile_img = "/images/{$socialName}.png";
            $socialUser->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
