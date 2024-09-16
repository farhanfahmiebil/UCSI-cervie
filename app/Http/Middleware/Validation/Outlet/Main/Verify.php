<?php

//Get Namespace
namespace App\Http\Middleware\Validation\Outlet\Main;

//Get Authorization
use Illuminate\Support\Facades\Auth;

//Get Closure
use Closure;

//Get Model
use App\Models\UCSI_Hotel_POS\MSSQL\Table\POS_FNBOutlet;

//Get Request
use Illuminate\Http\Request;

//Get Response
use Symfony\Component\HttpFoundation\Response;

//Get Route Service Provider
use App\Providers\RouteServiceProvider;

//Get Class
class Verify{

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

  }

  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, string ...$guards): Response{
      // public function redirect($request){
// dd(\Auth::guard('ldap_employee')->check());
    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Set Model
    $model['outlet']['main'] = new POS_FNBOutlet();

    //Get Data
    $check['exist']['outlet'] = $model['outlet']['main']->checkExist(
      [
        'column'=>[
          'id'=>$request->outlet_id
        ]
      ]
    );

    //Check Outlet Exist
    if(!$check['exist']['outlet']){

      //Abort
      abort(404);

    }
// dd($next($request));
    return $next($request);

    dd($request->outlet_id);

  }


}
