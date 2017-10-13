<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Shift extends Model {

	use SoftDeletes;

	protected $fillable = [
		'start', 'duration', 'user_id'
	];

	protected $appends = [
		'end', 'title', 'color', 'email'
	];

	protected $hidden = [
		'user_id', 'created_at', 'updated_at', 'deleted_at', 'duration'
	];

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function getEndAttribute() {
		return Carbon::parse($this->attributes['start'])->addHours($this->attributes['duration'])->toDateTimeString();
	}

	public function getTitleAttribute() {
		$user = $this->user();

		return $user->pluck('first_name')->first() . ' ' . $user->pluck('last_name')->first();
	}

	public function getColorAttribute() {
		$hexColor = Color::where('id', '=', $this->user()->pluck('color_id')->first())
			->pluck('hexCode')
			->first();

		return $hexColor;
	}

	public function getEmailAttribute() {
		return $this->user()->pluck('email')->first();
	}

	public function setDurationAttribute($value) {
		return $this->attributes['duration'] = Carbon::parse($this->attributes['start'])->diffInHours(Carbon::parse($value));
	}
}
