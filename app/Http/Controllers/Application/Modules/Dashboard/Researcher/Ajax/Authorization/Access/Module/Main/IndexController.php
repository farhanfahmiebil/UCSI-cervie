<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Ajax\Authorization\Access\Module\Main;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Access\MSSQL\View\EmployeeAccessModule;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'employee';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'Ajax',
		'sub'=>'',
		'gate'=>''
	];

	//Route Link
	protected $route;

	//Asset
	public $asset;

	//Hyperlink
	public $hyperlink;

	/**************************************************************************************
 		Company
 	**************************************************************************************/
	public function company(Request $request){

    //Get Model
    $model['module']['main'] = new EmployeeAccessModule();

    //Set Data
    $data['main'] = $model['module']['main']->getEmployeeAccessModule(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'module_category_id'=>$request->module_category_id,
          'domain_url'=>$request->root()
        ]
      ]
    );
    // dd($data['main']);
    // $msg = "This is a simple message.";
    //Return JSON
    return response()->json(array('result'=>$data['main']),200);

  }

  /**************************************************************************************
 		Module Sub
 	**************************************************************************************/
	public function moduleSub(Request $request){

    //Get Model
    $model['module']['main'] = new EmployeeAccessModule();

    //Set Data
    $data['main'] = $model['module']['main']->getEmployeeAccessModuleSub(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'module_category_id'=>$request->module_category_id,
          'domain_url'=>$request->root()
        ]
      ]
    );
    // dd($data['main']);
    // $msg = "This is a simple message.";
    //Return JSON
    return response()->json(array('result'=>$data['main']),200);

  }

}
