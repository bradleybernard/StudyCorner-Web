<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSessions extends Model
{
	protected $table = 'user_sessions';
	protected $guarded = [];
    
    public function usersGoing()
    {
    		return $this->hasMany('App\User');
    }
}
