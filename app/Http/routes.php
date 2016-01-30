<?php

use App\User;
use Vinkla\Pusher\Facades\Pusher as LaravelPusher;
use App\UserClass;
use App\SchoolClass;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('/api/user/login', 'LoginController@handleLogin');
Route::post('/api/user/create', 'ApiController@postRegister');


Route::get('/test',function (){
	$client = new \GuzzleHttp\Client([
            'cookies'               => true,
            'timeout'               => 20.0,
            'connect_timeout'       => 20.0,
            'verify'                => false,
            'headers'               => [
               'User-Agent'         => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2398.0 Safari/537.36',
               'Accept'             => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
               'Accept-Encoding'    => 'gzip, deflate, sdch',
               'Accept-Language'    => 'en-US,en;q=0.8',
               'Dnt'                => '1',
               'Pragma'             => 'no-cache',
               'Cache-Control'      => 'no-cache',
               'Host'               => 'ais-cs.ucsc.edu',
               'Origin'             => 'https://ais-cs.ucsc.edu',
               'Connection'         => 'keep-alive',
               'DNT'                => 1,
            ]
        ]);
        
        $fuckBrad = 0;
        do{
            $login = $client->request('POST', 'https://ais-cs.ucsc.edu/psc/csprd/EMPLOYEE/PSFT_CSPRD/c/SA_LEARNER_SERVICES.SSR_SSENRL_CART.GBL?cmd=login&languageCd=ENG', [
                'form_params' => [
                    'timezoneOffset'    => 480,
                    'Submit'            => 'Sign In',
                    'userid'            => 'dthurau',
                    'pwd'               => 'D4z26a1m13',
                ]
            ]);

            $html = new \Htmldom();
            $html->load($login->getBody());
            
            $classes = [];
            $rows = $html->find('table.PSLEVEL2GRIDWBO a.PSHYPERLINK');

            foreach($rows as $row) {
                $classes[] = $row->plaintext;
            }
            $fuckBrad = count($classes);
        }
        while($fuckBrad==0);
        $class_name = [];
        $class_number = [];
        foreach($classes as $indice => $value) {
            //DAN DID THIS
            $findPosition = strpos($classes[$indice], '(' );
            $subString = rtrim(substr($classes[$indice], 0, $findPosition - 1));
            $class_name[$indice] =  $subString;

            $findPosition = strpos($classes[$indice], '(' );
            $subString = substr($classes[$indice], $findPosition + 1 , 5 );
            $class_number[$indice] = $subString;

        }
        //dd($class_name,$class_number,$classes);

        echo 'classes:' . count($class_name);
        $pusher_data = [];
        foreach($class_name as $indice => $value) 
        {	

        	$class = SchoolClass::where('class_id',$class_number[$indice])->first();
        	if(!$class){
        		$class = SchoolClass::create([
        			'class_name' => $class_name[$indice],
        			'class_id' => $class_number[$indice]
        		]);
			}
			//dd($class);
        	UserClass::create([
        		'user_id' => 1,
        		'class_id' => $class->id,
        		'priority' => 1,
        	]);
        

        	$pusher_data[] = [
                 'class_name' => $class->name,
             	 'class_id'   => $class->id,
               	 'user_id'    => 1,
               	 'priority'   => 1,
          	];
     	}

    //dd($pusher_data);
    LaravelPusher::trigger('user', 'register',['message' => $pusher_data]);
    
});





/*


|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
