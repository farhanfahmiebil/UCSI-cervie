<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Qualification\Home;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherAcademicQualification;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherProfessionalQualification;

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
    'category'=>'Qualification',
		'module'=>'Home',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.qualification.home.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.qualification.home.';
    $this->route['link'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.qualification.';

    //Set Navigation
		$this->page['sub'] = $this->route['view'];

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Academic Qualification
    $this->hyperlink['page']['qualification']['academic']['new'] = $this->route['link'].'academic.new';
    $this->hyperlink['page']['qualification']['academic']['view'] = $this->route['link'].'academic.view';
    $this->hyperlink['page']['qualification']['academic']['delete'] = $this->route['link'].'academic.delete';

    //Professional Qualification
    $this->hyperlink['page']['qualification']['professional']['new'] = $this->route['link'].'professional.new';
    $this->hyperlink['page']['qualification']['professional']['view'] = $this->route['link'].'professional.view';
    $this->hyperlink['page']['qualification']['professional']['delete'] = $this->route['link'].'professional.delete';

	}

	/**************************************************************************************
 		New
 	**************************************************************************************/
	public function new(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Page Sub
    $page = $this->page;

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-house"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = ['Welcome Back, '.Auth::user()->name];

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

		//Return View
		return view($this->route['view'].'new.index',compact('data','page','hyperlink'));

  }

  /**************************************************************************************
 		List
 	**************************************************************************************/
	public function list(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Page Sub
    $page = $this->page;

    $page['sub'] .= 'list.sub';

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-house"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = ['Welcome Back, '.Auth::user()->name];

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

    /*  Researcher Academic Qualification
   	**************************************************************************************/

    //Set Table Researcher Academic Qualification
    $data['table']['column']['cervie']['researcher']['qualification']['academic'] = $this->getDataTable(
      [
        'category'=>'qualification_academic'
      ]
    );

    //Set Main Data Researcher Position
    $data['main']['cervie']['researcher']['qualification']['academic'] = $this->getData(
      [
        'eloquent'=>'pagination',
        'category'=>'qualification_academic'
      ]
    );

    /*  Researcher Professional Qualification
   	**************************************************************************************/

    //Set Table Researcher Professional Qualification
    $data['table']['column']['cervie']['researcher']['qualification']['professional'] = $this->getDataTable(
      [
        'category'=>'qualification_professional'
      ]
    );

    //Set Main Data Researcher Professional Qualification
    $data['main']['cervie']['researcher']['qualification']['professional'] = $this->getData(
      [
        'eloquent'=>'pagination',
        'category'=>'qualification_professional'
      ]
    );

    // dd(count($data['main']['cervie']['researcher']['position']));
    //Get Form Token
		$form_token = $this->encrypt_token_form;

		//Return View
		return view($this->route['view'].'list.index',compact('data','form_token','page','hyperlink'));

  }

  public function getDataTable($data){

    //Check Data Category Exist
    if(!isset($data['category'])){
      abort(404);
    }

    switch($data['category']){

      //Qualification Academic
      case 'qualification_academic':

        //Defined Column
        $table = [
          0=>[
            'icon'=>'<i class="mdi mdi-numeric"></i>',
            'name'=>'No',
          ],
          1=>[
            'icon'=>'<i class="mdi mdi-school"></i>',
            'name'=>' Qualification',
          ],
          2=>[
            'icon'=>'<i class="mdi mdi-school"></i>',
            'name'=>' University/College/Other',
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

      //Qualification Professional
      case 'qualification_professional':

        //Defined Column
        $table = [
          0=>[
            'icon'=>'<i class="mdi mdi-numeric"></i>',
            'name'=>'No',
          ],
          1=>[
            'icon'=>'<i class="mdi mdi-school"></i>',
            'name'=>' Qualification',
          ],
          2=>[
            'icon'=>'<i class="mdi mdi-shield-check"></i>',
            'name'=>' Verification',
          ],
          3=>[
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

  public function getData($data){

    //Check Data Category Exist
    if(!isset($data['category'])){abort(555,'Category Not Set');}

    //Get Category
    switch($data['category']){

      //Qualification Academic
      case 'qualification_academic':

        //Set Model
        $model['cervie']['researcher']['qualification']['academic'] = new CervieResearcherAcademicQualification();

        //Set Data
        $data = $model['cervie']['researcher']['qualification']['academic']->getList(
          [
            'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
            'column'=>[
              'employee_id'=>((Auth::id())?Auth::id():Auth::id())
            ]
          ]
        );

      break;

      //Qualification Professional
      case 'qualification_professional':

        //Set Model
        $model['cervie']['researcher']['qualification']['professional'] = new CervieResearcherProfessionalQualification();

        //Set Data
        $data = $model['cervie']['researcher']['qualification']['professional']->getList(
          [
            'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
            'column'=>[
              'employee_id'=>((Auth::id())?Auth::id():Auth::id())
            ]
          ]
        );

      break;

      default:
        // code...
      break;
    }

    //Return Data
    return $data;

  }

}
