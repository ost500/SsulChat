<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = App\Channel::get();

        $channels->each(function ($channel) {
            $channel->teams()->save(factory(App\Team::class)->make());
            $channel->teams()->save(factory(App\Team::class)->make());
        });

    }
}
