<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Ajax\Finance\Einvoice;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Main\MSSQL\View\ApiEndpoint;

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
		'module'=>'Finace',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.ajax.finance.einvoice';

	}

	/**************************************************************************************
 		Login
 	**************************************************************************************/
	public function login(Request $request){

    //Get Model
    $model['api']['endpoint'] = new ApiEndpoint();

    //Set Data
    $data['main'] = $model['api']['endpoint']->getLogin(
      [
        'column'=>[
          'company_id'=>$request->company_id,
        ]
      ]
    );
    // $msg = "This is a simple message.";
    //Return JSON
    return response()->json(array('result'=>$data['main']),200);

  }

}
