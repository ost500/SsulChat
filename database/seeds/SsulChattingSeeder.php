<?php

use Illuminate\Database\Seeder;

class SsulChattingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ssuls = App\Ssul::get();

        $ssuls->each(function (App\Ssul $ssul) {
            $ssul->chattings()->save(factory(App\SsulChatting::class)->make());
            $ssul->chattings()->save(factory(App\SsulChatting::class)->make());
        });
    }
}
