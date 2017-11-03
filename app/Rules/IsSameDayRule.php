<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class IsSameDayRule implements Rule {

	protected $user;

	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct(User $user) {
		$this->user = $user;
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string $attribute
	 * @param  mixed $value
	 * @return bool
	 */
	public function passes($attribute, $value) {
		$shifts = $this->user->shifts()->get();
		$date = Carbon::parse($value)->toDateString();

		if ($shifts->where('startDate', $date)->count() > 0) {
			return false;
		}
		if ($shifts->where('endDate', $date)->count() > 0) {
			return false;
		}


//		foreach($shifts as $shift) {
//			if($date->isSameDay(Carbon::parse($shift['start']))) {
//				return false;
//			}
//			if($date->isSameDay(Carbon::parse($shift['end']))) {
//				return false;
//			}
//		}

		return true;
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message() {
		return 'Employee already has a shift in the same day.';
	}
}
