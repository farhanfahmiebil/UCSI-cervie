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
    // $data['user'] = $user;
    $user = 'researcher';
    // $item['module']['category']['main'] = ((Request::segment(3) != 'home')?Request::segment(3):null);
    // $item['module']['category']['sub'] = ((Request::segment(4) != null)?Request::segment(4):null);
// dd($item);
    //Get Navigation Module By Company
    $data['module']['company'] = $this->navigationAccess(
      [
        'category'=>'company',
        'user'=>$user,
        'module_category'=>$item['module']['category']['main']
      ]
    );

    //Get Navigation By Module
    $data['module']['main'] = $this->navigationAccess(
      [
        'category'=>'module',
        'user'=>$user,
        'module_category'=>$item['module']['category']['main'],
        'employee_id'=>Auth::id(),
      ]
    );

    //Get Navigation Module Sub
    $data['module']['sub']['main'] = $this->navigationAccess(
      [
        'category'=>'sub',
        'user'=>$user,
      ]
    );

    //Get Navigation Module Sub Item
    $data['module']['sub']['item'] = $this->navigationAccess(
      [
        'category'=>'sub_item',
        'user'=>$user,
      ]
    );
// dd($data);
    // dd($data['module']['company']);
// dd($data['module']['sub']['item']);
// dd($data['module']['category']['main']);
    //Get Navigation Module Main
    // $data['module']['category']['sub'] = $this->navigationAccess(
    //   [
    //     'category'=>'category_sub',
    //     'user'=>$user,
    //     'module_category'=>$item['module']['category']['main'],
    //     'module_category_sub'=>$item['module']['category']['sub']
    //
    //   ]
    // );
// dd($data['module']['category']['sub']);
    //Get Navigation Module Main
    // $data['module']['main'] = $this->navigationAccess(
    //   [
    //     'category'=>'module',
    //     'user'=>$user,
    //   ]
    // );
// dd($data['module']['main'] );
    //Get Navigation Module Sub
    // $data['module']['sub']['main'] = $this->navigationAccess(
    //   [
    //     'category'=>'sub',
    //     'user'=>$user,
    //   ]
    // );


// dd($data['module']['sub'] );
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

                //Module Company
                case 'company':

                  //Set Model
                  $model['module'][$data['category']] = new EmployeeAccessModuleCompany();

                  //Get Data
                  $result = $model['module'][$data['category']]->getEmployeeAccessModuleCompany(
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
// dd($result);
                break;

                //Module Sub Item
                case 'sub_item':

                  //Set Model
                  $model['module'][$data['category']] = new EmployeeAccessModuleSubItem();

                  //Get Data
                  $result = $model['module'][$data['category']]->getEmployeeAccessModuleSubItem(
                    [
                      'column'=>[
                        'employee_id'=>Auth::guard($this->guard)->id(),
                        'domain_url'=>Request::root()
                      ]
                    ]
                  );
// dd($result);
                break;


                //Module Category Sub
                case 'category_sub':

                  //Set Model
                  $model['module'][$data['category']] = new EmployeeAccessModuleCategorySub();

                  //Get Data
                  $result = $model['module'][$data['category']]->getEmployeeAccessModuleCategorySub(
                    [
                      'column'=>[
                        'employee_id'=>Auth::guard($this->guard)->id(),
                        'domain_url'=>Request::root(),
                        'module_category'=>$data['module_category']
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
