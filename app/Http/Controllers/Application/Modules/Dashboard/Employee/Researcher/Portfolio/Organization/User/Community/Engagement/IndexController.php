<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Researcher\Portfolio\Organization\User\Community\Engagement;

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
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherCommunityEngagement AS CervieResearcherCommunityEngagementView;
use App\Models\UCSI_V2_General\MSSQL\View\RepresentationRole AS RepresentationRoleView;
use App\Models\UCSI_V2_General\MSSQL\View\SustainableDevelopmentGoal AS SustainableDevelopmentGoalView;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\Researcher AS ResearcherProcedure;
use App\Models\UCSI_V2_Main\MSSQL\Procedure\EmployeeProfile AS EmployeeProfileProcedure;

//Model View
use App\Models\UCSI_V2_Education\MSSQL\View\Organization;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTableControl AS CervieResearcherTableControlProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherCommunityEngagement AS CervieResearcherCommunityEngagementProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherEvidence AS CervieResearcherEvidenceProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTeamMember AS CervieResearcherTeamMemberProcedure;
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
    'category'=>'Researcher Community Engagement',
		'module'=>'Organization',
		'module_sub'=>'User',
    'item'=>'Community Engagement',
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
		$this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.user.view.community.engagement.';

    //Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.researcher.portfolio.organization.user.view.community.engagement.';

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

    //General Information - Researcher Community Engagement
    $this->hyperlink['page']['list'] = $this->route['view'].'list';
    $this->hyperlink['page']['new'] = $this->route['view'].'new';
    $this->hyperlink['page']['create'] = $this->route['name'].'create';
    $this->hyperlink['page']['delete']['main'] = $this->route['name'].'delete';
    $this->hyperlink['page']['delete']['evidence'] = $this->route['name'].'evidence.delete';
    $this->hyperlink['page']['view'] = $this->route['name'].'view';
    $this->hyperlink['page']['update'] = $this->route['name'].'update';
    $this->hyperlink['page']['delete']['team']['member'] = $this->route['name'].'team_member.delete';

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
          'navigation_category_code'=>'COMMUNITY_ENGAGEMENT',
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

    /*  Researcher Community Engagement
   	**************************************************************************************/

    //Set Table Researcher Community Engagement
    $data['table']['column']['cervie']['researcher']['community']['engagement'] = $this->getDataTable(
      [
        'category'=>'COMMUNITY_ENGAGEMENT'
      ]
    );

    //Set Main Data Researcher Community Engagement
    $data['main']['cervie']['researcher']['community']['engagement'] = $this->getData(
      [
        'eloquent'=>'pagination',
        'category'=>'COMMUNITY_ENGAGEMENT',
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
          'table_control_id'=>'cervie_researcher_community_engagement'
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

    //Set Model General Sustainable Development Goal
    $model['general']['sustainable']['development']['goal'] = new SustainableDevelopmentGoalView();

    //Get General General Sustainable Development Goal
    $data['general']['sustainable']['development']['goal'] = $model['general']['sustainable']['development']['goal']->selectBox();

    //Set Model General Representation Role
    $model['general']['representation']['role'] = new RepresentationRoleView();

    //Get General Representation Role
    $data['general']['representation']['role'] = $model['general']['representation']['role']->selectBox(
      [
        'column'=>[
          'category'=>'COMMUNITY_ENGAGEMENT'
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

    //Defined Column
    $data['table']['column']['cervie']['researcher']['team']['member'] = [
      0=>[
        'icon'=>'<i class="mdi mdi-numeric"></i>',
        'name'=>'No',
      ],
      1=>[
        'icon'=>'<i class="mdi mdi-account-group"></i>',
        'name'=>' Member',
      ],
      3=>[
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

        //Convert array to string with commas separating the values
        $sustainable_development_goal = (($request->has('sustainable_development_goal_id'))?implode(',',$request->sustainable_development_goal_id):null);

          //Set Model
          $model['cervie']['researcher']['community']['engagement'] = new CervieResearcherCommunityEngagementProcedure();

          //Create Main
          $result['main']['create'] = $model['cervie']['researcher']['community']['engagement']->createRecord(
            [
              'column'=>[
                'employee_id'=>Auth::id(),
                'organization'=>($request->has('organization')?$request->organization:null),
                'project_name'=>($request->has('project_name')?$request->project_name:null),
                'sponsor'=>($request->has('sponsor')?$request->sponsor:null),
                'amount'=>($request->has('amount')?$request->amount:null),
                'description'=>($request->has('description')?$request->description:null),
                'date_start'=>($request->has('date_start')?$request->date_start:null),
                'date_end'=>($request->has('date_end')?$request->date_end:null),
                'star_rating'=>($request->has('star_rating')?$request->star_rating:null),
                'sustainable_development_goal'=>$sustainable_development_goal,
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
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/community_engagement/'.$result['main']['create']->last_insert_id.'/';;

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
                  'table_name'=>'cervie_researcher_community_engagement',
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

        //If Files Exist
        if($request->has('team_member_name')){

          //Get File Loop
          foreach($request->team_member_name as $key=>$value){

            //Set Model Evidence
            $model['cervie']['researcher']['team']['member'] = new CervieResearcherTeamMemberProcedure();

            //Create Evidence
            $result['team']['member']['create'] = $model['cervie']['researcher']['team']['member']->createRecord(
              [
                'column'=>[
                  'employee_id'=>Auth::id(),
                  'name'=>$value,
                  'representation_role_id'=>(isset($request->representation_role_id[$key]) ? $request->representation_role_id[$key]:null),
                  'role'=>(isset($request->role[$key]) ? $request->role[$key]:null),
                  'table_name'=>'cervie_researcher_community_engagement',
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
                     ->with('message','Researcher Community Engagement Added');

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
          'navigation_category_code'=>'COMMUNITY_ENGAGEMENT',
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

    /*  Researcher Community Engagement
   	**************************************************************************************/

    //Set Table Researcher Community Engagement
    $data['table']['column']['cervie']['researcher']['community']['engagement'] = $this->getDataTable(
      [
        'category'=>'COMMUNITY_ENGAGEMENT'
      ]
    );

    //Set Main Data Researcher Community Engagement
    $data['main']['cervie']['researcher']['community']['engagement'] = $this->getData(
      [
        'eloquent'=>'pagination',
        'category'=>'COMMUNITY_ENGAGEMENT',
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

          //Set Main Data Researcher Community Engagement
          $data['main']['cervie']['researcher']['community']['engagement'] = $this->getData(
            [
              'type'=>$this->encrypter->decrypt($request->form_token),
              'eloquent'=>'pagination',
              'column'=>$filter,
              'category'=>'COMMUNITY_ENGAGEMENT'
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
        $model['cervie']['researcher']['community']['engagement'] = new CervieResearcherCommunityEngagementProcedure();

        //Delete Main
        $result['main']['delete'] = $model['cervie']['researcher']['community']['engagement']->deleteRecord(
          [
            'column'=>[
              'community_engagement_id'=>$request->id,
              'employee_id'=>$request->employee_id,
            ]
          ]
        );

        //Set Path Folder
        $path['folder'] = 'public/resources/researcher/'.$request->employee_id.'/document/community_engagement/'.$request->id.'/';

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
              'table_name'=>'cervie_researcher_community_engagement',
              'table_id'=>$request->id
            ]
          ]
        );

        //Set Model Evidence
        $model['team']['member']['delete'] = new CervieResearcherTeamMemberProcedure();

        //Delete Evidence Record
        $result['team']['member']['delete'] = $model['team']['member']['delete']->deleteRecordByResearcherTable(
          [
            'column'=>[
              'employee_id'=>$request->employee_id,
              'table_name'=>'cervie_researcher_community_engagement',
              'table_id'=>$request->id
            ]
          ]
        );


      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['list'],['organization_id'=>$request->organization_id,'employee_id'=>$request->employee_id])
                     ->with('alert_type','success')
                     ->with('message','Researcher Community Engagement Deleted');

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
        $path['folder'] = 'public/resources/researcher/'.$request->employee_id.'/document/community_engagement/'.$data['evidence']->table_id.'/';

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
        $model['cervie']['researcher']['community']['engagement'] = new CervieResearcherCommunityEngagementProcedure();

        //Set Main Verification
        // $data['main']['verification'] = $model['cervie']['researcher']['community']['engagement']->needVerification(
        //   [
        //     'column'=>[
        //       'community_engagement_id'=>$data['evidence']->table_id,
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
          'navigation_category_code'=>'COMMUNITY_ENGAGEMENT',
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
          'table_control_id'=>'cervie_researcher_community_engagement'
        ]
      ]
    );

    //Set Model
    $model['general']['organization'] = new Organization();
    $model['cervie']['researcher']['community']['engagement'] = new CervieResearcherCommunityEngagementProcedure();

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
    $data['main'] = $model['cervie']['researcher']['community']['engagement']->readRecord(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'community_engagement_id'=>$request->id
        ]
      ]
    );

    //Set Model General Representation Role
    $model['general']['representation']['role'] = new RepresentationRoleView();

    //Get General Representation Role
    $data['general']['representation']['role'] = $model['general']['representation']['role']->selectBox(
      [
        'column'=>[
          'category'=>'COMMUNITY_ENGAGEMENT'
        ]
      ]
    );

    //Set Model General Sustainable Development Goal
    $model['general']['sustainable']['development']['goal'] = new SustainableDevelopmentGoalView();

    //Get General General Sustainable Development Goal
    $data['general']['sustainable']['development']['goal'] = $model['general']['sustainable']['development']['goal']->selectBox();

    //Set Model
    $model['cervie']['researcher']['community']['engagement'] = new CervieResearcherCommunityEngagementProcedure();

    //Read Main
    $data['main'] = $model['cervie']['researcher']['community']['engagement']->readRecord(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'community_engagement_id'=>$request->id
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
          'table_name'=>'cervie_researcher_community_engagement',
          'table_id'=>$request->id
        ]
      ]
    );

    //Set Model
     $model['cervie']['researcher']['team']['member'] = new CervieResearcherTeamMemberProcedure();

     //Read Evidence
     $data['team_member'] = $model['cervie']['researcher']['team']['member']->readRecordByResearcherTable(
       [
         'column'=>[
           'employee_id'=>Auth::id(),
           'table_name'=>'cervie_researcher_community_engagement',
           'table_id'=>$request->id
         ]
       ]
     );

     //Set Model General Sustainable Development Goal
     $model['general']['sustainable']['development']['goal'] = new SustainableDevelopmentGoalView();

     //Get General General Sustainable Development Goal
     $data['general']['sustainable']['development']['goal'] = $model['general']['sustainable']['development']['goal']->selectBox();
 // dd($data['general']['sustainable']['development']['goal']);

     if($data['main']->need_verification){

       //Set Model Researcher - Employee Profile
       $model['cervie']['researcher']['log'] = new CervieResearcherLogProcedure();

       //Get Employee Profile
       $data['cervie']['researcher']['log']['community']['engagement'] = $model['cervie']['researcher']['log']->readRecord(
         [
           'column'=>[
             'employee_id'=>$request->employee_id,
             'table_name'=>'cervie_researcher_community_engagement',
             'auditable_id' => $request->id,
             'category' => 'main'
           ]
         ]
       );

       //Get Log Evidence
       $data['cervie']['researcher']['log']['evidence'] = $model['cervie']['researcher']['log']->readRecord(
         [
           'column'=>[
             'employee_id'=>$request->employee_id,
             'main_table_name'=>'cervie_researcher_community_engagement',
             'table_name'=>'cervie_researcher_evidence',
             'auditable_id' => $request->id,
             'category' => 'evidence',
             'event' => 'create'
           ]
         ]
       );

       //Get Log Evidence
       $data['cervie']['researcher']['log']['team']['member'] = $model['cervie']['researcher']['log']->readRecord(
         [
           'column'=>[
             'employee_id'=>$request->employee_id,
             'main_table_name'=>'cervie_researcher_community_engagement',
             'table_name'=>'cervie_researcher_team_member',
             'auditable_id' => $request->id,
             'category' => 'team_member',
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
         'icon'=>'<i class="mdi mdi-file-account"></i>',
         'name'=>' File',
       ],
       2=>[
         'icon'=>'<i class="mdi mdi-settings"></i>',
         'name'=>' Control',
       ]
     ];

     //Defined Column
     $data['table']['column']['cervie']['researcher']['team']['member'] = [
       0=>[
         'icon'=>'<i class="mdi mdi-numeric"></i>',
         'name'=>'No',
       ],
       1=>[
         'class'=>'col-6',
         'icon'=>'<i class="mdi mdi-account-group"></i>',
         'name'=>' Name',
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
    $asset['document'] = '/public/resources/researcher/'.$request->employee_id.'/document/community_engagement/'.$request->id.'/';

    //Set Document
    $hyperlink['document'] = $request->root().'/storage/resources/researcher/'.$request->employee_id.'/document/community_engagement/'.$request->id.'/';


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

      //Convert array to string with commas separating the values
      $sustainable_development_goal = (($request->has('sustainable_development_goal_id'))?implode(',',$request->sustainable_development_goal_id):null);

      //Get Award Type
      $this->getValidateData($request);

      //Set Model
      $model['cervie']['researcher']['community']['engagement'] = new CervieResearcherCommunityEngagementProcedure();

      //Create Main
      $result['main']['update'] = $model['cervie']['researcher']['community']['engagement']->updateRecord(
        [
          'column'=>[
            'employee_id'=>Auth::id(),
            'community_engagement_id'=>$request->id,
            'organization'=>($request->has('organization')?$request->organization:null),
            'project_name'=>($request->has('project_name')?$request->project_name:null),
            'sponsor'=>($request->has('sponsor')?$request->sponsor:null),
            'amount'=>($request->has('amount')?$request->amount:null),
            'description'=>($request->has('description')?$request->description:null),
            'date_start'=>($request->has('date_start')?$request->date_start:null),
            'date_end'=>($request->has('date_end')?$request->date_end:null),
            'star_rating'=>($request->has('star_rating')?$request->star_rating:null),
            'sustainable_development_goal'=>$sustainable_development_goal,
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
            'table_name'=>'cervie_researcher_community_engagement',
            'table_id'=>$request->id,
            'need_verification'=>0,
            'remark'=>(($request->remark)?$request->remark:null),
            'remark_user'=>(($request->remark_user)?$request->remark_user:null),
            'updated_by'=>Auth::id(),
          ]
        ]
      );

      //Set Model Evidence
      $model['cervie']['researcher']['team']['member'] = new CervieResearcherTeamMemberProcedure();

      //Create Evidence
      $result['evidence']['team']['member']  = $model['cervie']['researcher']['team']['member'] ->updateRecord(
        [
          'column'=>[
            'employee_id'=>$request->employee_id,
            'table_name'=>'cervie_researcher_community_engagement',
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
                  'table_name'=>'cervie_researcher_community_engagement',
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
            $path['folder'] = 'public/resources/researcher/'.$request->employee_id.'/document/community_engagement/'.$request->id.'/';

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
                  'table_name' => 'cervie_researcher_community_engagement',
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

        //If Files Exist
        if($request->has('team_member_name')){

          //Get File Loop
          foreach($request->team_member_name as $key=>$value){

            //Set Model Evidence
            $model['cervie']['researcher']['team']['member'] = new CervieResearcherTeamMemberProcedure();

            //Create Evidence
            $result['team']['member']['create'] = $model['cervie']['researcher']['team']['member']->createRecord(
              [
                'column'=>[
                  'employee_id'=>Auth::id(),
                  'name'=>$value,
                  'representation_role_id'=>(isset($request->representation_role_id[$key]) ? $request->representation_role_id[$key]:null),
                  'role'=>(isset($request->role[$key]) ? $request->role[$key]:null),
                  'table_name'=>'cervie_researcher_community_engagement',
                  'table_id'=>$request->id,
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
    return redirect()->route($hyperlink['page']['view'],['organization_id'=>$request->organization_id,'employee_id'=>$request->employee_id,'id'=>$request->id])
                     ->with('alert_type','success')
                     ->with('message','Researcher Community Engagement Saved');

  }

  /**************************************************************************************
      Get Data Table
  **************************************************************************************/
  public function getDataTable(){

      //Defined Column
      $table = [
          0 => [
              'category' => 'checkbox',
              'checkbox' => '<div class="form-check">
                              <input type="checkbox" id="selectAll" name="id[]" class="form-check-input selectBox">
                            </div>',
              'icon' => '<i class="bi bi-numeric"></i>',
              'name' => 'No',
          ],
          1 => [
              'icon' => '<i class="bi bi-person-badge"></i>', // Project Name icon
              'name' => 'Project Name',
          ],
          2 => [
              'icon' => '<i class="bi bi-building"></i>', // Organization icon
              'name' => 'Organization',
          ],
          3 => [
              'icon' => '<i class="bi bi-calendar"></i>', // Date Start icon
              'name' => 'Date Start',
          ],
          4 => [
              'icon' => '<i class="bi bi-calendar-check"></i>', // Date End icon
              'name' => 'Date End',
          ],
          5 => [
              'icon' => '<i class="bi bi-shield-check"></i>', // Verification icon
              'name' => 'Verification',
          ],
          6 => [
              'icon' => '<i class="bi bi-sliders"></i>', // Control icon
              'name' => 'Control',
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
    $model['cervie']['researcher']['community']['engagement'] = new CervieResearcherCommunityEngagementView();

    //Set Data
    $data = $model['cervie']['researcher']['community']['engagement']->getList(
      [
        'type'=>((isset($data['type']))?$data['type']:null),
        'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
        'column'=>((isset($data['column']))?$data['column']:null),
        'category'=>'COMMUNITY_ENGAGEMENT'

      ]
    );

    return $data;

  }

  /**************************************************************************************
 		Validate Data
 	**************************************************************************************/
  public function getValidateData(Request $request){

    //Define Validation Rules
    $rules = [
      'organization'=>['required'],
      'project_name'=>['required'],
      'sponsor'=>['required'],
      'amount'=>['required'],
      'description'=>['required'],
      'date_start' => ['required','date'],
      'date_end' => ['required','date'],
      'date_end' => ['required','date'],
      'star_rating'=>['required'],
      'document.*'=>['required','mimes:pdf','max:3072'], // Validate each file in the array
      'document_name.*'=>['required'], // Validate that each file has an associated name
    ];

    //Custom Validation Messages
    $messages = [
      'organization.required'=>'Organization is required',
      'project_name.required'=>'Project Name is required',
      'sponsor.required'=>'Sponsor is required',
      'amount.required'=>'Amount is required',
      'description.required'=>'Description is required',
      'date_start.required'=>'Date Start is Required',
      'date_end.required'=>'Date End is Required',
      'star_rating.required'=>'Star Rating is Required',
    ];

    //If Document Name Exist
    if($request->has('document_name')){

      //Get Document Name
      foreach($request->document_name as $key=>$value){
        $messages['document.'.$key.'.required'] = 'Evidence item '.($key + 1).': File is required';
        $messages['document.'.$key.'.mimes'] = 'Evidence item '.($key + 1).': File must be a PDF';
        $messages['document.'.$key.'.max'] = 'Evidence item '.($key + 1).': File size cannot exceed 3MB';
        $messages['document_name.'.$key.'.required'] = 'Evidence item '.($key + 1).': File name is required';
      }

    }

    //Create A Validator Instance
    $validator = Validator::make($request->all(), $rules, $messages);

    //Run The Validation
    $validator->validate();

  }

  /**************************************************************************************
    Delete
  **************************************************************************************/
  public function deleteTeamMember(Request $request){
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
        $model['cervie']['researcher']['team']['member'] = new CervieResearcherTeamMemberProcedure();

        //Set Main
        $data['team_member'] = $model['cervie']['researcher']['team']['member']->readRecord(
          [
            'column'=>[
              'team_member_id'=>$request->team_member_id,
              'employee_id'=>Auth::id()
            ]
          ]
        );

        //Delete Record
        $result['team_member']['delete'] = $model['cervie']['researcher']['team']['member']->deleteRecord(
          [
            'column'=>[
              'team_member_id'=>$data['team_member']->team_member_id,
              'employee_id'=>Auth::id()
            ]
          ]
        );

        //Set Model
        $model['cervie']['researcher']['community']['engagement'] = new CervieResearcherCommunityEngagementProcedure();

        //Set Main Verification
        $data['main']['verification'] = $model['cervie']['researcher']['community']['engagement']->needVerification(
          [
            'column'=>[
              'community_engagement_id'=>$data['team_member']->table_id,
              'employee_id'=>Auth::id(),
              'need_verification'=>0,
              'updated_by'=>Auth::id()
            ]
          ]
        );

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['view'],['organization_id'=>$request->organization_id,'employee_id'=>$request->employee_id,'id'=>$request->id])
                     ->with('alert_type','success')
                     ->with('message','Team Member Deleted');

  }

}
