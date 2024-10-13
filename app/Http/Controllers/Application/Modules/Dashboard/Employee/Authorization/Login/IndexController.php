<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Authorization\Login;

//Get Authorization
use Auth;

//Get Authenticates Users
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Get Authorization
use App\Http\Helpers\TokenAuthorizationUser;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

  //Path Header
	protected $header = [
		'category'=>'Authorization',
		'module'=>'Login',
		'sub'=>'Employee',
		'gate'=>''
	];

  //Application
  protected $application = 'application';

  //User
  protected $user = 'employee';

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
    $this->middleware('guest:ldap_'.$this->user)->except('logout');

  }

  /**************************************************************************************
    Route Path
  **************************************************************************************/
  public function routePath(){

    //Set View
    $this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.authorization.login.';

    //Set Path
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.authorization.login.';

    //Set Asset
    $this->asset['images'] = 'images/'.$this->application.'/modules/dashboard/'.$this->user.'/authorization/login/';

    //Set Hyperlink
    $this->hyperlink['page']['process'] = $this->route['name'].'process';
		$this->hyperlink['page']['register'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.authorization.register';
		$this->hyperlink['page']['forgot_password'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.authorization.forgot_password';
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
    $authorization_token['guard'] = $token->encrypt['guard']['ldap'][$this->user];

    //Get Authorization Token Database
    $authorization_token['database'] = $token->encrypt['database']['employee'];

    //Return View
    return view($this->route['view'].'index',compact('authorization_token','asset','hyperlink','data'));

  }

}
