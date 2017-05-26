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

/*@var \Illuminate\Database\Eloquent\Factory $factory*/


$factory->define(App\User::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {

    $userIds = App\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userIds),
        'content' => $faker->paragraph,
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
    ];
});
$factory->define(App\Hashtag::class, function (Faker\Generator $faker) {
        return [
            'hashtag' => $faker->sentences,
            'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
            'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
        ];
    });
$factory->define(App\ArticleHashtag::class, function (Faker\Generator $faker) {

    $hashtagIds = App\Hashtag::pluck('id')->toArray();
    $articleIds = App\Article::pluck('id')->toArray();
    return [
        'article_id' => $faker->randomElement($articleIds),
        'hashtag_id' => $faker->randomElement($hashtagIds),
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
    ];
});
