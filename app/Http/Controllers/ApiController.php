<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;


class ApiController extends Controller
{
    public function postRegister(Request $request){
       $data = $request->all();
       User::create($data);
       return response()->json(['success' =>'true']);
 
    }

}
