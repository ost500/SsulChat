<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        factory(App\User::class,5)->create();
        factory(App\Ssul::class,5)->create();
        factory(App\Channel::class,20)->create();
        factory(App\Chatting::class,50)->create();
        factory(App\Like::class,30)->create();
    }
}
