<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use App\SocialUser;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}
        
        /**
	 * Add data to the application.
	 *
	 * @return Response
	 */
	public function add_facebook_user()
	{
            try {                 
               $facebokId = Request::input('id');                
               $existingSocialUser = SocialUser::where('facebook_id', $facebokId)->first();
               if(count($existingSocialUser) < 1) {
                    $socialUser = new SocialUser();              
                    $socialUser->fullname = Request::input('fullname');    
                    $socialUser->facebook_id = $facebokId;
                    $socialUser->save();   
               }               
            } catch (Exception $e) {
                echo $e->getMessage();
            }        
	}

}
