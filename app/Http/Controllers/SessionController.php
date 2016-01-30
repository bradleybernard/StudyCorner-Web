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
       //$data = $request->all();
       
       
       return response()->json(['success' =>'true', ]);
 
    }
}
