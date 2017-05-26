<?php

use Illuminate\Database\Seeder;

class HashtagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Hashtag::class,5)->create();
    }
}
