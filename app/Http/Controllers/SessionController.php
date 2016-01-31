<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\StudySession;

class SessionController extends Controller
{
   public function crossRefSession(Request $request){
       $data = $request->all();
       //$user = User::where('id',$data->user_id);
       $sessions = StudySession::join('user_classes','user_classes.class_id', '=', 'study_sessions.class_id')
       				->where('user_classes.user_id', $data['user_id'])
       				->where('study_sessions.status', '<', 2)->get();
       				//->where('study_session.pritority', '<', 1);
       // dd($sessions);

      $going = StudySession::join('user_sessions', 'study_sessions', '=', ' ')
       //dd($sessions->toArray());
       return response()->json([
          'success' =>'true', 
          'title' => $sessions->title,
          'class_id' => $sessions->class_id,
          'location' => $sessions->location,
          'owner_id' => $sessions->owner_id,
          'latitude' => $sessions->latitude,
          'longitude' =>$sessions->longitude,
          'details' =>$sessions->details,
          'time_start' =>$sessions->time_start,
          'time_end'=>$sessions->time_end,
          'status'=>$sessions->status
          ]);
    }

}
