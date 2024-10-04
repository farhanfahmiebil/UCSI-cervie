<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\General\Information\Home;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherPosition;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherAreaInterest;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherWorkExperience;

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
    'category'=>'Publication',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.general.information.home.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.general.information.home.';
    $this->route['link'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.general.information.';

    //Set Navigation
		$this->page['sub'] = $this->route['view'];

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Position
    $this->hyperlink['page']['position']['new'] = $this->route['link'].'position.new';
    $this->hyperlink['page']['position']['view'] = $this->route['link'].'position.view';
    $this->hyperlink['page']['position']['delete'] = $this->route['link'].'position.delete';

    //Area Interest
    $this->hyperlink['page']['area']['interest']['new'] = $this->route['link'].'area.interest.new';
    $this->hyperlink['page']['area']['interest']['view'] = $this->route['link'].'area.interest.view';
    $this->hyperlink['page']['area']['interest']['delete'] = $this->route['link'].'area.interest.delete';

    //Work Experience
    $this->hyperlink['page']['work']['experience']['new'] = $this->route['link'].'work.experience.new';
    $this->hyperlink['page']['work']['experience']['view'] = $this->route['link'].'work.experience.view';
    // $this->hyperlink['page']['new'] = $this->route['name'].'.new';
    // $this->hyperlink['page']['create'] = $this->route['name'].'.create';
    // $this->hyperlink['page']['delete'] = $this->route['name'].'.delete';

		//Set Hyperlink
    // $this->hyperlink['page']['ajax']['navigation']['access']['module']['company'] = config('routing.application.modules.dashboard.'.$this->user.'.name').'.ajax.authorization.access.module.company';
// application.modules.dashboard.researcher.general.information.work.experience.new
// application.modules.dashboard.researcher.general.information.work.experience.new
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
        'category'=>'position'
      ]
    );

    /*  Researcher Area Interest
   	**************************************************************************************/

    //Set Table Researcher Area Interest
    $data['table']['column']['cervie']['researcher']['area']['interest'] = $this->getDataTable(
      [
        'category'=>'area_interest'
      ]
    );

    //Set Main Data Researcher Area Interest
    $data['main']['cervie']['researcher']['area']['interest'] = $this->getData(
      [
        'category'=>'area_interest'
      ]
    );

    /*  Researcher Work Experience
   	**************************************************************************************/

    //Set Table Researcher Work Experience
    $data['table']['column']['cervie']['researcher']['work']['experience'] = $this->getDataTable(
      [
        'category'=>'work_experience'
      ]
    );

    //Set Main Data Researcher Area Interest
    $data['main']['cervie']['researcher']['work']['experience'] = $this->getData(
      [
        'category'=>'work_experience'
      ]
    );
// dd($data['main']['cervie']['researcher']['position']);
// foreach($data['main']['cervie']['researcher']['position'] as $key=>$value){
//   dd($value);
// }



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

      //Position
      case 'position':

        //Defined Column
        $table = [
          0=>[
            'icon'=>'<i class="mdi mdi-numeric"></i>',
            'name'=>'No',
          ],
          1=>[
            'class'=>'col-md-2',
            'icon'=>'<i class="mdi mdi-account-card-details"></i>',
            'name'=>' Position',
          ],
          2=>[
            'class'=>'col-md-4',
            'icon'=>'<i class="mdi mdi-city"></i>',
            'name'=>' Faculty/Industry/Department',
          ],
          3=>[
            'icon'=>'<i class="mdi mdi-flag"></i>',
            'name'=>' Status',
          ],
          4=>[
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
            'class'=>'<i class="mdi mdi-numeric"></i>',
            'name'=>'No',
          ],
          1=>[
            'class'=>'col-md-8',
            'icon'=>'<i class="mdi mdi-account-card-details"></i>',
            'name'=>' Field of Research',
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
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Control',
          ]
        ];

      break;

      default:
        // code...
      break;
    }

    return $table;

  }

  public function getData($data){

    //Check Data Category Exist
    if(!isset($data['category'])){
      abort(404);
    }

    switch($data['category']){

      //Position
      case 'position':

        //Set Model
        $model['cervie']['researcher']['position'] = new CervieResearcherPosition();

        //Set Data
        $data = $model['cervie']['researcher']['position']->getList(
          [
            'column'=>[
              'employee_id'=>((Auth::id())?Auth::id():Auth::id())
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
            'column'=>[
              'employee_id'=>((Auth::id())?Auth::id():Auth::id())
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

    return $data;

  }

}
