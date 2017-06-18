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
        $ssuls = App\Ssul::get();

        $ssuls->each(function ($ssul) {
            $ssul->teams()->save(factory(App\Team::class)->make());
            $ssul->teams()->save(factory(App\Team::class)->make());
        });

    }
}
