<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Ajax\University\Admission\Registration;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Education\MSSQL\Table\Semester;
use App\Models\UCSI_V2_Education\MSSQL\Table\StudentCourseRegistration;
use App\Models\UCSI_V2_Education\MSSQL\Table\SemesterTeaching;
use App\Models\UCSI_V2_Education\MSSQL\Table\SemesterGroup;

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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.ajax.university.admission';

	}

	/**************************************************************************************
 		Check Student
 	**************************************************************************************/
	public function getSemester(Request $request){

    //Get Model
    $model['semester'] = new Semester();

    //Set Data
    $data['main'] = $model['semester']->getStudentSemesterAjax(
      [
        'column'=>[
          'student_id'=>$request->student_id,
        ]
      ]
    );

    //Return JSON
    return response()->json(array('result'=>$data['main']),200);

  }

  /**************************************************************************************
    Delete Subject
  **************************************************************************************/
  public function deleteSubject(Request $request){

    //Get Model
    $model['student']['course']['registration'] = new StudentCourseRegistration();

    //Set Data
    $data['main'] = $model['student']['course']['registration']->checkExist(
      [
        'column'=>[
          'student_id'=>$request->student_id,
          'course_id'=>$request->course_id,
          'employee_id'=>$request->employee_id,
          'semester_id'=>$request->semester_id
        ]
      ]
    );

    // dd($data['main']);asdsad

    // dd($data['main']->first());

    //Check if exist then delete
    if($data['main']){
      //Delete
      $data['main']->delete();

      //Return true
      $result = true;
    }else{

      //Return false
      $result = false;
    }

    //Return JSON
    return response()->json(array('result'=>$result),200);

  }

  /**************************************************************************************
    Get Semester Teaching
  **************************************************************************************/
  public function getSemesterTeaching(Request $request){

    //Get Model
    $model['semester']['teaching'] = new SemesterTeaching();

    //Set Data
    $data['main'] = $model['semester']['teaching']->selectBoxAjax(
      [
        'column'=>[
          // 'student_id'=>$request->student_id,
          // 'course_id'=>$request->course_id,
          // 'employee_id'=>$request->employee_id,
          'semester_id'=>$request->semester_id
          // 'query'=>'first'
        ]
      ]
    );

    //Return JSON
    return response()->json(array('result'=>$data['main']),200);

  }


}
