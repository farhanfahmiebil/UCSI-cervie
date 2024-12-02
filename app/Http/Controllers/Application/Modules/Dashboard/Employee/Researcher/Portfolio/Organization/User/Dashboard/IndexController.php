<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Researcher\Portfolio\Organization\User\Dashboard;

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
use App\Models\UCSI_V2_General\MSSQL\View\RepresentationCategory AS RepresentationCategoryView;
use App\Models\UCSI_V2_General\MSSQL\View\RepresentationRole AS RepresentationRoleView;
use App\Models\UCSI_V2_General\MSSQL\View\CurrencyCode AS CurrencyCodeView;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherGrant AS CervieResearcherGrantView;
use App\Models\UCSI_V2_General\MSSQL\View\SustainableDevelopmentGoal AS SustainableDevelopmentGoalView;
use App\Models\UCSI_V2_Education\MSSQL\View\Status AS StatusView;
use App\Models\UCSI_V2_Education\MSSQL\View\Report AS ReportView;


//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\Researcher AS ResearcherProcedure;
use App\Models\UCSI_V2_Main\MSSQL\Procedure\EmployeeProfile AS EmployeeProfileProcedure;

//Model View
use App\Models\UCSI_V2_Education\MSSQL\View\Organization;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTableControl AS CervieResearcherTableControlProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherLog AS CervieResearcherLogProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherEvidence AS CervieResearcherEvidenceProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTeamMember AS CervieResearcherTeamMemberProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\Report AS ReportProcedure;

//Get Request
use Illuminate\Http\Request;

//Get Storage
use Storage;

