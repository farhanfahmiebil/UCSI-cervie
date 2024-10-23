<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Intellectual\Property\Home;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model View
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherPatent AS CervieResearcherPatentView;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherLicensing AS CervieResearcherLicensingView;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherCopyright AS CervieResearcherCopyrightView;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherTrademark AS CervieResearcherTrademarkView;

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
    'category'=>'Intellectual Property',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.intellectual.property.home.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.intellectual.property.home.';
    $this->route['link'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.intellectual.property.';

    //Set Navigation
		$this->page['sub'] = $this->route['view'];

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Position
    $this->hyperlink['page']['patent']['new'] = $this->route['link'].'patent.new';
    $this->hyperlink['page']['patent']['view'] = $this->route['link'].'patent.view';
    $this->hyperlink['page']['patent']['delete'] = $this->route['link'].'patent.delete';

    //Area Interest
    $this->hyperlink['page']['licensing']['new'] = $this->route['link'].'licensing.new';
    $this->hyperlink['page']['licensing']['view'] = $this->route['link'].'licensing.view';
    $this->hyperlink['page']['licensing']['delete'] = $this->route['link'].'licensing.delete';

    //Work Experience
    $this->hyperlink['page']['copyright']['new'] = $this->route['link'].'copyright.new';
    $this->hyperlink['page']['copyright']['view'] = $this->route['link'].'copyright.view';
    $this->hyperlink['page']['copyright']['delete'] = $this->route['link'].'copyright.delete';

    //Work Experience
    $this->hyperlink['page']['trademark']['new'] = $this->route['link'].'trademark.new';
    $this->hyperlink['page']['trademark']['view'] = $this->route['link'].'trademark.view';
    $this->hyperlink['page']['trademark']['delete'] = $this->route['link'].'trademark.delete';
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

    /*  Researcher Patent
   	**************************************************************************************/

    //Set Table Researcher Patent
    $data['table']['column']['cervie']['researcher']['patent'] = $this->getDataTable(
      [
        'category'=>'patent'
      ]
    );

    //Set Main Data Researcher Patent
    $data['main']['cervie']['researcher']['patent'] = $this->getData(
      [
        'eloquent'=>'pagination',
        'category'=>'patent'
      ]
    );

    /*  Researcher Licensing
   	**************************************************************************************/

    // Set Table Researcher Licensing
    $data['table']['column']['cervie']['researcher']['licensing'] = $this->getDataTable(
      [
        'category'=>'licensing'
      ]
    );

    // Set Main Data Researcher Licensing
    $data['main']['cervie']['researcher']['licensing'] = $this->getData(
      [
        'eloquent'=>'pagination',
        'category'=>'licensing'
      ]
    );

    /*  Researcher Copyright
   	**************************************************************************************/

    //Set Table Researcher Copyright
    $data['table']['column']['cervie']['researcher']['copyright'] = $this->getDataTable(
      [
        'category'=>'copyright'
      ]
    );

    // Set Main Data Researcher Copyright
    $data['main']['cervie']['researcher']['copyright'] = $this->getData(
      [
        'eloquent'=>'pagination',
        'category'=>'copyright'
      ]
    );

    /*  Researcher Professional Membership
    **************************************************************************************/

    //Set Table Researcher Copyright
    $data['table']['column']['cervie']['researcher']['trademark'] = $this->getDataTable(
      [
        'category'=>'trademark'
      ]
    );

    // Set Main Data Researcher Copyright
    $data['main']['cervie']['researcher']['trademark'] = $this->getData(
      [
        'eloquent'=>'pagination',
        'category'=>'trademark'
      ]
    );


    //Get Form Token
		$form_token = $this->encrypt_token_form;

		//Return View
		return view($this->route['view'].'list.index',compact('data','form_token','page','hyperlink'));

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
      case 'patent':

        //Defined Column
        $table = [
          0=>[
            'icon'=>'<i class="mdi mdi-numeric"></i>',
            'name'=>'No',
          ],
          1=>[
            'icon'=>'<i class="mdi mdi-account-card-details"></i>',
            'name'=>' Patent Title',
          ],
          2=>[
            'icon'=>'<i class="mdi mdi-city"></i>',
            'name'=>' Date Filled',
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

      //Area Interest
      case 'licensing':

        //Defined Column
        $table = [

          0=>[
            'icon'=>'<i class="mdi mdi-numeric"></i>',
            'name'=>'No',
          ],
          1=>[
            'icon'=>'<i class="mdi mdi-account-card-details"></i>',
            'name'=>' Licensing Title',
          ],
          2=>[
            'icon'=>'<i class="mdi mdi-calendar"></i>',
            'name'=>' Date Start',
          ],
          3=>[
            'icon'=>'<i class="mdi mdi-calendar"></i>',
            'name'=>' Date End',
          ],
          4=>[
            'icon'=>'<i class="mdi mdi-shield-check"></i>',
            'name'=>' Verification',
          ],
          5=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Control',
          ]
        ];

      break;

      //Copyright
      case 'copyright':

        //Defined Column
        $table = [
          0=>[
            'icon'=>'<i class="mdi mdi-numeric"></i>',
            'name'=>'No',
          ],
          1=>[
            'class'=>'col-md-5',
            'icon'=>'<i class="mdi mdi-account-card-details"></i>',
            'name'=>' Copyright Title',
          ],
          2=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Date Filed',
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

      //Trademark
      case 'trademark':

      //Copyright
      case 'copyright':

        //Defined Column
        $table = [
          0=>[
            'icon'=>'<i class="mdi mdi-numeric"></i>',
            'name'=>'No',
          ],
          1=>[
            'class'=>'col-md-5',
            'icon'=>'<i class="mdi mdi-account-card-details"></i>',
            'name'=>' Trademark Title',
          ],
          2=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Date Filed',
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

      //Patent
      case 'patent':

        //Set Model
        $model['cervie']['researcher']['patent'] = new CervieResearcherPatentView();

        //Set Data
        $data = $model['cervie']['researcher']['patent']->getList(
          [
            'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
            'column'=>[
              'employee_id'=>Auth::id()
            ]
          ]
        );

      break;

      //Area Interest
      case 'licensing':

        //Set Model
        $model['cervie']['researcher']['licensing'] = new CervieResearcherLicensingView();

        //Set Data
        $data = $model['cervie']['researcher']['licensing']->getList(
          [
            'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
            'column'=>[
              'employee_id'=>Auth::id()
            ]
          ]
        );

      break;

      //Copyright
      case 'copyright':

        //Set Model
        $model['cervie']['researcher']['copyright'] = new CervieResearcherCopyrightView();

        //Set Data
        $data = $model['cervie']['researcher']['copyright']->getList(
          [
            'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
            'column'=>[
              'employee_id'=>Auth::id()
            ]
          ]
        );

      break;

      //Professional membership
      case 'trademark':

      //Set Model
      $model['cervie']['researcher']['trademark'] = new CervieResearcherTrademarkView();

      //Set Data
      $data = $model['cervie']['researcher']['trademark']->getList(
        [
          'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
          'column'=>[
            'employee_id'=>Auth::id()
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
