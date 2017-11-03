<?php

namespace App\Http\Controllers;

use App\Color;
use App\Http\Requests\CheckIdRequest;
use App\Http\Requests\CreateNewUserRequest;
use App\Role;
use App\Shift;
use App\User;
use function compact;
use function preg_replace;
use function view;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('users.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$roles = Role::where('role', '!=', 'admin')->get()->reverse();

		return view('users.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateNewUserRequest $request) {
		$user = User::create([
			'first_name' => $request->first_name,
			'last_name'  => $request->last_name,
			'phone'      => $request->phone,
			'email'      => $request->email ? $request->email : preg_replace('/\s+/', '', $request->first_name) . rand(999, 99999) . '@undefined.' . str_random(3),
			'password'   => bcrypt($request->first_name),
		]);

		$user->roles()->attach($request->role);

		$color = Color::find($request->color);
		$user->color()->save($color);

		$user->save();

		alert('<br>Employee successfully added! <br><br><br> <a href="/users"><button class="btn btm-default">Return home</button></a> <a href="#" onclick="swal.closeModal(); return false;"><button class="btn btn-primary">Add more</button></a><br><br>')->autoclose(5000);

		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(CheckIdRequest $request) {
		$user = User::findOrFail($request->id);

		return view('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(CheckIdRequest $request) {
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update() {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(CheckIdRequest $request) {
		Shift::where('user_id', '=', $request->id)->delete();
		Color::where('user_id', '=', $request->id)->update(['user_id' => null]);

		if(User::find($request->id)->delete()) {
			return response()->json([], 204);
		}

		return response()->json(['error' => 'an error has occurred'], 404);
	}
}
