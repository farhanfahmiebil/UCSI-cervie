<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Insight\home;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_General\MSSQL\Table\AgreementType;
use App\Models\UCSI_V2_General\MSSQL\Table\AgreementLevel;
use App\Models\UCSI_V2_General\MSSQL\Table\LinkageCategory;
use App\Models\UCSI_V2_General\MSSQL\Table\Country;
use App\Models\UCSI_V2_Education\MSSQL\Table\CervieResearcherLinkage;
use App\Models\UCSI_V2_Education\MSSQL\Table\CervieResearcherEvidence;

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
    'category'=>'Linkage',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.insight.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.insight.';

    //Set Navigation
		$this->page['sub'] = $this->route['view'];

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Set Hyperlink
    $this->hyperlink['page']['home'] = $this->route['name'].'home';

		//Set Hyperlink
    // $this->hyperlink['page']['ajax']['navigation']['access']['module']['company'] = config('routing.application.modules.dashboard.'.$this->user.'.name').'.ajax.authorization.access.module.company';

	}

	/**************************************************************************************
 		Home
 	**************************************************************************************/
	public function index(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Page Sub
    $page = $this->page;
    $page['sub'] .= 'home.sub.';

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-house"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = ['Welcome Back, '.Auth::user()->name];

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

    // //Set Model
    // $model['general']['agreement']['level'] = new AgreementLevel();
    // $model['general']['agreement']['type'] = new AgreementType();
    // $model['general']['linkage']['category'] = new LinkageCategory();
    // $model['general']['country'] = new Country();
    //
    // //Get Data
    // $data['general']['agreement']['level'] = $model['general']['agreement']['level']->selectBox();
    // $data['general']['agreement']['type'] = $model['general']['agreement']['type']->selectBox();
    // $data['general']['linkage']['category'] = $model['general']['linkage']['category']->selectBox();
    // $data['general']['country'] = $model['general']['country']->selectBox();

		//Return View
		return view($this->route['view'].'home.index',compact('data','page','hyperlink'));

  }


}
