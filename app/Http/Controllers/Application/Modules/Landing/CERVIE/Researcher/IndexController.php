<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Landing\CERVIE\Researcher;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model ResearcherProcedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\Researcher AS ResearcherProcedure;


//Get Request
use Illuminate\Http\Request;

//Get Storage
use Storage;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //Module
  protected $module = [
    'main'=>'outlet',
    'sub'=>'table'
  ];

	//Path Header
	protected $header = [
		'category'=>'Landing',
		'module'=>'',
		'sub'=>'',
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
    $this->route['view'] = config('routing.'.$this->application.'.modules.landing.cervie.view').'.researcher.';

    //Set Route Name
    $this->route['name'] = config('routing.'.$this->application.'.modules.landing.cervie.name').'.researcher.';

    //Set Navigation
		$this->page['sub'] = $this->route['view'];

		//Set Image Route
		$this->asset['image'] = '/images/'.$this->application.'/modules/landing/cervie/pages/researcher/section/';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
    $this->hyperlink['page']['index'] = $this->route['view'].'index';
// dd($this->hyperlink['page']['index']);
	}



  /**************************************************************************************
 		View
 	**************************************************************************************/
	public function view(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

    $page = $this->page;

    $page['sub'] .= 'view.sub.';

    //Set Model Researcher
    $model['researcher'] = new ResearcherProcedure();

    //Get Model Researcher
    $data['researcher']['main'] = $model['researcher']->readRecord(
      [
        'column'=>[
          'employee_id'=>$request->employee_id
        ]
      ]
    );

    $asset = $this->asset;

    //Set Asset
    $asset['avatar'] = '/storage/resources/researcher/'.$request->employee_id.'/avatar/';
// dd($asset['avatar']);
    //Set Document
    // $hyperlink['document'] = $request->root().'/public/storage/resources/researcher/'.trim(Auth::id()).'/document/professional_membership/'.$request->id.'/';
// dd($data['researcher']['main']->full_name);
    //Return View
    return view($this->route['view'].'view.index',compact('data','asset','page','hyperlink'));

    // dd($check['exist']['outlet']);

  }

}
