<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Ajax\University\Users;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Education\MSSQL\Table\StudentProfile;

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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.ajax.university.users';

	}

	/**************************************************************************************
 		Check Student
 	**************************************************************************************/
	public function checkStudent(Request $request){

    //Get Model
    $model['student']['profile'] = new StudentProfile();

    //Set Data
    $data['main'] = $model['student']['profile']->getStudentAjax(
      [
        'column'=>[
          'student_id'=>$request->student_id,
        ]
      ]
    );

    //Return JSON
    return response()->json(array('result'=>$data['main']),200);

  }

}
