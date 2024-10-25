<?php

namespace App\Http\Middleware\Authorization\Researcher;

//Get Authorization
Use Auth;

//Get Closure
use Closure;

//Get Model
use App\Models\UCSI_V2_Access\MSSQL\View\NavigationCategory AS NavigationCategoryView;

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
// dd(32);
    //Set Data User
    // $data['user'] = $user;
    $user = 'researcher';
    // $item['module']['category']['main'] = ((Request::segment(3) != 'home')?Request::segment(3):null);
    // $item['module']['category']['sub'] = ((Request::segment(4) != null)?Request::segment(4):null);
// dd($item);
    //Get Navigation Category
    $data['navigation']['category'] = $this->navigationCategory(
      [
        'category'=>'PORTAL',
        'user'=>'researcher'
      ]
    );
// dd($data['navigation']['category']);
    //Share Access
    View::share('access',$data);

    //Return Next Request
    return $next($request);

  }

  /**************************************************************************************
    Navigation Category
  **************************************************************************************/
  public function navigationCategory($data){
// dd(Request::root());
    //Check Data Not Empty
    if(!empty($data)){

      //Check Data User Not Empty
      if(isset($data['user']) && !empty($data['user'])){

        //Get Data Category
        switch($data['user']){

          //Researcher
          case 'researcher':
// dd(1);
            //Set Model Navigation Category
            $model['navigation']['category'] = new NavigationCategoryView();

            //Get Model Navigation Category
            $result = $model['navigation']['category']->getList(
              [
                'column'=>[
                  'category'=>$data['category'],
                  'user_type'=>strtolower($data['user']),
                  'domain_url'=>Request::root()
                ]
              ]
            );
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
