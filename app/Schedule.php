<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Schedule extends Model {

	protected $fillable = [
		'dow', 'start', 'duration'
	];

	protected $hidden = [
		 'created_at', 'updated_at'
	];

	protected $appends = [
		'day', 'end'
	];

	public function getDowAttribute() {
		return $this->attributes['dow'] % 7;
	}

	public function getDayAttribute() {
		$daysOfWeek = [
			1 => 'Monday',
			2 => 'Tuesday',
			3 => 'Wednesday',
			4 => 'Thursday',
			5 => 'Friday',
			6 => 'Saturday',
			0 => 'Sunday'
		];

		$day = $this->dow;

		return $daysOfWeek[$day];
	}

	public function getEndAttribute() {
		$start = Carbon::parse($this->attributes['start']);

		$end = Carbon::parse($this->attributes['start'])->addHours($this->attributes['duration']);

		$diff =  !$start->isSameDay($end);

		if($end === Carbon::today()->startOfDay()->toTimeString()){
			$end = '24:00:00';
		}

		return $diff.'.'.$end->toTimeString();
	}

}
