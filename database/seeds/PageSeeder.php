<?php

use App\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Page::class,5)->create();

        $pages = Page::get();

        $pages->each(function (App\Page $page) {
            $page->ssuls()->save(factory(App\PageSsul::class)->make());
            $page->ssuls()->save(factory(App\PageSsul::class)->make());
        });
    }
}
