<?php

//Get Namespace
namespace App\Http\Middleware\Authorization\General;

//Get Authorization
use Illuminate\Support\Facades\Auth;

//Get Closure
use Closure;

//Get Request
use Illuminate\Http\Request;

//Get Response
use Symfony\Component\HttpFoundation\Response;

//Get Route Service Provider
use App\Providers\RouteServiceProvider;

//Get Token Authorization
use App\Http\Helpers\TokenAuthorizationUser;

//Get Class
class RedirectIfAuthenticated{

  //Set Path
  protected $path;

  //View Path
  protected $route;

  //Path Link
  public $hyperlink;

  /**************************************************************************************
    Route Path
  **************************************************************************************/
  public function routePath(){

    //Set Path Homepage
    $this->hyperlink['page']['home']['employee'] = config('routing.application.modules.dashboard.employee.name').'.home';
    $this->hyperlink['page']['login']['employee'] = config('routing.application.modules.dashboard.employee.name').'.authorization.login';
    $this->hyperlink['page']['home']['researcher'] = config('routing.application.modules.dashboard.researcher.name').'.home';
    $this->hyperlink['page']['login']['researcher'] = config('routing.application.modules.dashboard.researcher.name').'.authorization.login';

  }

  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, string ...$guards): Response{

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Set Token
    $token = new TokenAuthorizationUser();

    //Guard
    if(session()->has('authorization_token')){

      $guard = $token->encrypter->decrypt(session()->get('authorization_token'));

      switch($guard){

        //Employee
        case 'ldap_employee':

          // if(Auth::guard($guard)->check()){

            // //Return Dashboard
            // return redirect()->route($hyperlink['page']['home']['employee']);
            $this->checkRouteSegment($request);
          // }

        break;

        default:
        // dd($guard);
        break;

      }

    }

    return $next($request);
  }

  public function checkRouteSegment($data){
// dd($data->segments()[1]);
    switch($data->segments()[1]){
      case 'employee':
        dd(1);
        //Employee Not Authorize
        if(\Auth::guard('ldap_employee')->check()){

          //Redirect to Employee Login
          return route($this->hyperlink['page']['login']['employee']);

        }

      break;

      case 'researcher':
        // code...
// dd(\Auth::guard('ldap_employee')->check());
        //Employee Not Authorize
        if(\Auth::guard('ldap_employee')->check()){

          //Redirect to Employee Login
          return route($this->hyperlink['page']['home']['researcher']);

        }else{

          //Redirect to Employee Login
          return route($this->hyperlink['page']['login']['researcher']);

        }

      break;

      default:
        // code...
        dd(3);
      break;
    }

  }


}
