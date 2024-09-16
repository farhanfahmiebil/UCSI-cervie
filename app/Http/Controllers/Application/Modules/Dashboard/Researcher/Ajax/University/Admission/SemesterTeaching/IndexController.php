<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Ajax\University\Admission\SemesterTeaching;

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
  public function getSemester(Request $request) {

      try {
          // Get Model
          $model['semester'] = new Semester();

          // Set Data
          $data['main'] = $model['semester']->getSemesterByGroupAjax(
              [
                  'column' => [
                      'semester_group_id' => $request->semester_group_id,
                      'campus_id' => $request->campus_id
                  ]
              ]
          );

          // Return JSON
          return response()->json(['result' => $data['main']], 200);

      } catch (\Exception $e) {
          // Log the exception message
          \Log::error('Error in getSemester: ' . $e->getMessage());

          // Return JSON response with error message
          return response()->json([
              'error' => 'An error occurred while retrieving the data.',
              'message' => $e->getMessage()
          ], 500);
      }

  }


}
