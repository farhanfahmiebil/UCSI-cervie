<?php

//Get Namespace
namespace App\Http\Middleware\Authorization\General;

//Get Auth
use Illuminate\Support\Facades\Auth;

//Get Middleware
use Illuminate\Auth\Middleware\Authenticate as Middleware;

//Get Route
use Route;

//Get Class
class Authenticate extends Middleware{

  /**
   * Get the path the user should be redirected to when they are not authenticated.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return string
   */

  //Set Hyperlink
  public $hyperlink;

  /**************************************************************************************
    Route Path
  **************************************************************************************/
  public function routePath(){

    //Set Path Homepage
    $this->hyperlink['page']['home']['route'] = config('routing.application.modules.dashboard.employee.name').'.*';
    $this->hyperlink['page']['home']['employee'] = config('routing.application.modules.dashboard.employee.name').'.home';
    $this->hyperlink['page']['login']['employee'] = config('routing.application.modules.dashboard.employee.name').'.authorization.login';

    $this->hyperlink['page']['home']['route'] = config('routing.application.modules.dashboard.researcher.name').'.*';
    $this->hyperlink['page']['home']['researcher'] = config('routing.application.modules.dashboard.researcher.name').'.home';
    $this->hyperlink['page']['login']['researcher'] = config('routing.application.modules.dashboard.researcher.name').'.authorization.login';

  }

  /**************************************************************************************
    Redirect To
  **************************************************************************************/
  protected function redirectTo($request){
// dd(\Auth::guard('ldap_employee')->check());
    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Check JSON
    if(!$request->expectsJson()){
// dd($request->segments()[0]);

      switch($request->segments()[0]){
        case 'employee':
          // code...
          // dd(1);
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

      // if(Route::is($this->hyperlink['page']['home']['route'])){
      //
      //   //Redirect to Employee Login
      //   return route($this->hyperlink['page']['login']['employee']);
      //
      // }

      //Abort
      return abort(401);

    }

  }

}
