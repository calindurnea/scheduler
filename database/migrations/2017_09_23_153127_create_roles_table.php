<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('roles', function(Blueprint $table) {
			$table->increments('id');

			$table->enum('role', ['admin', 'manager', 'member', 'temp']);
		});

		$roles = collect(['admin', 'manager', 'member', 'temp']);

		foreach($roles as $role) {
			DB::table('roles')->insert(

				[
					'role' => $role
				]
			);
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('roles');
	}
}
