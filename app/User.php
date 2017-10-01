<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name', 'last_name', 'phone', 'color', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'
	];

	public function roles() {
		return $this->belongsToMany('App\Role');
	}

	public function hasRole($name) {
		foreach($this->roles as $role) {
			if($role->role == $name) return true;
		}

		return false;
	}

	public function scopeWithRoles($query, array $name) {
		return $query->whereHas('roles', function($query) use ($name) {
			$query->whereIn('role', $name);
		});
	}

	public function shifts() {
		return $this->hasMany('App\Shift');
	}
}
