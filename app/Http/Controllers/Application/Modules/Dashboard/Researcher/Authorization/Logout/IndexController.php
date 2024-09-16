<?php

namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Authorization\Logout;

//Get Authorization
use Illuminate\Support\Facades\Auth;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Get Request
use Illuminate\Http\Request;

//Get Token Authorization
use App\Http\Helpers\TokenAuthorizationUser;

//Get Class
class IndexController extends Controller{

  /*
  |--------------------------------------------------------------------------
  | Index Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles unauthenticating users for the application and
  | redirecting them to your login screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  //Application
  protected $application = 'application';

  //Page
  protected $page = 'logout';

  //User
  protected $user = 'researcher';

  /**************************************************************************************
    Route Path
  **************************************************************************************/
  public function routePath(){

    //Set Hyperlink
    $this->hyperlink['page']['login'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.authorization.login';
    $this->hyperlink['page']['home'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.home';

  }

  /**************************************************************************************
    Index
  **************************************************************************************/
  public function index(Request $request){

    //Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Token
    $token = new TokenAuthorizationUser();

    //Get Guard
    $guard = $token->encrypter->decrypt(session()->get('authorization_token'));

    //Check Guard
    switch($guard){

      //Employee
      case 'ldap_employee':

        //Unset Guard
        Auth::guard($guard)->logout();

        //Unset Session
        $request->session()
                ->invalidate();

        //Redirect to Login
        return redirect()->route($this->hyperlink['page']['login']);

      break;

      //If Failed
      default:

        //Return Failed
        abort(404);

      break;

    }

    //Return Failed
    abort(404);

  }

}
