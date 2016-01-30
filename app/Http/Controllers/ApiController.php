<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Jobs\FetchClasses;


class ApiController extends Controller
{
    public function postRegister(Request $request){
       $data = $request->all();
       $user = User::create($data);
       
       $this->dispatch (new FetchClasses($user));
       return response()->json(['success' =>'true', 'user_id' => $user->id]);
 
    }


}



