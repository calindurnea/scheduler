<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckIdRequest;
use App\Http\Requests\CreateNewUserRequest;
use App\Role;
use App\User;
use function bcrypt;
use function compact;
use function dd;
use function rand;
use function str_random;
use function view;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
		$users = User::withRoles(['member', 'temp', 'manager'])->get();

		return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$colors = collect([
			'#F44336', '#E91E63', '#9C27B0', '#673AB7', '#3F51B5', '#2196F3',
			'#00BCD4', '#009688', '#4CAF50', '#8BC34A', '#CDDC39', '#FFEB3B',
			'#FFC107', '#FF9800', '#FF5722', '#795548', '#9E9E9E', '#607D8B'
		]);

		$roles = Role::where('role', '!=', 'admin')->get()->reverse();

		return view('users.create', compact(['colors', 'roles']));
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
			'color'      => $request->color,
			'email'      => $request->email ? $request->email : $request->first_name . rand(999, 99999) . '@undefined.' . str_random(3),
			'password'   => bcrypt($request->first_name),
		]);

		$user->roles()->attach($request->role);

		$user->save();

		alert('Member successfully added! <br> <a href="/users"><button class="btn">Return home</button></a> <a href="#" onclick="swal.closeModal(); return false;"><button class="btn">Add more</button></a>')->html()->autoclose(5000);

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
	public function edit() {
		dd(1);
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
	public function destroy($id) {
		//
	}
}
