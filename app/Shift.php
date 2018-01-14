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
		'end', 'title', 'color', 'email',
		'startDate', 'endDate'
	];

	protected $hidden = [
		'user_id', 'created_at', 'updated_at', 'deleted_at',
	];

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function getStartDateAttribute() {
		return Carbon::parse($this->attributes['start'])->toDateString();
	}
	public function getEndAttribute() {
		return Carbon::parse($this->attributes['start'])->addHours($this->attributes['duration'])->toDateTimeString();
	}
	public function getEndDateAttribute() {
		return Carbon::parse($this->attributes['start'])->addHours($this->attributes['duration'])->toDateString();
	}

	public function getTitleAttribute() {
		return $this->user->first_name . ' ' . $this->user->last_name;
	}

	public function getColorAttribute() {
		$color = $this->user->color;

		if($color){
			return $color->hexCode;
		}

		return '#000000';
	}

	public function getEmailAttribute() {
		return $this->user->email;
	}

	public function setDurationAttribute($value) {
		return $this->attributes['duration'] = Carbon::parse($this->attributes['start'])->diffInHours(Carbon::parse($value));
	}

    public function scopeBetween($query, $start, $end){
        return $query->whereBetween('start', [$start, $end]);
    }
}
