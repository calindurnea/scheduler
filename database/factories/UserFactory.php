<?php

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

$factory->define(App\User::class, function(Faker $faker) {
	static $password;

	return [
		'first_name'     => $faker->firstName,
		'last_name'      => $faker->lastName,
		'phone'          => $faker->numberBetween(00000000, 99999999),
		'email'          => $faker->unique()->safeEmail,
		'password'       => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
	];
});
