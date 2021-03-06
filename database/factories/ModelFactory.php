<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
    ];
});

$factory->define(App\Ssul::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->sentence,
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
    ];
});

$factory->define(App\Channel::class, function (Faker\Generator $faker) {
    $ssulIds = App\Ssul::pluck('id')->toArray();

    return [
        'name' => $faker->sentence,
        'ssul_id' => $faker->randomElement($ssulIds),
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
    ];
});

$factory->define(App\Team::class, function (Faker\Generator $faker) {
    $ssulId = App\Ssul::pluck('id')->toArray();

    return [
        'name' => $faker->city,
        'ssul_id' => $faker->randomElement($ssulId),
        'value' => $faker->randomDigit

    ];
});

$factory->define(App\Chatting::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $channelIds = App\Channel::pluck('id')->toArray();
    $teamId = App\Team::pluck('id')->toArray();

    return [
        'content' => $faker->sentence,
        'ipaddress' => $faker->ipv4,
        'user_id' => $faker->randomElement($userIds),
        'channel_id' => $faker->randomElement($channelIds),
        'team_id' => $faker->randomElement($teamId),
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
    ];
});

$factory->define(App\Like::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $chattingIds = App\Chatting::pluck('id')->toArray();

    return [
        'chatting_id' => $faker->randomElement($chattingIds),
        'user_id' => $faker->randomElement($userIds),
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
    ];
});


$factory->define(App\TeamUser::class, function (Faker\Generator $faker) {
    $teamId = App\Team::pluck('id')->toArray();
    $userId = App\User::pluck('id')->toArray();

    return [
        'team_id' => $faker->randomElement($teamId),
        'user_id' => $faker->randomElement($userId),
    ];
});

$factory->define(App\SsulChatting::class, function (Faker\Generator $faker) {
    $ssulId = App\Ssul::pluck('id')->toArray();
    $chattingId = App\Chatting::pluck('id')->toArray();

    return [
        'ssul_id' => $faker->randomElement($ssulId),
        'chatting_id' => $faker->randomElement($chattingId),
    ];
});

$factory->define(App\Page::class, function (Faker\Generator $faker) {
    $userId = App\User::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userId),
        'title' => $faker->name,
        'description' => $faker->sentence,
        'main_picture' => $faker->imageUrl(),
        'background_picture' => $faker->imageUrl()
    ];
});

$factory->define(App\PageSsul::class, function (Faker\Generator $faker) {
    $ssulId = App\Ssul::pluck('id')->toArray();
    $pageId = App\Page::pluck('id')->toArray();
    return [
        'ssul_id' => $faker->randomElement($ssulId),
        'page_id' => $faker->randomElement($pageId)

    ];
});