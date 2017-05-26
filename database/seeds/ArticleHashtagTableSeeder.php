<?php

use Illuminate\Database\Seeder;

class ArticleHashtagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ArticleHashtag::class,5)->create();
    }
}
