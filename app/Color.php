<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model {

	use SoftDeletes;

	protected $fillable = [
		'hexCode'
	];

	protected $hidden = [
		'deleted_at', 'crated_at', 'updated_at'
	];

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function scopeAvailable($query) {
		return $query->where('used', 0);
	}

}
