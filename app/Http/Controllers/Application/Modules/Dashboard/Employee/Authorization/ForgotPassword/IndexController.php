<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Authorization\ForgotPassword;

//Get Authorization
use Auth;

//Get Authenticates Users
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Get Authorization
use App\Http\Helpers\TokenAuthorizationUser;

//Controller Helper
use App\Http\Controllers\Controller;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

  //Path Header
	protected $header = [
		'category'=>'Authorization',
		'module'=>'Forgot Password',
		'sub'=>'Candidate',
		'gate'=>''
	];

  //Application
  protected $application = 'application';

  //User
  protected $user = 'candidate';

  //View Path
  protected $route;

  //Path Link
  public $hyperlink;

  //Asset
  public $asset;

  //Token
  public $token;

  /**************************************************************************************
    Construct
  **************************************************************************************/
  public function __construct(){

    //Set Middleware
    $this->middleware('guest')->except('logout');
    $this->middleware('guest:'.$this->user)->except('logout');

  }

  /**************************************************************************************
    Route Path
  **************************************************************************************/
  public function routePath(){

    //Set View
    $this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.authorization.forgot_password.';

    //Set Path
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.authorization.forgot_password.';

    //Set Asset
    $this->asset['images'] = 'images/'.$this->application.'/modules/dashboard/'.$this->user.'/authorization/forgot_password/';

    //Set Hyperlink
    $this->hyperlink['page']['process'] = $this->route['name'].'process';
		$this->hyperlink['page']['login'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.authorization.login';
		$this->hyperlink['page']['home'] = config('routing.'.$this->application.'.modules.landing.name').'.home';

  }

  /**************************************************************************************
    Login
  **************************************************************************************/
  public function index(Request $request){

    //Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Asset
    $asset = $this->asset;

    //Set Breadcrumb
		$data['title'] = array($this->header['category'],$this->header['module'],$this->header['sub']);

    //Set Token
    $token = new TokenAuthorizationUser();

    //Get Authorization Token Guard
    $authorization_token['guard'] = $token->encrypt['guard'][$this->user];
// dd($request->session()->get('booking.booking_redirect'));
    //Get Authorization Token Database
    $authorization_token['database'] = $token->encrypt['database']['recruitment'];

    //Return View
    return view($this->route['view'].'index',compact('authorization_token','asset','hyperlink','data'));

  }

  /**************************************************************************************
    Process
  **************************************************************************************/
  public function process(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Check Validation Request
    $validate = $request->validate(

      //Check Validation
      [
        'username'=>['required'],
        'password'=>['required'],
      ],

      //Error Message
      [
        'username.required'=>'Username required',
        'password.required'=>'Password required',
      ]
     );

     //Check Validate
     if($validate){
// dd((
// 		$this->guard($this->user)->attempt(
// 		$this->credentials($request)
// 	)));
       if(
           $this->guard($this->user)->attempt(
           $this->credentials($request)
         )
       ){

         //Should Use Guard
         Auth::shouldUse($this->user);

         //Set Session Guard
         $request->session()->put('guard',$this->user);

         //Check Session Guard
         if($request->has('redirect')){

           //Redirect to Dashboard
           return redirect()->intended(route($hyperlink['page']['process_booking']));

         }

         //Redirect to Dashboard
         return redirect()->intended(route($hyperlink['page']['home']));

         //Return True
         return true;

       }

       //Return Redirect Error
       return redirect()->route($hyperlink['page']['login']['administrator'])
                        ->with('alert_type','error')
                        ->with('message','Invalid Email or Password');

     }

  }

  /**
   * Get the needed authorization credentials from the request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  protected function credentials(Request $request){
// dd();
    //Field
    $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

    //Return Request
    return [
      $field => $request->get($this->username()),
      'password' => $request->password,
    ];

  }

  /**
   * Get the login username to be used by the controller.
   *
   * @return string
   */
  public function username(){return 'username';}

  /**
   * Log the user out of the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  /**
   * Get the guard to be used during authentication.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard($guard){return Auth::guard($guard);}

}
