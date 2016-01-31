<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserClass;

class PriorityController extends Controller
{
    public function setPriority(Request $request)
    {
    	$data = $request->input('classes');

    	// classes: [
    	// 	[
    	// 		'class_name' => 'test',
    	// 		'class_id'	=> 1,
    	// 		'priority' => 1,
    	// 		'user_id'	=> 2
    	// 	],
    	// 	[
    	// 		'class_name' => 'test',
    	// 		'class_id'	=> 1,
    	// 		'priority' => 1,
    	// 		'user_id'	=> 2
    	// 	],
    	// 	[
    	// 		'class_name' => 'test',
    	// 		'class_id'	=> 1,
    	// 		'priority' => 1,
    	// 		'user_id'	=> 2
    	// 	]
    	// ]

        // [
        //     [
        //         'class_id' => 1
        //     ],
        //     [   
        //         'class_name' => 'test'
        //     ],
        //     [
        //         'user_id' => 
        //     ]
        // ]

        for($i = 0; $i < count($data); $i += 3) {
            UserClass::where('class_id', $data[$i]['class_id'])
            ->where('user_id', $data[$i + 1]['user_id'])
            ->update( ['priority' => $data[$i + 2]['priority'] ]);
        }

    	// foreach($data as $key => $ele)
    	// {
    	// 	UserClass::where('class_id', $ele['class_id'])->where('user_id', $ele['user_id'])->update([
    	// 		'priority' => $ele['priority']
    	// 	]);

     //   	}

       	return response()->json([
       		'success' => true
       	]);
    }
}
