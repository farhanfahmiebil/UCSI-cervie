<?php

//Get Namespace
namespace App\Http\Middleware\Validation\Outlet\Table\Main;

//Get Authorization
use Illuminate\Support\Facades\Auth;

//Get Closure
use Closure;

//Get Model
use App\Models\UCSI_Hotel_POS\MSSQL\Table\TableApps_OrderHeader AS TableOrderHeader;

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
    $this->hyperlink['page']['outlet']['table']['taken'] = config('routing.application.modules.landing.name').'.outlet.table.register.taken';
    $this->hyperlink['page']['outlet']['table']['register'] = config('routing.application.modules.landing.name').'.outlet.table.register';

  }

  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, string ...$guards): Response{
      // public function redirect($request){
      // dd($request->route()->uri);
// dd(\Auth::guard('ldap_employee')->check());


// dd(32);
    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Set Model
    $model['table']['order']['header'] = new TableOrderHeader();

    $check['exist']['customer']['main'] = $model['table']['order']['header']->checkExist(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'date'=>'now',
          'status'=>'Submitted',
        ]
      ]
    );
// dd($check['exist']['customer']['main']);
    //Check Outlet Exist
    if($check['exist']['customer']['main']){

      switch($request->route()->uri){
        case 'outlet/{outlet_id}/table/{table_no}/register/taken':

          return $next($request);
          // code...
        break;

        case 'outlet/{outlet_id}/table/{table_no}/register': return redirect()->route($hyperlink['page']['outlet']['table']['taken'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no]);
          // code...
        break;


        default:
          // code...
          break;
      }
      //Abort
      // Abort(5551,"Table is Taken")
      // if($request->route()->uri === 'outlet/{outlet_id}/table/{table_no}/register/taken'){
      //
      // }
      //
      // return redirect()->route($hyperlink['page']['outlet']['table']['taken'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no]);
    }

    switch($request->route()->uri){
      case 'outlet/{outlet_id}/table/{table_no}/register/taken':

        return redirect()->route($hyperlink['page']['outlet']['table']['register'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no]);
        // code...
      break;

      case 'outlet/{outlet_id}/table/{table_no}/register/taken':
        return $next($request);
        
      break;


      default:
        // code...
        break;
    }
    // else{
    //
    //   if($request->route()->uri === 'outlet/{outlet_id}/table/{table_no}/register'){
    //     return $next($request);
    //   }
    //
    //   return redirect()->route($hyperlink['page']['outlet']['table']['register'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no]);
    //
    // }

    return $next($request);

  }


}
