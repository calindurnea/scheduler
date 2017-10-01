<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
    	'start', 'end',
    ];

    protected $hidden = [
    	'user_id'
    ];
    
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