//Get Validator
use Validator;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'employee';

	//Path Header
	protected $header = [
		'application'=>'Dashboard',
    'category'=>'Researcher Grant',
		'module'=>'Organization',
		'module_sub'=>'User',
    'item'=>'Grant',
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
		$this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.user.view.';

    //Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.researcher.portfolio.organization.user.view.dashboard.';

    //Set Route Link
    $this->route['link'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.user.';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Set Navigation
    $this->page['sub'] = $this->route['view'];

    //Set Navigation
		$this->page['main'] = $this->route['link'].'view.';

    $this->page['navigation']['header']['breadcrumb'] = $this->page['main'].'navigation.header.breadcrumb';
    $this->page['navigation']['tab']['header'] = $this->page['main'].'navigation.tab.header.index';
    $this->page['navigation']['tab']['main'] = $this->page['main'].'navigation.tab.content.main.index';
    $this->page['navigation']['tab']['pointer'] = '';
    $this->page['navigation']['tab']['content']['list'] = $this->route['view'].'list.index';
    $this->page['navigation']['tab']['content']['new'] = $this->route['view'].'new.index';
    $this->page['navigation']['tab']['content']['view'] = $this->route['view'].'view.index';
    $this->page['navigation']['tab']['right'] = $this->page['main'].'navigation.tab.content.navigation.right.index';

		//Set Hyperlink
    $this->hyperlink['page']['back'] = $this->route['link'].'list';

    //General Information - Researcher Grant
    $this->hyperlink['page']['list'] = $this->route['view'].'list';
    // $this->hyperlink['page']['new'] = $this->route['view'].'new';
    // $this->hyperlink['page']['create'] = $this->route['name'].'create';
    // $this->hyperlink['page']['delete']['main'] = $this->route['name'].'delete';
    // $this->hyperlink['page']['delete']['evidence'] = $this->route['name'].'evidence.delete';
    $this->hyperlink['page']['view'] = $this->route['name'];
    // $this->hyperlink['page']['update'] = $this->route['name'].'update';
    // $this->hyperlink['page']['delete']['team']['member'] = $this->route['name'].'team_member.delete';

    //Set Page Sub
    $this->hyperlink['page']['navigation']['main'] = $this->route['link'].'navigation.';

	}

  /**************************************************************************************
      List
  **************************************************************************************/
  public function list(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-person-workspace"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = [$this->header['category'], $this->header['module'],'Home'];


    //Set Model Navigation Category
    $model['navigation']['category']['main'] = new NavigationCategoryView();

    //Get Navigation Category
    $data['navigation']['category']['main'] = $model['navigation']['category']['main']->getList([
      'column'=>[
        'category'=>'PORTAL',
        'user_type'=>strtoupper('administrator'),
        'domain_url'=>$request->root()
      ]
    ]);

    //Set Model Navigation Category Sub
    $model['navigation']['category']['sub'] = new NavigationCategorySubView();

    //Get Navigation Category Sub
    $data['navigation']['category']['sub'] = $model['navigation']['category']['sub']->getList(
      [
        'column'=>[
          'category'=>'PORTAL',
          'user_type'=>strtoupper('administrator'),
          'navigation_category_code'=>'GRANT',
          'domain_url'=>$request->root()
        ]
      ]
    );

    //Set Model Researcher - Employee Profile
    $model['employee']['profile'] = new EmployeeProfileProcedure();

    //Get Employee Profile
    $data['employee']['profile'] = $model['employee']['profile']->readRecord(
      [
        'column'=>[
            'employee_id'=>$request->employee_id
        ]
      ]
    );

    //Set Table Researcher Log
    $data['table']['column']['cervie']['researcher']['log'] = $this->getDataTable(
      [
        'category'=>'log'
      ]
    );

    //Set Main Data Researcher Log
    $data['main']['cervie']['researcher']['log'] = $this->getData(
      [
        'eloquent'=>'pagination',
        'category'=>'log',
        'column'=>[
          'employee_id'=>$request->employee_id,
          'need_verification'=>1
        ]
      ]
    );

    //If Type Exist
		if($request->has('form_token')){
// dd($request->form_token,$this->encrypter->decrypt($request->form_token));
// dd($this->encrypter->decrypt($request->form_token));
			//Check Type Request
			switch($this->encrypter->decrypt($request->form_token)){

				//List Type
				case 'filter':
				case 'search':
				case 'sort':

					//Filter Category
					$filter['search'] = ($request->search != null)?$request->search:null;
          $filter['employee_id'] = ($request->employee_id != null)?['employee_id'=>$request->employee_id]:null;
					$filter['need_verification'] = ($request->need_verification != null)?['employee_id'=>$request->need_verification]:null;
					$filter['order']['ordercolumn'] = ($request->sorting_column != null)?$request->sorting_column:null;
					$filter['order']['orderby'] = ($request->sorting != null)?$request->sorting:null;

          //Set Main Data Researcher Grant
          $data['main']['cervie']['researcher']['grant'] = $this->getData(
            [
              'type'=>$this->encrypter->decrypt($request->form_token),
              'eloquent'=>'pagination',
              'column'=>$filter,
              'category'=>'grant'
            ]
          );

				break;

				//If Request Type Not Found
				default:

					//Return Failed
					return redirect($request->url)->with('alert_type','error')
																				->with('message','Execute Failed');

				break;

			}

		}

    //Set Page
    $page = $this->page;

    //Set Page Pointer
    $page['navigation']['tab']['pointer'] =  $page['navigation']['tab']['content']['list'];
    $page['sub'] .= 'list.sub';

    //Get Form Token
    $form_token = $this->encrypt_token_form;

    //Return View
    return view($this->route['link'].'view.navigation.content.list.index', compact('data','page','form_token','hyperlink'));

  }

  /**************************************************************************************
    Get Data
  **************************************************************************************/
  public function getData($data){

    //Check Data Category Exist
    if(!isset($data['category'])){abort(555,'Category Not Set');}

    //Set Model
    $model['cervie']['researcher']['log'] = new CervieResearcherLogProcedure();

    //Set Data
    $data = $model['cervie']['researcher']['log']->readRecordVerification(
      [
        'column'=>[
          'employee_id'=>$data['column']['employee_id'],
          'need_verification'=>$data['column']['need_verification']
        ]
      ]
    );

    return $data;

  }

  /**************************************************************************************
    Get Data Table
  **************************************************************************************/
  public function getDataTable($data){

    // Check Data Category Exist
    if(!isset($data['category'])){ abort(404); }

    // Defined Column
    $table = [
      0 => [
        'category' => 'checkbox',
        'checkbox' => '<div class="form-check">
                        <input type="checkbox" id="selectAll" name="id[]" class="form-check-input selectBox">
                       </div>',
        'icon' => '<i class="bi bi-check-all"></i>', // Updated icon for checkbox
        'name' => 'No',
      ],
      1 => [
        'icon' => '<i class="bi bi-x-circle"></i>', // Updated icon for No (assuming "No" should have a different icon)
        'name' => 'No',
      ],
      2 => [
        'icon' => '<i class="bi bi-table"></i>', // Updated icon for Table
        'name' => 'Table',
      ],
      3 => [
        'icon' => '<i class="bi bi-person-fill"></i>', // Updated icon for Created By
        'name' => 'Created By',
      ],
      4 => [
        'icon' => '<i class="bi bi-calendar-plus"></i>', // Updated icon for Created At
        'name' => 'Created At',
      ],
      5 => [
        'icon' => '<i class="bi bi-check-circle"></i>', // Updated icon for Verification
        'name' => 'Verification',
      ],
      6 => [
        'icon' => '<i class="bi bi-gear-fill"></i>', // Updated icon for Control
        'name' => 'Control',
      ]
    ];

    // Return Table
    return $table;

  }



}
