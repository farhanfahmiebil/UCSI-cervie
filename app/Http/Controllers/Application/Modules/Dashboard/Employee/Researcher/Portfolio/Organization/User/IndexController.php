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
    $this->hyperlink['page']['researcher']['view'] = $this->route['name'].'view';


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

}
