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
       				->where('user_classes.user_id', $data->user_id)
       				->where('study_session.status', '<', 2)->get();
       				//->where('study_session.pritority', '<', 1);
       dd($sessions);
       return response()->json(['success' =>'true', ]);
 
    }
}
