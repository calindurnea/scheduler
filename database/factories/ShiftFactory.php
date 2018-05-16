<?php

use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Shift::class, function(Faker $faker) {

    $shiftStart = Carbon::now()->toDateTimeString();

	$user = User::inRandomOrder()->pluck('id')->first();

	return [

		'start'    => $shiftStart,
		'duration' => $faker->numberBetween(2,10),
		'user_id'  => $user,
	];
});
