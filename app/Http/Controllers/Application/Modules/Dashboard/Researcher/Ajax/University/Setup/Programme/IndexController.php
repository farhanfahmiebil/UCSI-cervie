<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Ajax\University\Setup\Programme;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Education\MSSQL\Table\Programme;

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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.ajax.university.setup.programme';

	}

	/**************************************************************************************
 		Get Programme Major
 	**************************************************************************************/
	public function getProgrammeMajor(Request $request){

    //Get Model
    $model['programme']['major'] = new Programme();

    //Set Data
    $data['main'] = $model['programme']['major']->getProgrammeMajorAjax(
      [
        'column'=>[
          'programme_id'=>$request->programme_id,
        ]
      ]
    );

    //Return JSON
    return response()->json(array('result'=>$data['main']),200);

  }

}
