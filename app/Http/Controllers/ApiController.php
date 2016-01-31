<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Jobs\FetchClasses;
use Crypt;

class ApiController extends Controller
{
    public function postRegister(Request $request){
       $data = $request->all();
       $data['password'] = bcrypt($data['password']);
       $data['gold_password'] = Crypt::encrypt($data['gold_password']);
       $user = User::create($data);
       
       $this->dispatch (new FetchClasses($user));
       return response()->json(['success' =>'true', 'user_id' => $user->id]);
 
    }


}



