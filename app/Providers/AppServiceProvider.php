<?php

namespace App\Providers;

use function auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		Blade::if('managerOrAdmin', function() {
			return auth()->check() && (auth()->user()->is('admin') || auth()->user()->is('manager'));
		});

		Schema::defaultStringLength(191);
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
