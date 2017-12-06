<?php

namespace App\Http\Controllers;

use App\Rules\IsSameDayRule;
use App\Shift;
use App\User;
use Illuminate\Http\Request;
use function compact;

class ShiftController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$shifts = Shift::all();

		return view('shift.index', compact('shifts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$user = User::where('email', '=', $request->email)->first();

		$this->validate($request, [
			'email' => 'required|email|max:255|exists:users,email',
			'start' => ['required', 'date', new IsSameDayRule($user)],
			'end'   => ['required', 'date', new IsSameDayRule($user)],
		]);

		$shift = new Shift;
		$shift->start = $request->start;
		$shift->duration = $request->end;
		$user->shifts()->save($shift);

		return redirect()->route('shifts.index')
			->with('success', 'Shift added successfully!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		Shift::where('id', '=', $id)->delete();

		return redirect()->route('shifts.index')
			->with('success', 'Shift deleted successfully');
	}
}
