<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// $this->call(UsersTableSeeder::class);

		DB::statement("SET foreign_key_checks = 0");

//		DB::table('users')->truncate();
//		DB::table('shifts')->truncate();
//		DB::table('role_user')->truncate();
//
//		factory(App\User::class, 5)->create();
//		factory(App\Shift::class, 20)->create();
//
//		App\User::all()->each(function($user) {
//			$user->roles()->attach(3);
//		});
	}
}
