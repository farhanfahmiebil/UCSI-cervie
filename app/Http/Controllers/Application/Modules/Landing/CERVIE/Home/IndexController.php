<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Landing\CERVIE\Home;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Education\MSSQL\View\Organization AS OrganizationView;

//Get Request
use Illuminate\Http\Request;

//Get Storage


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
    $this->route['view'] = config('routing.'.$this->application.'.modules.landing.cervie.view').'.home.';

    //Set Route Name
    $this->route['name'] = config('routing.'.$this->application.'.modules.landing.cervie.name').'.home.';

    //Set Navigation
		$this->page['sub'] = $this->route['view'];

		//Set Image Route
		$this->asset['image'] = '/images/'.$this->application.'/modules/landing/cervie/pages/home/section/';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
    $this->hyperlink['page']['index'] = $this->route['view'].'index';
// dd($this->hyperlink['page']['index']);
	}

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

    $page = $this->page;

    $page['sub'] .= 'sub.';

    //Set Model Organization
    $model['organization'] = new OrganizationView();

    //Get Model Organization
    $data['organization'] = $model['organization']->selectBox(
      [
        'column'=>[
          'company_id'=>'UCSI_EDUCATION',
          'company_office_id'=>'MAIN_CAMPUS',
          'not_in_organization_id'=>['1','2','14','15']
        ]
      ]
    );

    $asset = $this->asset;
// dd($data['outlet']['menu']['item']);
    //Return View
    return view($this->route['view'].'.index',compact('data','asset','page','hyperlink'));

    // dd($check['exist']['outlet']);

  }

}
