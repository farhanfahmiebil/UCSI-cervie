<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Researcher\Portfolio\Organization\User\General\Information\Work\Experience;

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
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherWorkExperience AS CervieResearcherWorkExperienceView;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\Researcher AS ResearcherProcedure;
use App\Models\UCSI_V2_Main\MSSQL\Procedure\EmployeeProfile AS EmployeeProfileProcedure;

//Model View
use App\Models\UCSI_V2_Education\MSSQL\View\Organization;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTableControl AS CervieResearcherTableControlProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherWorkExperience AS CervieResearcherWorkExperienceProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherEvidence AS CervieResearcherEvidenceProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherLog AS CervieResearcherLogProcedure;

//Get Request
use Illuminate\Http\Request;

//Get Storage
use Storage;

//Get Validator
use Validator;

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
    'item'=>'Work Experience',
		'gate'=>''
	];

	//Set Route
	protected $route;

	//Set Page
	public $page;

	//Set Hyperlink
	public $hyperlink;

	/**************************************************************************************
		Route Path
	**************************************************************************************/
	public function routePath(){

		//Set Route Name
		$this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.user.view.general.information.work.experience.';

    //Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.researcher.portfolio.organization.user.view.general.information.work.experience.';

    //Set Route Link
    $this->route['link'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.user.';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Set Navigation
		$this->page['main'] = $this->route['link'].'view.';

    $this->page['navigation']['header']['breadcrumb'] = $this->page['main'].'navigation.header.breadcrumb';
    $this->page['navigation']['tab']['header'] = $this->page['main'].'navigation.tab.header.index';
    $this->page['navigation']['tab']['main'] = $this->page['main'].'navigation.tab.content.main.index';
    $this->page['navigation']['tab']['pointer'] = '';
    $this->page['navigation']['tab']['content']['list'] = $this->route['view'].'list.index';
    $this->page['navigation']['tab']['content']['new'] = $this->route['view'].'new.index';
    $this->page['navigation']['tab']['content']['view'] = $this->route['view'].'view.index';
    $this->page['navigation']['tab']['right'] = $this->page['main'].'navigation.tab.content.navigation.right.index';

		//Set Hyperlink
    $this->hyperlink['page']['back'] = $this->route['link'].'list';

    //General Information - Researcher Position
    $this->hyperlink['page']['list'] = $this->route['view'].'list';
    $this->hyperlink['page']['new'] = $this->route['view'].'new';
    $this->hyperlink['page']['create'] = $this->route['name'].'create';
    $this->hyperlink['page']['delete']['main'] = $this->route['name'].'delete';
    $this->hyperlink['page']['delete']['evidence'] = $this->route['name'].'evidence.delete';
    $this->hyperlink['page']['view'] = $this->route['name'].'view';
    $this->hyperlink['page']['update'] = $this->route['name'].'update';

    //Set Page Sub
    $this->hyperlink['page']['navigation']['main'] = $this->route['link'].'navigation.';

	}

  /**************************************************************************************
    New
  **************************************************************************************/
  public function new(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-person-workspace"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = [$this->header['category'], $this->header['module'],'New'];

    //Set Model Navigation Category
    $model['navigation']['category']['main'] = new NavigationCategoryView();

    //Get Navigation Category
    $data['navigation']['category']['main'] = $model['navigation']['category']['main']->getList([
      'column'=>[
        'category'=>'PORTAL',
        'user_type'=>strtoupper('administrator'),
        'domain_url'=>$request->root()
      ]
    ]);

    //Set Model Navigation Category Sub
    $model['navigation']['category']['sub'] = new NavigationCategorySubView();

    //Get Navigation Category Sub
    $data['navigation']['category']['sub'] = $model['navigation']['category']['sub']->getList(
      [
        'column'=>[
          'category'=>'PORTAL',
          'user_type'=>strtoupper('administrator'),
          'navigation_category_code'=>'GENERAL_INFORMATION',
          'domain_url'=>$request->root()
        ]
      ]
    );

    //Set Model Researcher - Employee Profile
    $model['employee']['profile'] = new EmployeeProfileProcedure();

    //Get Employee Profile
    $data['employee']['profile'] = $model['employee']['profile']->readRecord(
      [
        'column'=>[
          'employee_id'=>$request->employee_id
        ]
      ]
    );

    /*  Researcher Position
   	**************************************************************************************/

    //Set Table Researcher Position
    $data['table']['column']['cervie']['researcher']['work']['experience'] = $this->getDataTable(
      [
        'category'=>'work_experience'
      ]
    );

    //Set Main Data Researcher Position
    $data['main']['cervie']['researcher']['work']['experience'] = $this->getData(
      [
        'eloquent'=>'pagination',
        'category'=>'work_experience',
        'column'=>[
          'employee_id'=>$request->employee_id
        ]
      ]
    );

    //Set Model
    $model['cervie']['researcher']['table']['control'] = new CervieResearcherTableControlProcedure();
    $model['general']['organization'] = new Organization();

    //Get Table Control
    $data['cervie']['researcher']['table']['control'] = $model['cervie']['researcher']['table']['control']->readRecord(
      [
        'column'=>[
          'table_control_id'=>'cervie_researcher_work_experience'
        ]
      ]
    );

    //Set Data Organization
    $data['general']['organization'] = $model['general']['organization']->selectBox(
      [
        'column'=>[
          'company_id'=>'UCSI_EDUCATION',
          'company_office_id'=>'MAIN_CAMPUS'
        ]
      ]
    );

    //Defined Column
    $data['table']['column']['cervie']['researcher']['evidence'] = [
      0=>[
        'icon'=>'<i class="mdi mdi-numeric"></i>',
        'name'=>'No',
      ],
      1=>[
        'icon'=>'<i class="mdi mdi-file-account-outline"></i>',
        'name'=>' File',
      ],
      2=>[
        'icon'=>'<i class="mdi mdi-settings"></i>',
        'name'=>' Control',
      ]
    ];

    //Set Page
    $page = $this->page;

    //Set Page Pointer
    $page['navigation']['tab']['pointer'] =  $page['navigation']['tab']['content']['new'];
    // dd($page);
    //Get Form Token
    $form_token = $this->encrypt_token_form;

    //Return View
    return view($this->route['link'].'view.navigation.content.list.index',compact('data','page','form_token','hyperlink'));

  }

  /**************************************************************************************
    Create
  **************************************************************************************/
  public function create(Request $request){

    //Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //If Form Token Exist
		if(!$request->has('form_token')){abort(555,'Form Token Missing');}

		//Check Type Request
		switch($this->encrypter->decrypt($request->form_token)){

      //Create
      case 'create':

        //Get Validate Data
        $this->getValidateData($request);

        //Set Model
        $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceProcedure();

        //Create Main
        $result['main']['create'] = $model['cervie']['researcher']['work']['experience']->createRecord(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'company_name'=>$request->company_name,
              'designation'=>$request->designation,
              'year_start'=>$request->year_start,
              'year_end'=>$request->year_end,
              'is_working_here'=>(($request->is_working_here)?1:0),
              'need_verification'=>0,
              'remark'=>(($request->remark)?$request->remark:null),
              'remark_user'=>(($request->remark_user)?$request->remark_user:null),
              'created_by'=>Auth::id()
            ]
          ]
        );

        //If Files Exist
        if($request->has('document')){

          //Get File Loop
          foreach($request->file('document') as $key=>$value){

            //Set File Name With Extension
            $file['name']['raw']['with']['extension'] = $value->getClientOriginalName();

            //Set file name With Extension
            $file['name']['raw']['without']['extension'] = pathinfo($file['name']['raw']['with']['extension'], PATHINFO_FILENAME);

            //Get File Extension
            $file['extension'] = $value->getClientOriginalExtension();

            //Set Path Folder
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/work_experience/'.$result['main']['create']->last_insert_id.'/';;

            //Set Modified File Name Without Extension (Using last_insert_id)
            $file['name']['modified']['without']['extension'] = ($key+1);

            //Set Modified File Name With Extension
            $file['name']['modified']['with']['extension'] = $file['name']['modified']['without']['extension'] . '.' . $file['extension'];

            //Set The Full Upload Path
            $path['upload'] = $path['folder'] . $file['name']['modified']['with']['extension'];

            //Check If The File Already Exists In Storage
            $check['exist']['storage'] = Storage::disk()->exists($path['upload']);

            //If File Exists, Delete It
            if($check['exist']['storage']){Storage::disk()->delete($path['upload']);}

            //Store File
            Storage::disk()->put($path['upload'], fopen($value, 'r+'));

            //Set Model Evidence
            $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

            //Create Evidence
            $result['evidence']['create'] = $model['cervie']['researcher']['evidence']->createRecord(
              [
                'column'=>[
                  'employee_id'=>$request->employee_id,
                  'file_id'=>$file['name']['modified']['without']['extension'],
                  'file_name'=>(($request->document_name[$key])?$request->document_name[$key]:null),
                  'file_raw_name'=>$file['name']['raw']['without']['extension'],
                  'file_extension'=>$file['extension'],
                  'table_name'=>'cervie_researcher_work_experience',
                  'table_id'=>$result['main']['create']->last_insert_id,
                  'need_verification'=>0,
                  'remark'=>(($request->remark)?$request->remark:null),
                  'remark_user'=>(($request->remark_user)?$request->remark_user:null),
                  'created_by'=>Auth::id(),
                ]
              ]
            );

          }

        }

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['list'],['organization_id'=>$request->organization_id,'employee_id'=>$request->employee_id])
                     ->with('alert_type','success')
                     ->with('message','Researcher Work Experience Added');

  }

  /**************************************************************************************
      List
  **************************************************************************************/
  public function list(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-person-workspace"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = [$this->header['category'], $this->header['module'],'Home'];

    //Set Model Navigation Category
    $model['navigation']['category']['main'] = new NavigationCategoryView();

    //Get Navigation Category
    $data['navigation']['category']['main'] = $model['navigation']['category']['main']->getList([
      'column'=>[
        'category'=>'PORTAL',
        'user_type'=>strtoupper('administrator'),
        'domain_url'=>$request->root()
      ]
    ]);

    //Set Model Navigation Category Sub
    $model['navigation']['category']['sub'] = new NavigationCategorySubView();

    //Get Navigation Category Sub
    $data['navigation']['category']['sub'] = $model['navigation']['category']['sub']->getList(
      [
        'column'=>[
          'category'=>'PORTAL',
          'user_type'=>strtoupper('administrator'),
          'navigation_category_code'=>'GENERAL_INFORMATION',
          'domain_url'=>$request->root()
        ]
      ]
    );

    //Set Model Researcher - Employee Profile
    $model['employee']['profile'] = new EmployeeProfileProcedure();

    //Get Employee Profile
    $data['employee']['profile'] = $model['employee']['profile']->readRecord(
      [
        'column'=>[
            'employee_id'=>$request->employee_id
        ]
      ]
    );

    /*  Researcher Position
   	**************************************************************************************/

    //Set Table Researcher Position
    $data['table']['column']['cervie']['researcher']['work']['experience'] = $this->getDataTable(
      [
        'category'=>'work_experience'
      ]
    );

    //Set Main Data Researcher Position
    $data['main']['cervie']['researcher']['work']['experience'] = $this->getData(
      [
        'eloquent'=>'pagination',
        'category'=>'work_experience',
        'column'=>[
          'employee_id'=>$request->employee_id
        ]
      ]
    );

    //If Type Exist
		if($request->has('form_token')){

			//Check Type Request
			switch($this->encrypter->decrypt($request->form_token)){

				//List Type
				case 'filter':
				case 'search':
				case 'sort':

					//Filter Category
					$filter['search'] = ($request->search != null)?$request->search:null;
          $filter['employee_id'] = ($request->employee_id != null)?['employee_id'=>$request->employee_id]:null;
					$filter['need_verification'] = ($request->need_verification != null)?['employee_id'=>$request->need_verification]:null;
					$filter['order']['ordercolumn'] = ($request->sorting_column != null)?$request->sorting_column:null;
					$filter['order']['orderby'] = ($request->sorting != null)?$request->sorting:null;

          //Set Main Data Researcher Position
          $data['main']['cervie']['researcher']['work']['experience'] = $this->getData(
            [
              'type'=>$this->encrypter->decrypt($request->form_token),
              'eloquent'=>'pagination',
              'column'=>$filter,
              'category'=>'work_experience'
            ]
          );

				break;

				//If Request Type Not Found
				default:

					//Return Failed
					return redirect($request->url)->with('alert_type','error')
																				->with('message','Execute Failed');

				break;

			}

		}

    //Set Page
    $page = $this->page;

    //Set Page Pointer
    $page['navigation']['tab']['pointer'] =  $page['navigation']['tab']['content']['list'];

    //Get Form Token
    $form_token = $this->encrypt_token_form;

    //Return View
    return view($this->route['link'].'view.navigation.content.list.index', compact('data','page','form_token','hyperlink'));

  }

  /**************************************************************************************
    Delete
  **************************************************************************************/
  public function delete(Request $request){

    //Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //If Form Token Exist
		if(!$request->has('form_token')){abort(555,'Form Token Missing');}

		//Check Type Request
		switch($this->encrypter->decrypt($request->form_token)){

      //Create
      case 'delete':

        //Set Model
        $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceProcedure();

        //Delete Main
        $result['main']['delete'] = $model['cervie']['researcher']['work']['experience']->deleteRecord(
          [
            'column'=>[
              'work_experience_id'=>$request->id,
              'employee_id'=>$request->employee_id,
            ]
          ]
        );

        //Set Path Folder
        $path['folder'] = 'public/resources/researcher/'.$request->employee_id.'/document/work_experience/'.$request->id.'/';

        //Check If The Folder Already Exists In Storage
        $check['exist']['storage'] = Storage::disk()->exists($path['folder']);

        //If Folder Exists, Delete It
        if($check['exist']['storage']){Storage::disk()->deleteDirectory($path['folder']);}

        //Set Model Evidence
        $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

        //Delete Evidence Record
        $result['evidence']['delete'] = $model['cervie']['researcher']['evidence']->deleteRecordByResearcherTable(
          [
            'column'=>[
              'employee_id'=>$request->employee_id,
              'table_name'=>'cervie_researcher_work_experience',
              'table_id'=>$request->id
            ]
          ]
        );

        //Set Model
        $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceProcedure();

        // //Delete Evidence
        // $data['main']['verification'] = $model['cervie']['researcher']['work']['experience']->needVerification(
        //   [
        //     'column'=>[
        //       'work_experience_id'=>$request->id,
        //       'employee_id'=>$request->employee_id,
        //       'updated_by'=>Auth::id()
        //     ]
        //   ]
        // );

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['list'],['organization_id'=>$request->organization_id,'employee_id'=>$request->employee_id])
                     ->with('alert_type','success')
                     ->with('message','Research Work Experience Deleted');

  }

  /**************************************************************************************
 		Delete
 	**************************************************************************************/
	public function deleteEvidence(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //If Form Token Exist
    if(!$request->has('form_token')){abort(555,'Form Token Missing');}

		//Check Type Request
		switch($this->encrypter->decrypt($request->form_token)){

      //Create
      case 'delete':

        //Set Model
        $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

        //Set Main
        $data['evidence'] = $model['cervie']['researcher']['evidence']->readRecord(
          [
            'column'=>[
              'evidence_id'=>$request->evidence_id,
              'employee_id'=>$request->employee_id
            ]
          ]
        );

        //Set Path Folder
        $path['folder'] = 'public/resources/researcher/'.$request->employee_id.'/document/work_experience/'.$data['evidence']->table_id.'/';

        //Set Modified File Name Without Extension (Using last_insert_id)
        $file['name']['modified']['without']['extension'] = $data['evidence']->file_id;

        //Set Modified File Name With Extension
        $file['name']['modified']['with']['extension'] = $file['name']['modified']['without']['extension'].'.'.$data['evidence']->file_extension;

        //Set The Full Upload Path
        $path['upload'] = $path['folder'].$file['name']['modified']['with']['extension'];

        //Check If The File Already Exists In Storage
        $check['exist']['storage'] = Storage::disk()->exists($path['upload']);

        //If The File Exists, Delete It
        if($check['exist']['storage']){Storage::disk()->delete($path['upload']);}

        //Delete Record
        $result['evidence']['delete'] = $model['cervie']['researcher']['evidence']->deleteRecord(
          [
            'column'=>[
              'evidence_id'=>$data['evidence']->evidence_id,
              'employee_id'=>$request->employee_id
            ]
          ]
        );

        //Set Model
        $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceProcedure();

        //Set Main Verification
        // $data['main']['verification'] = $model['cervie']['researcher']['work']['experience']->needVerification(
        //   [
        //     'column'=>[
        //       'work_experience_id'=>$data['evidence']->table_id,
        //       'employee_id'=>$request->employee_id,
        //       'updated_by'=>Auth::id()
        //     ]
        //   ]
        // );

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['view'],['organization_id'=>$request->organization_id,'employee_id'=>$request->employee_id,'id'=>$request->id])
                     ->with('alert_type','success')
                     ->with('message','Evidence Deleted');

  }

  /**************************************************************************************
    View
  **************************************************************************************/
  public function view(Request $request){

    //Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-person-workspace"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = [$this->header['category'], $this->header['module'],'View'];

    //Set Model Navigation Category
    $model['navigation']['category']['main'] = new NavigationCategoryView();

    //Get Navigation Category
    $data['navigation']['category']['main'] = $model['navigation']['category']['main']->getList([
      'column'=>[
        'category'=>'PORTAL',
        'user_type'=>strtoupper('administrator'),
        'domain_url'=>$request->root()
      ]
    ]);

    //Set Model Navigation Category Sub
    $model['navigation']['category']['sub'] = new NavigationCategorySubView();

    //Get Navigation Category Sub
    $data['navigation']['category']['sub'] = $model['navigation']['category']['sub']->getList(
      [
        'column'=>[
          'category'=>'PORTAL',
          'user_type'=>strtoupper('administrator'),
          'navigation_category_code'=>'GENERAL_INFORMATION',
          'domain_url'=>$request->root()
        ]
      ]
    );

    //Set Model Researcher - Employee Profile
    $model['employee']['profile'] = new EmployeeProfileProcedure();

    //Get Employee Profile
    $data['employee']['profile'] = $model['employee']['profile']->readRecord(
      [
        'column'=>[
            'employee_id'=>$request->employee_id
        ]
      ]
    );

    //Set Model
    $model['cervie']['researcher']['table']['control'] = new CervieResearcherTableControlProcedure();

    //Get Table Control
    $data['cervie']['researcher']['table']['control'] = $model['cervie']['researcher']['table']['control']->readRecord(
      [
        'column'=>[
          'table_control_id'=>'cervie_researcher_work_experience'
        ]
      ]
    );

    //Set Model
    $model['general']['organization'] = new Organization();
    $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceProcedure();

    //Set Data Organization
    $data['general']['organization'] = $model['general']['organization']->selectBox(
      [
        'column'=>[
          'company_id'=>'UCSI_EDUCATION',
          'company_office_id'=>'MAIN_CAMPUS'
        ]
      ]
    );

    //Set Main
    $data['main'] = $model['cervie']['researcher']['work']['experience']->readRecord(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'work_experience_id'=>$request->id
        ]
      ]
    );

    //Set Model
    $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

    //Set Evidence
    $data['evidence'] = $model['cervie']['researcher']['evidence']->readRecordByResearcherTable(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'table_name'=>'cervie_researcher_work_experience',
          'table_id'=>$request->id
        ]
      ]
    );


    if($data['main']->need_verification){

      //Set Model Researcher - Employee Profile
      $model['cervie']['researcher']['log'] = new CervieResearcherLogProcedure();

      //Get Employee Profile
      $data['cervie']['researcher']['log']['work']['experience'] = $model['cervie']['researcher']['log']->readRecord(
        [
          'column'=>[
            'employee_id'=>$request->employee_id,
            'table_name'=>'cervie_researcher_work_experience',
            'auditable_id' => $request->id,
            'category' => 'main'
          ]
        ]
      );

      //Get Employee Profile
      $data['cervie']['researcher']['log']['evidence'] = $model['cervie']['researcher']['log']->readRecord(
        [
          'column'=>[
            'employee_id'=>$request->employee_id,
            'main_table_name'=>'cervie_researcher_work_experience',
            'table_name'=>'cervie_researcher_evidence',
            'auditable_id' => $request->id,
            'category' => 'evidence',
            'event' => 'create'

          ]
        ]
      );

    }

    //Defined Column
    $data['table']['column']['cervie']['researcher']['evidence'] = [
      0=>[
        'icon'=>'<i class="mdi mdi-numeric"></i>',
        'name'=>'No',
      ],
      1=>[
        'class'=>'col-8',
        'icon'=>'<i class="mdi mdi-file-account-outline"></i>',
        'name'=>' File',
      ],
      2=>[
        'icon'=>'<i class="mdi mdi-settings"></i>',
        'name'=>' Control',
      ]
    ];

    //Set Page
    $page = $this->page;

    //Set Page Pointer
    $page['navigation']['tab']['pointer'] =  $page['navigation']['tab']['content']['view'];

    //Set Asset
    $asset['document'] = '/public/resources/researcher/'.$request->employee_id.'/document/work_experience/'.$request->id.'/';

    //Set Document
    $hyperlink['document'] = $request->root().'/storage/resources/researcher/'.$request->employee_id.'/document/work_experience/'.$request->id.'/';


    //Get Form Token
		$form_token = $this->encrypt_token_form;

    //Return View
		return view($this->route['link'].'view.navigation.content.list.index',compact('data','asset','page','form_token','hyperlink'));



  }

  /**************************************************************************************
 		Update
 	**************************************************************************************/
	public function update(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //If Form Token Exist
		if(!$request->has('form_token')){abort(555,'Form Token Missing');}

		//Check Type Request
		switch($this->encrypter->decrypt($request->form_token)){

      //Create
      case 'update':

        //Get Validate Data
        $this->getValidateData($request);

        //Set Model
        $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceProcedure();

        //Set Main
        $data['main'] = $model['cervie']['researcher']['work']['experience']->updateRecord(
          [
            'column'=>[
              'work_experience_id'=>$request->id,
              'employee_id'=>Auth::id(),
              'company_name'=>$request->company_name,
              'designation'=>$request->designation,
              'year_start'=>$request->year_start,
              'year_end'=>$request->year_end,
              'is_working_here'=>(($request->is_working_here)?1:0),
              'need_verification'=>0,
              'remark'=>(($request->remark)?$request->remark:null),
              'remark_user'=>(($request->remark_user)?$request->remark_user:null),
              'updated_by'=>Auth::id()
            ]
          ]
        );

        //Set Model Evidence
        $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

        //Create Evidence
        $result['evidence']['update'] = $model['cervie']['researcher']['evidence']->updateRecord(
          [
            'column'=>[
              'employee_id'=>$request->employee_id,
              'table_name'=>'cervie_researcher_work_experience',
              'table_id'=>$request->id,
              'need_verification'=>0,
              'remark'=>(($request->remark)?$request->remark:null),
              'remark_user'=>(($request->remark_user)?$request->remark_user:null),
              'updated_by'=>Auth::id(),
            ]
          ]
        );


        //If files Exist
        if($request->has('document')){

          //Get File Loop
          foreach($request->file('document') as $key=>$value){

            //Set Model
            $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

            //Set Document
            $data['document'] = $model['cervie']['researcher']['evidence']->readRecordByResearcherTable(
              [
                'column'=>[
                  'employee_id'=>$request->employee_id,
                  'table_name'=>'cervie_researcher_work_experience',
                  'table_id'=>$request->id
                ]
              ]
            );

            //Set Counter
            $counter = ((count($data['document']) == $key)?$key:count($data['document']));

            //Set file name with extension
            $file['name']['raw']['with']['extension'] = $value->getClientOriginalName();

            //Set file name without extension
            $file['name']['raw']['without']['extension'] = pathinfo($file['name']['raw']['with']['extension'], PATHINFO_FILENAME);

            //Get file extension
            $file['extension'] = $value->getClientOriginalExtension();

            //Set path folder
            $path['folder'] = 'public/resources/researcher/'.$request->employee_id.'/document/work_experience/'.$request->id.'/';

            //Set modified file name without extension (using last_insert_id)
            $file['name']['modified']['without']['extension'] = ($counter+1);

            //Set modified file name with extension
            $file['name']['modified']['with']['extension'] = $file['name']['modified']['without']['extension'] . '.' . $file['extension'];

            //Set the full upload path
            $path['upload'] = $path['folder'] . $file['name']['modified']['with']['extension'];

            //Check if the file already exists in storage
            $check['exist']['storage'] = Storage::disk()->exists($path['upload']);

            //If the file exists, delete it
            if($check['exist']['storage']){
              Storage::disk()->delete($path['upload']);
            }

            //Store the file in storage (you may use `fopen` if needed for specific storages)
            Storage::disk()->put($path['upload'],fopen($value,'r+'));

            //Set the model and create a new record in the database
            $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

            //Set main data and create a record for the file
            $data['upload'] = $model['cervie']['researcher']['evidence']->createRecord(
              [
                'column' => [
                  'employee_id'=>$request->employee_id,
                  'file_id' => $file['name']['modified']['without']['extension'],
                  'file_name' => (($request->document_name[$key])?$request->document_name[$key]:null),
                  'file_raw_name' => $file['name']['raw']['without']['extension'],
                  'file_extension' => $file['extension'],
                  'table_name' => 'cervie_researcher_work_experience',
                  'table_id' => $request->id,
                  'need_verification'=>0,
                  'remark'=>(($request->remark)?$request->remark:null),
                  'remark_user'=>(($request->remark_user)?$request->remark_user:null),
                  'created_by' => Auth::id(),
                ]
              ]
            );

          }

        }

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['view'],['organization_id'=>$request->organization_id,'employee_id'=>$request->employee_id,'id'=>$request->id])
                     ->with('alert_type','success')
                     ->with('message','Researcher Work Experience Saved');

  }

  /**************************************************************************************
    Get Data Table
  **************************************************************************************/
  public function getDataTable($data){

    //Check Data Category Exist
    if(!isset($data['category'])){abort(404);}

    //Defined Column
    $table = [
      0=>[
        'category'=>'checkbox',
        'checkbox'=>'<div class="form-check">
                      <input type="checkbox" id="selectAll" name="id[]" class="form-check-input selectBox">
										 </div>',
        'icon'=>'<i class="bi bi-numeric"></i>',
        'name'=>'No',
      ],
      1=>[
        'icon'=>'<i class="mdi mdi-numeric"></i>',
        'name'=>'No',
      ],
      2=>[
        'class'=>'col-md-5',
        'icon'=>'<i class="mdi mdi-account-card-details"></i>',
        'name'=>' Company',
      ],
      3=>[
        'icon'=>'<i class="mdi mdi-settings"></i>',
        'name'=>' Period',
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

    //Return Table
    return $table;

  }

  /**************************************************************************************
    Get Data
  **************************************************************************************/
  public function getData($data){

    //Check Data Category Exist
    if(!isset($data['category'])){abort(555,'Category Not Set');}
// dd($data);
    //Set Model
    $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceView();

    //Set Data
    $data = $model['cervie']['researcher']['work']['experience']->getList(
      [
        'type'=>((isset($data['type']))?$data['type']:null),
        'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
        'column'=>((isset($data['column']))?$data['column']:null),
        'category'=>'work_experience'
        // 'column'=>[
        //   'employee_id'=>Auth::id()
        // ]
      ]
    );

    return $data;

  }

  /**************************************************************************************
 		Validate Data
 	**************************************************************************************/
  public function getValidateData(Request $request){

    //Define validation rules
    $rules = [
      'company_name'=>['required'],
      'designation'=>['required'],
      'year_start'=>['nullable', 'regex:/^\d{4}$/'], // 4-digit year (nullable)
      'year_end'=>['nullable','regex:/^\d{4}$/','after_or_equal:year_start'], // 4-digit year (nullable)
      'is_working_here'=>['boolean'], // Not required, but must be boolean if present
      'document.*'=>['required','mimes:pdf','max:3072'], // Validate each file in the array
      'document_name.*'=>['required'], // Validate that each file has an associated name
    ];

    //Custom validation messages
    $messages = [
      'company_name.required'=>'Company Name is Required',
      'designation.required'=>'Designation is Required',
      'year_start.regex'=>'Year Start must be a 4-digit year',
      'year_end.regex'=>'Year End must be a 4-digit year',
      'year_end.after'=>'Year End must be after Year Start',
    ];

    //Add dynamic error messages for each file and file_name
    if($request->has('document_name')){

      //Get Document Name
      foreach($request->document_name as $key=>$value){

        $rules['document.' . $key] = ['required','mimes:pdf','max:3072'];

        $messages['document.'.$key.'.required'] = 'Evidence item '.($key + 1).': File is required';
        $messages['document.'.$key.'.mimes'] = 'Evidence item '.($key + 1).': File must be a PDF';
        $messages['document.'.$key.'.max'] = 'Evidence item '.($key + 1).': File size cannot exceed 3MB';
        $messages['document_name.'.$key.'.required'] = 'Evidence item '.($key + 1).': File name is required';
      }

    }

    // Create a validator instance
    $validator = Validator::make($request->all(),$rules,$messages);

    // Custom rule: either year_end or is_working_here must be present (but not both)
    $validator->after(function ($validator) use ($request) {
      $year_end = $request->input('year_end');
      $is_working_here = $request->input('is_working_here');

      // Check if both year_end and is_working_here are empty
      if(empty($year_end) && empty($is_working_here)){
        $validator->errors()->add('year_or_work', 'Either Year End or Is Working Here must be provided.');
      }

      // Check if both fields are filled
      if(!empty($year_end) && !empty($is_working_here)){
        $validator->errors()->add('year_or_work', 'Only one of Year End or Is Working Here should be provided.');
      }

    });

    // Run the validation
    $validator->validate();

  }
}
