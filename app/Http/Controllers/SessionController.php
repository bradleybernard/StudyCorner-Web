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
                  		->where('study_sessions.status', '<', 2)->orderBy('study_sessions.time_start','desc')->get();

       return response()->json($sessions);
    }

    public function createSession(Request $request)
    {
      $data = $request->all();
      $info = [
        'owner_id' => $data['user_id'],
        'title' => $data['title'],
        'class_id' => $data['class_id'],
        'location' => $data['location'],
        'latitude' => $data['latitude'],
        'longitude' => $data['longitude'],
        'details' => $data['details'],
        'time_start' => $data['time_start'],
        'time_end' => $data['time_end'],
        'status' => $data['status'],
        'created_at' => $data['created_at'],
        'updated_at' => $data['updated_at']
      ];

      $session = StudySession::create($info);

    	return response()->json(['success'=>'true']);
    }

    public function giveUsers($id)
    {
      $user = User::join('user_sessions','user_sessions.session_id', '=', $id)
                  ->where('status_id', '=', 1);

        return response()->json($user);
    }
}
