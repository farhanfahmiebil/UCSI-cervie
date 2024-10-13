<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Ajax\Home;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeAccessModuleSub;

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
		Route Path
	**************************************************************************************/
	public function routePath(){

		//Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.ajax.home';

		//Set Image Route
		// $this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/home/';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
    // $this->hyperlink['page']['ajax']['navigation_access_module_sub'] = config('routing.application.modules.landing.name').'.ajax.home.navigation_access_module_sub';
	}

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){

    //Get Model
    $model['module']['sub'] = new EmployeeAccessModuleSub();

    //Set Data
    $data['main'] = $model['module']['sub']->getNavigationAccess(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'module_id'=>$request->module_id,
        ]
      ]
    );
    // $msg = "This is a simple message.";
    //Return JSON
    return response()->json(array('result'=>$data['main']),200);

  }

}
