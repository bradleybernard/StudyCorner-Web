<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\StudySession;

class SessionController extends Controller
{
   public function crossRefSession(Request $request)
   {
       $data = $request->all();

       $sessions = StudySession::join('user_classes','user_classes.class_id', '=', 'study_sessions.class_id')
       				    ->where('user_classes.user_id', $data['user_id'])
                  		->where('study_sessions.status', '<', 2)->get();

       return response()->json($sessions);
    }

    public function createSession(Request $request)
    {
    	$data = $request->all();
    	$session = StudySession::create($data);
    	$session->owner_id = $data->user_id;
    	return response()->json('success'=>'true');
    }

}
