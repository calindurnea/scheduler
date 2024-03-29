<?php

namespace App\Http\Controllers;

use App\Color;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController {

	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/**
	 * @var type
	 */
	protected $user;

	public function __construct() {
		$this->middleware('auth');

		$this->middleware(function($request, $next) {
			$this->user = request()->user();

			return $next($request);
		});

		$users = User::withRoles(['member', 'temp', 'manager'])->get();
		$availableColors = Color::where('user_id', NULL)->get();

		View::share('users', $users);
		View::share('availableColors', $availableColors);
	}
}
