<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function handleLogin(Request $request)
    {
    	$data = $request->all();

		if (Auth::attempt(['email' => $data->email, 'password' => $data->password], false)) {
		    $user = Auth::user();
		}

    }

}
