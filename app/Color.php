<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model {

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
