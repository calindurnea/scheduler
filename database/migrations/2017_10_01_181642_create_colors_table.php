<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('colors', function(Blueprint $table) {
			$table->increments('id');

			$table->char('hexCode', 7)->unique();

			$table->integer('user_id')->unsigned()->unique()->nullable();
			$table->foreign('user_id')->references('id')->on('users');

			$table->softDeletes();
			$table->timestamps();
		});

		// Populate table with default colors

		$colors = collect([
			'#F44336', '#E91E63', '#9C27B0', '#673AB7', '#3F51B5', '#2196F3',
			'#00BCD4', '#009688', '#4CAF50', '#8BC34A', '#CDDC39', '#FFEB3B',
			'#FFC107', '#FF9800', '#FF5722', '#795548', '#9E9E9E', '#607D8B'
		]);

		foreach($colors as $color) {
			DB::table('colors')->insert(
				[
					'hexCode' => $color
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
		Schema::dropIfExists('colors');
	}
}
