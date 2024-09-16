<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Ajax\University\Setup\Campus;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Education\MSSQL\Table\Campus;

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
		'module'=>'University',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.ajax.university.setup.campus';

	}

	/**************************************************************************************
 		Get Campus Semester
 	**************************************************************************************/
	public function getCampusSemester(Request $request){

    //Get Model
    $model['campus'] = new Campus();

    //Set Data
    $data['main'] = $model['campus']->getCampusSemester(
      [
        'column'=>[
          'campus_id'=>$request->campus_id,
        ]
      ]
    );

    //Return JSON
    return response()->json(array('result'=>$data['main']),200);

  }

}
