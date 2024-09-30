<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Home;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_General\MSSQL\Table\Campus;
use App\Models\UCSI_V2_General\MSSQL\Table\Company;
// use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeUserAccessModule;
// use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeUserAccessModuleSub;
// use App\Models\UCSI_V2_General\MSSQL\Table\CompanySystemModuleCategory;
// use App\Models\UCSI_V2_General\MSSQL\Table\CompanySystemModuleCategory;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'researcher';

  //Path Header
	protected $header = [
		'application'=>'Dashboard',
    'category'=>'Home',
		'module'=>'',
		'module_sub'=>'',
    'item'=>'',
		'gate'=>''
	];

	//Route Link
	protected $route;

	//Page
	public $page;

	//Hyperlink
	public $hyperlink;

	/**************************************************************************************
		Route Path
	**************************************************************************************/
	public function routePath(){

		//Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.home.';

    //Set Navigation
		$this->page['sub'] = $this->route['view'].'sub';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];


		//Set Hyperlink
    // $this->hyperlink['page']['ajax']['navigation']['access']['module']['company'] = config('routing.application.modules.dashboard.'.$this->user.'.name').'.ajax.authorization.access.module.company';

	}

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Page Sub
    $page = $this->page;

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-house"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = ['Welcome,'];

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

		//Return View
		return view($this->route['view'].'index',compact('data','page','hyperlink'));

  }

}
