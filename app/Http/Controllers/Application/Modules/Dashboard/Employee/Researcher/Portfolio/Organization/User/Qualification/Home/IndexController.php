<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Researcher\Portfolio\Organization\User\Qualification\Home;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model View
use App\Models\UCSI_V2_Access\MSSQL\View\NavigationCategory AS NavigationCategoryView;
use App\Models\UCSI_V2_Access\MSSQL\View\NavigationCategorySub AS NavigationCategorySubView;
use App\Models\UCSI_V2_Education\MSSQL\View\Researcher AS ResearcherView;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherPosition AS CervieResearcherPositionView;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\Researcher AS ResearcherProcedure;
use App\Models\UCSI_V2_Main\MSSQL\Procedure\EmployeeProfile AS EmployeeProfileProcedure;

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
		'application'=>'Dashboard',
    'category'=>'Researcher Qualification',
		'module'=>'Organization',
		'module_sub'=>'User',
    'item'=>'Qualification',
		'gate'=>''
	];

	//Set Route
	protected $route;

	//Set Page
	public $page;

	//Set Hyperlink
	public $hyperlink;

	/**************************************************************************************
		Route Path
	**************************************************************************************/
	public function routePath(){

		//Set Route Name
		$this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.user.view.qualification.';

    //Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.researcher.portfolio.organization.user.view.qualification.';

    //Set Route Link
    $this->route['link'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.user.';

    // //General Information - Researcher Position
    $this->hyperlink['page']['redirect'] = $this->route['name'].'qualification.list';

	}

  /**************************************************************************************
      List
  **************************************************************************************/
  public function list(Request $request){

      //Get Route Path
      $this->routePath();

      //Set Hyperlink
      $hyperlink = $this->hyperlink;

      //Check If Not Empty
      if(($request->segment(11) == 'qualification')){

        if(!empty($request->segment(13))){

          //Return to Default Route
          return redirect()->route($hyperlink['page']['redirect'],[
              'organization_id' => $request->organization_id,
              'employee_id' => $request->employee_id
          ]);

        }
      }

  }


  /**************************************************************************************
    Get Data Table
  **************************************************************************************/
  public function getDataTable($data){

    //Check Data Category Exist
    if(!isset($data['category'])){abort(404);}

    //Get Data Category
    switch($data['category']){

      //Position
      case 'academic':

        //Defined Column
        $table = [
          0=>[
            'icon'=>'<i class="mdi mdi-numeric"></i>',
            'name'=>'No',
          ],
          1=>[
            'icon'=>'<i class="mdi mdi-account-card-details"></i>',
            'name'=>' Position',
          ],
          2=>[
            'icon'=>'<i class="mdi mdi-city"></i>',
            'name'=>' Faculty/Industry/Department',
          ],
          3=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Period',
          ],
          5=>[
            'icon'=>'<i class="mdi mdi-shield-check"></i>',
            'name'=>' Verification',
          ],
          6=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Control',
          ]
        ];

      break;

      //Area Interest
      case 'professional':

        //Defined Column
        $table = [

          0=>[
            'icon'=>'<i class="mdi mdi-numeric"></i>',
            'name'=>'No',
          ],
          1=>[
            'class'=>'col-md-8',
            'icon'=>'<i class="mdi mdi-account-card-details"></i>',
            'name'=>' Area Interest',
          ],
          3=>[
            'icon'=>'<i class="mdi mdi-shield-check"></i>',
            'name'=>' Verification',
          ],
          2=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Control',
          ]
        ];

      break;

      default:
        // code...
      break;
    }

    //Return Table
    return $table;

  }

  /**************************************************************************************
    Get Data
  **************************************************************************************/
  public function getData($data){

    //Check Data Category Exist
    if(!isset($data['category'])){abort(555,'Category Not Set');}

    //Get Category
    switch($data['category']){

      //Academic
      case 'academic':

        //Set Model
        $model['cervie']['researcher']['qualification']['academic'] = new CervieResearcherAcademicQualificationView();

        //Set Data
        $data = $model['cervie']['researcher']['qualification']['academic']->getList(
          [
            'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
            'column'=>[
              'employee_id'=>Auth::id()
            ]
          ]
        );

      break;

      //Professional
      case 'professional':

        //Set Model
        $model['cervie']['researcher']['qualification']['professional'] = new CervieResearcherProfessionalQualification();

        //Set Data
        $data = $model['cervie']['researcher']['qualification']['professional']->getList(
          [
            'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
            'column'=>[
              'employee_id'=>Auth::id()
            ]
          ]
        );

      break;

      default:
        // code...
      break;

    }

    return $data;

  }

}
