<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Researcher\Portfolio\Organization\User;

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
    'category'=>'Researcher Porfolio',
		'module'=>'Organization',
		'module_sub'=>'User',
    'item'=>'',
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

		//Set Route Name
		$this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.user.';

    //Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.researcher.portfolio.organization.user.';

    //Set Route Link
    $this->route['link'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
    $this->hyperlink['page']['list']['home'] = $this->route['link'].'home';
    $this->hyperlink['page']['researcher']['list'] = $this->route['name'].'list';
    $this->hyperlink['page']['researcher']['view'] = $this->route['name'].'view';

    //General Information - Researcher Position
    $this->hyperlink['page']['position']['new'] = $this->route['name'].'new';
    $this->hyperlink['page']['position']['create'] = $this->route['name'].'create';
    $this->hyperlink['page']['position']['delete'] = $this->route['name'].'delete';
    $this->hyperlink['page']['position']['view'] = $this->route['name'].'view';
    $this->hyperlink['page']['position']['update'] = $this->route['name'].'update';

    //General Information - Researcher Position
    $this->hyperlink['page']['position']['new'] = $this->route['name'].'new';
    $this->hyperlink['page']['position']['create'] = $this->route['name'].'create';
    $this->hyperlink['page']['position']['delete'] = $this->route['name'].'delete';
    $this->hyperlink['page']['position']['view'] = $this->route['name'].'view';
    $this->hyperlink['page']['position']['update'] = $this->route['name'].'update';

    //Set Page Sub
    $this->hyperlink['page']['navigation']['main'] = $this->route['view'].'view.navigation.';

	}

	/**************************************************************************************
 		List
 	**************************************************************************************/
	public function list(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    // Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-person-workspace"></i>';

    // Set Breadcrumb Title
    $data['breadcrumb']['title'] = [$this->header['category'],$this->header['module'],'Home'];

    //Set Model Researcher
    $model['researcher'] = new ResearcherView();

    //Get Model Researcher
    $data['main']['data'] = $model['researcher']->getList(
      [
        'eloquent'=>'pagination',
        'column'=>[
          'organization_id'=>$request->organization_id
        ]
      ]
    );

    //Defined Column
    $data['table']['column']['main'] = [
      0=>[
        'icon'=>'<i class="bi bi-123"></i>',
        'name'=>'No',
      ],
      1=>[
        'icon'=>'<i class="bi bi-building"></i>',
        'name'=>'Employee ID',
      ],
      2=>[
        'icon'=>'<i class="bi bi-building"></i>',
        'name'=>'Employee Name',
      ],
      3=>[
        'class'=>'col-md-1',
        'icon'=>'<i class="bi bi-wrench-adjustable"></i>',
        'name'=>' Control',
      ]
    ];

    //Get Form Token
		$form_token = $this->encrypt_token_form;

		//Return View
		return view($this->route['view'].'list.index',compact('data','form_token','hyperlink'));

  }

  /**************************************************************************************
    View
**************************************************************************************/
public function view(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Check If Not Empty
    if(empty($request->tab_category)){
        //Return to Default Route
        return redirect()->route($hyperlink['page']['view'],[
            'organization_id' => $request->organization_id,
            'tab' => 'tab',
            'id' => $request->id,
            'tab_category' => 'personal',
            'tab_category_sub' => 'position'
        ]);
    }

    // Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-person-workspace"></i>';

    // Set Breadcrumb Title
    $data['breadcrumb']['title'] = [$this->header['category'], $this->header['module'], 'Home'];

    //Set Model Navigation Category
    $model['navigation']['category']['main'] = new NavigationCategoryView();

    //Get Navigation Category
    $data['navigation']['category']['main'] = $model['navigation']['category']['main']->getList([
        'column' => [
            'category' => 'PORTAL',
            'user_type' => strtoupper('administrator'),
            'domain_url' => $request->root()
        ]
    ]);

    //Set Model Resecher
    $model['employee']['profile'] = new EmployeeProfileProcedure();

    //Get Navigation Category
    $data['main']['data'] = $model['employee']['profile']->readRecord([
        'column' => [
            'employee_id' => $request->id
        ]
    ]);

    //Get Tab Category and Tab Category Sub Data
    $tabCategoryData = $this->getTabCategory($request);
    $tabCategorySubData = $this->getTabCategorySub($request);

    //Merge Tab Category and Sub Data into $data
    if ($tabCategoryData) {
        $data = array_merge_recursive($data, $tabCategoryData);
    }

    if ($tabCategorySubData) {
        $data['navigation']['category']['sub'] = $tabCategorySubData;
    }
// dd($data);
    //Get Form Token
    $form_token = $this->encrypt_token_form;

    //Return View
    return view($this->route['view'] . 'view.index', compact('data', 'form_token', 'hyperlink'));

}

  public function getTabCategory(Request $request){

    //Get Tab Category
    switch($request->tab_category){

      //General Information
      case 'general_information':

        /*  Researcher Position
       	**************************************************************************************/

        //Set Table Researcher Position
        $data['table']['column']['cervie']['researcher']['position'] = $this->getDataTable(
          [
            'category'=>'position'
          ]
        );

        //Set Main Data Researcher Position
        $data['main']['cervie']['researcher']['position'] = $this->getData(
          [
            'eloquent'=>'pagination',
            'category'=>'position'
          ]
        );

        //Set Model Position
        $model['cervie']['researcher']['position'] = new CervieResearcherPositionView();

        //Set Model Position
        $data['main']['cervie']['researcher']['position'] = $model['cervie']['researcher']['position']->getList(
          [
            'column'=>[
              'employee_id'=>$request->id
            ]
          ]
        );

      default:
        // code...
      break;

    }

    //Return Data
    return $data;

  }


  public function getTabCategorySub(Request $request){

    if($request->tab_category_sub){

      //Set Model Navigation Category Sub
      $model['navigation']['category']['sub'] = new NavigationCategorySubView();

      //Get Navigation Category Sub
      $result = $model['navigation']['category']['sub']->getList(
        [
          'column'=>[
            'category'=>'PORTAL',
            'user_type'=>strtoupper('administrator'),
            'navigation_category_code'=>strtoupper($request->tab_category),
            'domain_url'=>$request->root()
          ]
        ]
      );

      return $result;
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
      case 'position':

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
      case 'area_interest':

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

      //Work Experience
      case 'work_experience':

        //Defined Column
        $table = [
          0=>[
            'icon'=>'<i class="mdi mdi-numeric"></i>',
            'name'=>'No',
          ],
          1=>[
            'class'=>'col-md-5',
            'icon'=>'<i class="mdi mdi-account-card-details"></i>',
            'name'=>' Company',
          ],
          2=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Period',
          ],
          3=>[
            'icon'=>'<i class="mdi mdi-shield-check"></i>',
            'name'=>' Verification',
          ],
          4=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Control',
          ]
        ];

      break;

      //Professional Membership
      case 'professional_membership':

        //Defined Column
        $table = [
          0=>[
            'icon'=>'<i class="mdi mdi-numeric"></i>',
            'name'=>'No',
          ],
          1=>[
            'class'=>'col-*',
            'icon'=>'<i class="mdi mdi-account-card-details"></i>',
            'name'=>' Name',
          ],
          2=>[
            'class'=>'col-*',
            'icon'=>'<i class="mdi mdi-account-card-details"></i>',
            'name'=>' Role',
          ],
          3=>[
            'icon'=>'<i class="mdi mdi-account-card-details"></i>',
            'name'=>' Level',
          ],
          4=>[
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

      //Position
      case 'position':

        //Set Model
        $model['cervie']['researcher']['position'] = new CervieResearcherPositionView();

        //Set Data
        $data = $model['cervie']['researcher']['position']->getList(
          [
            'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
            'column'=>[
              'employee_id'=>Auth::id()
            ]
          ]
        );

      break;

      //Area Interest
      case 'area_interest':

        //Set Model
        $model['cervie']['researcher']['area']['interest'] = new CervieResearcherAreaInterest();

        //Set Data
        $data = $model['cervie']['researcher']['area']['interest']->getList(
          [
            'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
            'column'=>[
              'employee_id'=>Auth::id()
            ]
          ]
        );

      break;

      //Work Experience
      case 'work_experience':

        //Set Model
        $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperience();

        //Set Data
        $data = $model['cervie']['researcher']['work']['experience']->getList(
          [
            'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
            'column'=>[
              'employee_id'=>Auth::id()
            ]
          ]
        );

      break;

      //Professional membership
      case 'professional_membership':

        //Set Model
        $model['cervie']['researcher']['professional']['membership'] = new CervieResearcherProfessionalMembership();

        //Set Data
        $data = $model['cervie']['researcher']['professional']['membership']->getList(
          [
            'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
            'column'=>[
              'employee_id'=>Auth::id(),
              'professional_membership_level_id'=>$data['column']['professional_membership_level_id']
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
