<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Researcher\Portfolio\Organization\User\General\Information\Home;

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
    'item'=>'Position',
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
		$this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.user.view.general.information.';

    //Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.researcher.portfolio.organization.user.view.general.information.';

    //Set Route Link
    $this->route['link'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.user.';

    // //Set Navigation
		// $this->hyperlink['navigation'] = $this->navigation['hyperlink'];
    //
    // //Set Navigation
		// $this->page['main'] = $this->route['link'].'view.';
    //
    // $this->page['navigation']['header']['breadcrumb'] = $this->page['main'].'navigation.header.breadcrumb';
    // $this->page['navigation']['tab']['header'] = $this->page['main'].'navigation.tab.header.index';
    // $this->page['navigation']['tab']['main'] = $this->page['main'].'navigation.tab.content.main.index';
    // $this->page['navigation']['tab']['content'] = $this->route['link'].'view.general.information.list.';
    // $this->page['navigation']['tab']['right'] = $this->page['main'].'navigation.tab.content.navigation.right.index';
    //
		// //Set Hyperlink
    // $this->hyperlink['page']['list']['researcher'] = $this->route['link'].'list';
    //
    // //General Information - Researcher Position
    $this->hyperlink['page']['redirect'] = $this->route['name'].'position.list';
    // $this->hyperlink['page']['position']['new'] = $this->route['name'].'new';
    // $this->hyperlink['page']['position']['create'] = $this->route['name'].'create';
    // $this->hyperlink['page']['position']['delete'] = $this->route['name'].'delete';
    // $this->hyperlink['page']['position']['view'] = $this->route['name'].'view';
    // $this->hyperlink['page']['position']['update'] = $this->route['name'].'update';
    //
    // //Set Page Sub
    // $this->hyperlink['page']['navigation']['main'] = $this->route['link'].'navigation.';

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
      // if(($request->segment(11) == 'general' && $request->segment(12) == 'information')){
      if(($request->segment(11) == 'general_information')){


        if(!empty($request->segment(11))){

          //Return to Default Route
          return redirect()->route($hyperlink['page']['redirect'],[
              'organization_id' => $request->organization_id,
              'employee_id' => $request->employee_id
          ]);

        }
      }
//       // Set Breadcrumb Icon
//       $data['breadcrumb']['icon'] = '<i class="bi bi-person-workspace"></i>';
//
//       // Set Breadcrumb Title
//       $data['breadcrumb']['title'] = [$this->header['category'], $this->header['module'], 'Home'];
//
//       //Set Model Navigation Category
//       $model['navigation']['category']['main'] = new NavigationCategoryView();
//
//       //Get Navigation Category
//       $data['navigation']['category']['main'] = $model['navigation']['category']['main']->getList([
//           'column' => [
//               'category' => 'PORTAL',
//               'user_type' => strtoupper('administrator'),
//               'domain_url' => $request->root()
//           ]
//       ]);
//
//       //Set Model Navigation Category Sub
//       $model['navigation']['category']['sub'] = new NavigationCategorySubView();
//
//       //Get Navigation Category Sub
//       $data['navigation']['category']['sub'] = $model['navigation']['category']['sub']->getList(
//         [
//           'column'=>[
//             'category'=>'PORTAL',
//             'user_type'=>strtoupper('administrator'),
//             'navigation_category_code'=>strtoupper($request->tab_category),
//             'domain_url'=>$request->root()
//           ]
//         ]
//       );
//
//       //Set Model Resecher
//       $model['employee']['profile'] = new EmployeeProfileProcedure();
//
//       //Get Navigation Category
//       $data['main']['data'] = $model['employee']['profile']->readRecord(
//         [
//           'column' => [
//               'employee_id' => $request->employee_id
//           ]
//         ]
//       );
//
//       /*  Researcher Position
//      	**************************************************************************************/
//
//       //Set Table Researcher Position
//       $data['table']['column']['cervie']['researcher']['position'] = $this->getDataTable(
//         [
//           'category'=>'position'
//         ]
//       );
//
//       //Set Main Data Researcher Position
//       $data['main']['cervie']['researcher']['position'] = $this->getData(
//         [
//           'eloquent'=>'pagination',
//           'category'=>'position'
//         ]
//       );
//
//       //Set Page
//       $page = $this->page;
//       // $page['navigation']['tab']['header1'] = $page['main'].'navigation.tab.'.$request->segment(11).'.'.$request->segment(12);
//
// // dd($request->segment(11));
//   // dd($data);
//   // dd($page);
//       //Get Form Token
//       $form_token = $this->encrypt_token_form;
// // dd(1);
// // dd($this->route['view'].'list.index');
//       //Return View
//       return view($this->route['view'].'list.index', compact('data','page','form_token','hyperlink'));

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
