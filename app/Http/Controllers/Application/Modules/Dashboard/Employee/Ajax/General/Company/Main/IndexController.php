<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Ajax\General\Company\Main;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Main\MSSQL\View\Company;
use App\Models\UCSI_V2_Main\MSSQL\View\CompanyOffice;


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
		'module'=>'General',
		'sub'=>'Ajax',
		'gate'=>''
	];

	//Route Link
	protected $route;

	//Asset
	public $asset;

	//Hyperlink
	public $hyperlink;

	/**************************************************************************************
		Route Path
	**************************************************************************************/
	public function routePath(){

		//Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.ajax.general.company';

	}

	/**************************************************************************************
 		Information
 	**************************************************************************************/
	public function information(Request $request){

    //Get Model
    $model['company'] = new Company();

    //Set Data
    $data['main'] = $model['company']->viewSelected(
      [
        'column'=>[
          'company_id'=>$request->company_id,
        ]
      ]
    );

    //Return JSON
    return response()->json(
      [
        'result'=>[
          'data'=>$data['main'],
        ]
      ]
    );

  }

  /**************************************************************************************
 		Office
 	**************************************************************************************/
	public function office(Request $request){

    //Get Model
    $model['company']['office'] = new CompanyOffice();

    //Set Data
    $data['main'] = $model['company']['office']->selectBox(
      [
        'column'=>[
          'company_id'=>$request->company_id,
        ]
      ]
    );

    //Return JSON
    return response()->json(
      [
        'result'=>[
          'data'=>$data['main'],
        ]
      ]
    );

  }

}
