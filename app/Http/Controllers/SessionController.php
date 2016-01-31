<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\StudySession;
use App\Jobs\sendNotifications;
use App\UserSessions;

class SessionController extends Controller
{
   public function fireTest() 
   {
      $this->dispatch(new sendNotifications(StudySession::find(4)));
      return 'done';
   }

   public function crossRefSession(Request $request)
   {
       $data = $request->all();

       $sessions = StudySession::select(['study_sessions.*', 'user_classes.*', 'study_sessions.id as study_id'])->join('user_classes','user_classes.class_id', '=', 'study_sessions.class_id')
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
      $this->dispatch (new sendNotifications($session));
    	return response()->json(['success'=>'true']);
    }

    public function giveUsers(Request $request, $id)
    {
      $signedUp = false;
      $data = $request->all();
      $user = User::join('user_sessions', 'user_sessions.user_id', '=', 'users.id')->
                  where('user_sessions.session_id', '=', $id)
                  ->where('user_sessions.status', '=', 1)->get();

      foreach ($user as $key) 
      {
        if($key->user_id == $data['user_id'])
        {
           $signedUp = true;
        }
      }

        return response()->json(['success' => 'true', 'users' => $user, 'signed_up' => $signedUp]);
    }

    public function addingUsers(Request $request)
    {

      $data = $request->all();
      $info = [
      'user_id' => $data['user_id'],
      'session_id' => $data['session_id'],
      'status' => $data['status']
      ];

      $userSession = UserSessions::create($info);
      return response()->json(['success'=>'true']);
    }
}
