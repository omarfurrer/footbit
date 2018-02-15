<?php

use Faker\Generator as Faker;
use App\Entities\TournamentTypes;
use App\Entities\TournamentStatuses;

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

//USER
$factory->define(App\Models\User::class,
                 function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'phone_number' => $faker->unique()->phoneNumber,
        'date_of_birth' => $faker->dateTimeThisCentury,
        'is_admin' => 0,
    ];
});

//PLAYER
$factory->define(App\Models\Player::class, function (Faker $faker) {
    return [
    ];
});

//REFEREE
$factory->define(App\Models\Referee::class, function (Faker $faker) {
    return [
    ];
});

//TEAM
$factory->define(App\Models\Team::class,
                 function (Faker $faker) {
    return [
        'name' => $faker->city,
        'moto' => $faker->text(50),
    ];
});

//VENUE
$factory->define(App\Models\Venue::class,
                 function (Faker $faker) {
    $randomVenue = $faker->unique()->numberBetween(1, 6);
    return [
        'name' => $faker->streetName,
        'location' => $faker->address,
        'gmaps_url' => $faker->url,
        'image_name' => "{$randomVenue}.jpg",
        'image_path' => "img/venues/{$randomVenue}.jpg"
    ];
});

//TOURNAMENT
$factory->define(App\Models\Tournament::class,
                 function (Faker $faker) {
    $randomVenue = $faker->numberBetween(1, 5);
    return [
        'name' => $faker->company,
        'type' => TournamentTypes::KNOCKOUTS,
//        'status' => '',
//        'round' => '',
        'number_of_teams' => $faker->randomElement([4, 8, 16, 32]),
        'players_per_team' => $faker->randomElement([5, 6, 7, 8, 9, 10, 11, 12]),
        'fees_per_team' => $faker->randomElement([1000, 2000, 3000, 4000]),
        'min_age' => $faker->randomElement([NULL, 15, 16]),
        'max_age' => $faker->randomElement([NULL, 21, 25]),
        'first_prize' => $faker->randomElement([15000, 14000, 13000]),
        'second_prize' => $faker->randomElement([12000, 11000, 10000]),
        'third_prize' => $faker->randomElement([9000, 8000, 7000]),
        'default_match_time' => $faker->randomElement([10, 12, 15, 20, 30]),
        'default_venue_id' => $randomVenue
    ];
});
