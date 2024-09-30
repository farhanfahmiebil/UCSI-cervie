<?php

namespace App\Http\Middleware\Authorization\Researcher;

//Get Authorization
Use Auth;

//Get Closure
use Closure;

//Get Model
use App\Models\UCSI_V2_Access\MSSQL\View\NavigationCategory;

//Get Request
use Illuminate\Support\Facades\Request;

//Get View
use Illuminate\Support\Facades\View;

//Get Class
class NavigationAccess{

  //Set Guard
  protected $guard = 'ldap_employee';

  /**************************************************************************************
    Handle
  **************************************************************************************/
  public function handle($request, Closure $next){

    //Set Data User
    $user = 'researcher';

    $data['editable'] = (Auth::check() ? Auth::user()->employee->isEditable($request->route('employee_id')) : null);

    //Share Access
    View::share('access',$data);

    //Return Next Request
    return $next($request);

  }

}
