<?php

namespace App\Http\Controllers;

use App\Color;
use App\Role;
use App\Shift;
use App\User;
use Illuminate\Http\Request;
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
	public function store(Request $request) {
		request()->validate([
			'first_name' => 'required|string|max:255',
			'last_name'  => 'sometimes|nullable|string|max:255',
			'email'      => 'sometimes|nullable|string|email|max:255|unique:users',
			'phone'      => 'sometimes|nullable|numeric|digits:8|unique:users',
			'color'      => 'required|integer',
			'role'       => 'required|numeric|min:2'
		]);

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

		return redirect()->route('users.create')
			->with('success', 'Employee added successfully!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user) {
		return view('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user) {
		return view('users.edit', compact('user'));
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
		Shift::where('user_id', '=', $id)->delete();
		Color::where('user_id', '=', $id)->update(['user_id' => null]);
		User::find($id)->delete();

		return redirect()->route('users.index')
			->with('success', 'Employee deleted successfully');
	}
}
