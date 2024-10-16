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

//Model

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
		$this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.home';

    //Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.researcher.portfolio.organization.home.';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
    $this->hyperlink['page']['list']['home'] = $this->route['name'];
    $this->hyperlink['page']['list']['researcher'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.researcher.portfolio.organization.user.list';

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

    //Set Model Organization
    $model['organization'] = new OrganizationView();

    //Get Model Organization
    $data['main']['data'] = $model['organization']->selectBox(
      [
        'column'=>[
          'company_id'=>'UCSI_EDUCATION',
          'company_office_id'=>'MAIN_CAMPUS',
          'not_in_organization_id'=>['1','2','14','15']
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
        'name'=>'Department',
      ],
      2=>[
        'class'=>'col-md-1',
        'icon'=>'<i class="bi bi-wrench-adjustable"></i>',
        'name'=>' Control',
      ]
    ];

    //Get Form Token
		$form_token = $this->encrypt_token_form;
// dd($data);
// dd($data['main']['data'] );
		//Return View
		return view($this->route['view'].'index',compact('data','form_token','hyperlink'));

  }

}
