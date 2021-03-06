<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudySession extends Model
{
    protected $table = 'study_sessions';
    protected $guarded = [];

    public function usersGoing()
    {
    		return $this->hasMany('App\User');
    }
}
