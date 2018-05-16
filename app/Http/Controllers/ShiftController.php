<?php

namespace App\Http\Controllers;

use App\Mail\MonthlyShifts;
use App\Rules\IsSameDayRule;
use App\Shift;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function compact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Nexmo\Laravel\Facade\Nexmo;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Shift::all();

        return view('shift.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();

        $this->validate($request, [
            'email' => 'required|email|max:255|exists:users,email',
            'start' => ['required', 'date', new IsSameDayRule($user)],
            'end' => ['required', 'date', new IsSameDayRule($user)],
        ]);

        $shift = new Shift;
        $shift->start = $request->start;
        $shift->duration = $request->end;
        $user->shifts()->save($shift);

//            $this->sendSMS($user->phone, 'New shift was added to your schedule!', $request->start, $request->end);

        Session::flash('flash_message', 'Shift created!');
        Session::flash('flash_type', 'success');

        return response()->json(['success' => 'Shift created!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shift = Shift::findOrFail($id);

        $shift->delete();

        request()->validate([
            'email' => 'required|email|max:255|exists:users,email',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        $user = User::where('email', '=', $request->email)->first();

        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $shift = new Shift;
        $shift->start = $start;
        $shift->duration = $end;
        $user->shifts()->save($shift);

        Session::flash('flash_message', 'Shift updated!');
        Session::flash('flash_type', 'success');

        return response()->json('Shift updated!', 200);
    }

    public function sendMail(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:users,id',
            'shifts' => 'required|array',
        ]);

        $user = User::findOrFail($request->id);
        $shifts = $request->shifts;

        Mail::to($user->email)->send(new MonthlyShifts($user, $shifts));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shift::find($id)->forcedelete();

        Session::flash('flash_message', 'Shift deleted!');
        Session::flash('flash_type', 'success');

        return response()->json('Shift deleted!', 200);
    }

    public function sendSMS($number, $message, $start = null, $end = null)
    {
        Nexmo::message()->send([
            'to' => '45'.$number,
            'from' => '45'.Auth::user()->phone,
            'text' => $message.' '.$start.' - '.$end,
        ]);
    }
}
