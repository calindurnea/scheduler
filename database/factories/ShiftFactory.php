<?php

use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Shift::class, function(Faker $faker) {
	$shiftStart = Carbon::today()->addHours(rand(0, 12));

	$user = User::inRandomOrder()->pluck('id')->first();

	return [
		'start'    => Carbon::today()->toDateTimeString(),
		'duration' => 2,
		'user_id'  => $user,
	];
});
