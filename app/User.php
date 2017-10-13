<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

	use Notifiable, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name', 'last_name', 'phone', 'color_id', 'email', 'password'
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

	public function is($roleName) {
		foreach($this->roles()->get() as $role) {
			if($role->role == $roleName) {
				return true;
			}
		}

		return false;
	}

	public function shifts() {
		return $this->hasMany('App\Shift');
	}

	public function color() {
		return $this->hasOne('App\Color', 'id', 'color_id');
	}

	public function hexColor() {
		return $this->color()->pluck('hexCode')->first();
	}

	public function scopeWithRoles($query, array $name) {
		return $query->whereHas('roles', function($query) use ($name) {
			$query->whereIn('role', $name);
		});
	}

}
