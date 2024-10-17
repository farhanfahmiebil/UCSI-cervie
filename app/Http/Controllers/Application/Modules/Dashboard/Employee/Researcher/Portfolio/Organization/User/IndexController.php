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
    $this->hyperlink['page']['list']['researcher'] = $this->route['name'].'list';
    $this->hyperlink['page']['delete'] = $this->route['name'].'delete';
    $this->hyperlink['page']['view'] = $this->route['name'].'view';
    $this->hyperlink['page']['update'] = $this->route['name'].'update';

    //Set Page Sub
    $this->hyperlink['page']['navigation']['main'] = $this->route['view'].'view.navigation.';

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

  /**************************************************************************************
 		View
 	**************************************************************************************/
	public function view(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Check If Not Empty
    if(empty($request->tab_category)){

      //Return to Default Route
      return redirect()->route($hyperlink['page']['view'],['organization_id'=>$request->organization_id,'tab'=>'tab','id'=>$request->id,'tab'=>'tab','tab_category'=>'personal','tab_category_sub'=>'position']);

    }

    //Check If Not Empty
    if(empty($request->tab_category_sub)){

      //Return to Default Route
      return redirect()->route($hyperlink['page']['view'],['organization_id'=>$request->organization_id,'tab'=>'tab','id'=>$request->id,'tab'=>'tab','tab_category'=>'general_information','tab_category_sub'=>'position']);

    }

    // Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-person-workspace"></i>';

    // Set Breadcrumb Title
    $data['breadcrumb']['title'] = [$this->header['category'],$this->header['module'],'Home'];

    //Set Model Navigation Category
    $model['navigation']['category']['main']= new NavigationCategoryView();

    //Get Navigation Category
    $data['navigation']['category']['main'] = $model['navigation']['category']['main']->getList(
      [
        'column'=>[
          'category'=>'PORTAL',
          'user_type'=>strtoupper('administrator'),
          'domain_url'=>$request->root()
        ]
      ]
    );

    //Set Model Navigation Category Sub
    $model['navigation']['category']['sub'] = new NavigationCategorySubView();

    //Get Navigation Category Sub
    $data['navigation']['category']['sub'] = $model['navigation']['category']['sub']->getList(
      [
        'column'=>[
          'category'=>'PORTAL',
          'user_type'=>strtoupper('administrator'),
          'navigation_category_code'=>strtoupper($request->tab_category),
          'domain_url'=>$request->root()
        ]
      ]
    );
// dd($data['navigation']['category']);
    //Set Model Researcher
    $model['researcher'] = new ResearcherProcedure();

    //Set Model Researcher
    $data['main']['data'] = $model['researcher']->readRecord(
      [
        'column'=>[
          'employee_id'=>$request->id
        ]
      ]
    );

    //Merge Tab Category
    $data = array_merge($data,$this->getTabCategory($request));
    // $data = $this->getTabCategory($request);
// dd($data['employee']['profile']);

// dd($data);

    //Set Model Researcher
    // $model['cervie']['researcher'] = new ResearcherProcedure();

    //Get Model Researcher
    // $data['main']['data'] = $model['researcher']->readRecord(
    //   [
    //     'eloquent'=>'pagination',
    //     'column'=>[
    //       'organization_id'=>$request->organization_id
    //     ]
    //   ]
    // );
// dd($data);
    //Get Form Token
		$form_token = $this->encrypt_token_form;

		//Return View
		return view($this->route['view'].'view.index',compact('data','form_token','hyperlink'));

  }

  public function getTabCategory(Request $request){

    //Get Tab Category
    switch($request->tab_category){

      //Avatar
      case 'avatar':

      break;

      //Work
      case 'work':

        //Set Model
        $model['employee']['position'] = new EmployeePosition();
        $data['employee']['position'] = $model['employee']['position']->getListSelected(
          [
            'column'=>[
              'employee_id'=>$request->id
            ]
          ]
        );

      break;

      //Personal
      case 'personal':

        //Set Model Employee Profile
        $model['employee']['profile'] = new EmployeeProfileProcedure();

        //Get Employee Profile
        $data['employee']['profile'] = $model['employee']['profile']->readRecord(
          [
            'column'=>[
              'employee_id'=>$request->id
            ]
          ]
        );


        // dd($data);
        // $model['general']['salutation'] = new Salutation();
        // $model['employee']['salutation'] = new EmployeeSalutation();
        //
        // //Get Data
        // $data['general']['salutation'] = json_encode($model['general']['salutation']->selectBox());
        // $data['employee']['salutation'] = $model['employee']['salutation']->getSalutation(
        //   [
        //     'column'=>[
        //       'employee_id'=>$request->id
        //     ]
        //   ]
        // );
        //
        // //Set Salutations
        // $salutations = []; // Initialize an empty array to store salutation IDs
        //
        // // Iterate over each item in the array
        // foreach($data['employee']['salutation'] as $item){
        //     // Add the salutation ID to the $salutations array
        //     $salutations[] = $item->salutation_id;
        // }
        //
        // // Convert the array of salutation IDs into a single string separated by commas
        // $data['employee']['salutation_id'] = implode(',', $salutations);

      break;

      //General Information
      case 'general_information':

        return [];
      break;

      //Contact
      case 'contact':

        //Set Model
        $model['contact']['category'] = new ContactCategory();
        $model['employee']['contact'] = new EmployeeContact();

        //Get Office Telephone Number
        $data['employee']['contact']['office']['telephone']['number'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>$request->id,
              'contact_category_id'=>2,
            ]
          ]
        );

        //Get Office Telephone Extension Number
        $data['employee']['contact']['office']['telephone_extension']['number'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>$request->id,
              'contact_category_id'=>3,
            ]
          ]
        );

        //Get Mobile Number
        $data['employee']['contact']['mobile']['phone']['number'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>$request->id,
              'contact_category_id'=>6,
            ]
          ]
        );

        //Get Internal Email Office
        $data['employee']['contact']['email']['office']['internal'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>$request->id,
              'contact_category_id'=>12,
            ]
          ]
        );

        //Get External Email Office
        $data['employee']['contact']['email']['office']['external'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>$request->id,
              'contact_category_id'=>13,
            ]
          ]
        );

      break;

      //Status
      case 'status':

        //Set Model
        $model['employee']['ldap'] = new EmployeeLDAP();
        $model['employee']['main'] = new Employee();
        $model['status']['employee']['main'] = new Status();
        $model['status']['employee']['ldap'] = new Status();

        //Set Data Status
        $data['status']['employee']['ldap'] = $model['status']['employee']['ldap']->selectBox(
          [
            'column'=>[
              'table'=>'employee_ldap'
            ]
          ]
        );

        //Set Data Status
        $data['status']['employee']['main'] = $model['status']['employee']['main']->selectBox(
          [
            'column'=>[
              'table'=>'employee'
            ]
          ]
        );

        //Get Data
        $data['employee']['ldap'] = $model['employee']['ldap']::find($request->id);
        $data['employee']['main'] = $model['employee']['main']::find($request->id);

      break;

      //Setting
      case 'setting':

        //Get Tab Sub Category
        switch($request->tab_sub_category){

          //Virtual Card
          case 'virtual_card':

            //Set Model
            $model['company'] = new Company();

            //Set Data Status
            $data['company'] = $model['company']->selectBox();
// dd(  $data['company']);
            //Set Model
            $model['employee']['virtual_card'] = new EmployeeVirtualCard();

            //Get Data
            $data['employee']['virtual_card'] = $model['employee']['virtual_card']::find($request->id);
// dd(  $data['employee']['virtual_card']);
            // dd($data['employee']['virtual_card']->logo_header);
          break;

        }

      break;

      default:
        // code...


      break;

    }

    //Return Data
    return $data;
  }

}
