<?php

use App\Film;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'isAdmin' => false
    ];
});

$factory->define(App\Genre::class, function (Faker $faker) {
    return [
            'name' => $faker->word,
    ];
});
$factory->define(App\Film::class, function (Faker $faker) {
    $title = $faker->sentence($nbWords = 3, $variableNbWords = true);
    return [
            'name' => $title,
            'slug' => str_slug($title),
            'description' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
            'release_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'country' => 'USA',
            'price' => 37.45,
            'photo' => 'https://picsum.photos/100/100'
    ];
});
$factory->define(App\Rating::class, function (Faker $faker) {
    $film = Film::where('id',$faker->numberBetween(1,3))->get()[0]->toArray()['slug'];
    return [
            'user_id' => $faker->numberBetween(1,10),
            'film_slug' => $film,
            'rating' => $faker->numberBetween(1,5)
    ];
});
$factory->define(App\Comment::class, function (Faker $faker) {
    return [
            'user_id' => function(){
                return factory(App\User::class)->create()->id;
            },
            'film_slug' => function(){
                return factory(App\Film::class)->create()->slug;
            },
            'body' => $faker->paragraph
    ];
});