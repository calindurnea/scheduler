<?php

use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Shift::class, function(Faker $faker) {
	$shiftStart = Carbon::today()->addHours(rand(0, 12));

	$user = User::inRandomOrder()->pluck('id')->first();

	return [
		'start'   => $shiftStart->toDateTimeString(),
		'end'     => $shiftStart->addHours(rand(2, 12))->toDateTimeString(),
		'user_id' => $user,
	];
});
