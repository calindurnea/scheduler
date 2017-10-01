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

		DB::table('roles')->insert(

			array(
				'role' => 'admin'
			)
		);

		DB::table('roles')->insert(

			array(
				'role' => 'manager'
			)
		);

		DB::table('roles')->insert(

			array(
				'role' => 'member'
			)
		);

		DB::table('roles')->insert(

			array(
				'role' => 'temp'
			)
		);
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
