<?php

//Get Namespace
namespace App\Http\Middleware\Validation\Outlet\Table\CustomerOrder;

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

    //Set Path

    //Register
    $this->hyperlink['page']['outlet']['table']['register'] = config('routing.application.modules.landing.name').'.outlet.table.register';

    //Table Status Submit
    $this->hyperlink['page']['outlet']['table']['submit'] = config('routing.application.modules.landing.name').'.outlet.table.checkout.submit';

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

    //Set Model
    $model['table']['order']['header'] = new TableOrderHeader();

    $check['exist']['customer']['main'] = $model['table']['order']['header']->checkExist(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'order_id'=>$request->order_id,
          'date'=>'now'
          // 'status'=>'Created',
        ]
      ]
    );

    if(!isset($request->order_id)){

  
  // dd($check['exist']['customer']['main']);
      //Check Outlet Exist
      if(!$check['exist']['customer']['main']){

        //Abort
        // abort(404);
        // Redirect to Completed Order
        return redirect()->route($hyperlink['page']['outlet']['table']['register'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no]);

      }
    }
// dd($check['exist']['customer']['main']);
    $check['exist']['customer']['status']['created'] = $model['table']['order']['header']->checkExist(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'order_id'=>$request->order_id,
          'status'=>'Created',
        ]
      ]
    );

    //Check Outlet Exist
    if(!$check['exist']['customer']['status']['created']){

      //Redirect to Completed Order
      return redirect()->route($hyperlink['page']['outlet']['table']['submit'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no,'order_id'=>$request->order_id]);

    }

    //Return Next
    return $next($request);

  }


}
