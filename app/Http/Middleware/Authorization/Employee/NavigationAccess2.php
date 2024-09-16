<?php

namespace App\Http\Middleware\Authorization\Employee;

//Get Authorization
Use Auth;

//Get Closure
use Closure;

//Get Model
use App\Models\UCSI_V2_Access\MSSQL\View\EmployeeAccessModuleCategory;
use App\Models\UCSI_V2_Access\MSSQL\View\EmployeeAccessModule;
use App\Models\UCSI_V2_Access\MSSQL\View\EmployeeAccessModuleSub;

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
  public function handle($request, Closure $next,$user){

    //Set Data User
    $data['user'] = $user;
    $item['module']['category'] = ((Request::segment(3) != 'home')?Request::segment(3):null);

    //Get Navigation Module Main
    $data['module']['category'] = $this->navigationAccess(
      [
        'category'=>'category',
        'user'=>$user,
        'module_category'=>$item['module']['category']

      ]
    );

    //Get Navigation Module Main
    $data['module']['main'] = $this->navigationAccess(
      [
        'category'=>'module',
        'user'=>$user,
      ]
    );

    //Get Navigation Module Sub
    $data['module']['sub'] = $this->navigationAccess(
      [
        'category'=>'sub',
        'user'=>$user,
      ]
    );

    //Share Access
    View::share('access',$data);

    //Return Next Request
    return $next($request);

  }

  /**************************************************************************************
    Navigation Access
  **************************************************************************************/
  public function navigationAccess($data){
// dd(Request::root());
    //Check Data Not Empty
    if(!empty($data)){

      //Check Data User Not Empty
      if(isset($data['user']) && !empty($data['user'])){

        //Get Data Category
        switch($data['user']){

          //User
          case 'employee':

            //Check Data User Not Empty
            if(isset($data['category']) && !empty($data['category'])){

              //Get Data Category
              switch($data['category']){

                //Module Category
                case 'category':

                  //Set Model
                  $model['module'][$data['category']] = new EmployeeAccessModuleCategory();

                  //Get Data
                  $result = $model['module'][$data['category']]->getEmployeeAccessModuleCategory(
                    [
                      'column'=>[
                        'employee_id'=>Auth::guard($this->guard)->id(),
                        'domain_url'=>Request::root(),
                        'module_category'=>$data['module_category']
                      ]
                    ]
                  );

                break;

                //Module
                case 'module':

                  //Set Model
                  $model['module'][$data['category']] = new EmployeeAccessModule();

                  //Get Data
                  $result = $model['module'][$data['category']]->getEmployeeAccessModule(
                    [
                      'column'=>[
                        'employee_id'=>Auth::guard($this->guard)->id(),
                        'domain_url'=>Request::root()
                      ]
                    ]
                  );

                break;

                //Module Sub
                case 'sub':

                  //Set Model
                  $model['module'][$data['category']] = new EmployeeAccessModuleSub();

                  //Get Data
                  $result = $model['module'][$data['category']]->getEmployeeAccessModuleSub(
                    [
                      'column'=>[
                        'employee_id'=>Auth::guard($this->guard)->id(),
                        'domain_url'=>Request::root()
                      ]
                    ]
                  );

                break;

              }

            }
// dd($result);
          break;

        }

      }
// dd($result);
      //Return Result
      return $result;

    }

  }

}
