<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Grant;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model View
use App\Models\UCSI_V2_General\MSSQL\View\RepresentationCategory AS RepresentationCategoryView;
use App\Models\UCSI_V2_General\MSSQL\View\RepresentationRole AS RepresentationRoleView;
use App\Models\UCSI_V2_General\MSSQL\View\CurrencyCode AS CurrencyCodeView;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherGrant AS CervieResearcherGrantView;
use App\Models\UCSI_V2_General\MSSQL\View\SustainableDevelopmentGoal AS SustainableDevelopmentGoalView;
use App\Models\UCSI_V2_Education\MSSQL\View\Status AS StatusView;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTableControl AS CervieResearcherTableControlProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherGrant AS CervieResearcherGrantProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherEvidence AS CervieResearcherEvidenceProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTeamMember AS CervieResearcherTeamMemberProcedure;

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
  protected $user = 'researcher';

  //Path Header
	protected $header = [
		'application'=>'Dashboard',
    'category'=>'Grant',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.grant.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.grant.';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Set Navigation
		$this->page['sub'] = $this->route['view'];

    //Set Navigation
    $this->hyperlink['page']['new'] = $this->route['name'].'new';
    $this->hyperlink['page']['create'] = $this->route['name'].'create';
		$this->hyperlink['page']['list'] = $this->route['name'].'list';
    $this->hyperlink['page']['delete']['main'] = $this->route['name'].'delete';
    $this->hyperlink['page']['delete']['team']['member'] = $this->route['name'].'team_member.delete';
    $this->hyperlink['page']['delete']['evidence'] = $this->route['name'].'evidence.delete';
    $this->hyperlink['page']['view'] = $this->route['name'].'view';
    $this->hyperlink['page']['update'] = $this->route['name'].'update';

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

    //Set Page Sub
    $page['sub'] .= 'new.sub';

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-house"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = ['Welcome Back, '.Auth::user()->name];

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

    //Set Model General Award Type
    $model['general']['representation']['category'] = new RepresentationCategoryView();

    //Get General Award Type
    $data['general']['representation']['category'] = $model['general']['representation']['category']->selectBox(
      [
        'column'=>[
          'category'=>'GRANT'
        ]
      ]
    );

    //Set Model General Award Type
    $model['general']['representation']['role'] = new RepresentationRoleView();

    //Get General Award Type
    $data['general']['representation']['role'] = $model['general']['representation']['role']->selectBox(
      [
        'column'=>[
          'category'=>'GRANT'
        ]
      ]
    );

    //Set Model General Currency Code
    $model['general']['currency']['code'] = new CurrencyCodeView();

    //Get General Grant Category
    $data['general']['currency']['code'] = $model['general']['currency']['code']->selectBox();

    //Set Model
    $model['cervie']['researcher']['table']['control'] = new CervieResearcherTableControlProcedure();

    //Get Table Control
    $data['cervie']['researcher']['table']['control'] = $model['cervie']['researcher']['table']['control']->readRecord(
      [
        'column'=>[
          'table_control_id'=>'cervie_researcher_grant'
        ]
      ]
    );

    //Set Model General Sustainable Development Goal
    $model['general']['sustainable']['development']['goal'] = new SustainableDevelopmentGoalView();

    //Get General General Sustainable Development Goal
    $data['general']['sustainable']['development']['goal'] = $model['general']['sustainable']['development']['goal']->selectBox();

    //Set Model General Status
    $model['general']['status'] = new StatusView();

    //Get General Status
    $data['general']['status'] = $model['general']['status'] ->selectBox(
      [
        'column'=>[
          'table'=>'cervie_researcher_grant'
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
        'icon'=>'<i class="mdi mdi-account-group"></i>',
        'name'=>' Member',
      ],
      3=>[
        'icon'=>'<i class="mdi mdi-settings"></i>',
        'name'=>' Control',
      ]
    ];


    //Get Form Token
		$form_token = $this->encrypt_token_form;

		//Return View
		return view($this->route['view'].'new.index',compact('data','form_token','page','hyperlink'));

  }

  /**************************************************************************************
 		Validate Data
 	**************************************************************************************/
  public function getValidateData(Request $request){

    //Define Validation Rules
    $rules = [
      'representation_role_id'=>['required'],
      'representation_category_id'=>['required'],
      'title'=>['required'],
      'date_start' => ['required','date'],
      'date_end' => ['nullable','date','after:date_start'],
      'is_ongoing'=>['boolean'], // Not required, but must be boolean if present
      'quantum'=>['required'],
      'currency_code_id'=>['required'],
      'sustainable_development_goal_id'=>['nullable'],
      'document.*'=>['required','mimes:pdf','max:3072'], // Validate each file in the array
      'document_name.*'=>['required'], // Validate that each file has an associated name
    ];

    //Custom Validation Messages
    $messages = [
      'representation_role_id.required'=>'Project Role is required',
      'representation_category_id.required'=>'Grant Category is required',
      'title.required'=>'Award Title is required',
      'date_start.required'=>'Date Start is Required',
      'date_end.required'=>'Date End is Required',
      'date_start.date'=>'Date Start Must Be Date Format',
      'date_end.date'=>'Date End Must Be Date Format',
      'date_end.after'=>'Date End must be after Date Start',
      'quantum.required'=>'Quantum is Required',
      'currency_code_id.required'=>'Currency Code is Required',
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

    //Custom rule: either date end or is on going must be present (but not both)
    $validator->after(function ($validator) use ($request) {

      $date_end = $request->input('date_end');
      $is_ongoing = $request->input('is_ongoing');

      //Check if both date end and is on going are empty
      if(empty($date_end) && empty($is_ongoing)){
        $validator->errors()->add('date_or_work', 'Either Date End or Is Going must be provided.');
      }

      //Check if both fields are filled
      if(!empty($date_end) && !empty($is_ongoing)){
        $validator->errors()->add('date_or_work', 'Only one of Date End or Is Going should be provided.');
      }

    });

    //Run The Validation
    $validator->validate();

  }

  /**************************************************************************************
 		Create
 	**************************************************************************************/
	public function create(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Get Award Type
    $this->getValidateData($request);

    //If Form Token Exist
		if(!$request->has('form_token')){abort(555,'Form Token Missing');}

		//Check Type Request
		switch($this->encrypter->decrypt($request->form_token)){

      //Create
      case 'create':

      //Convert array to string with commas separating the values
      $sustainable_development_goal = (($request->has('sustainable_development_goal_id'))?implode(',',$request->sustainable_development_goal_id):null);

        //Set Model
        $model['cervie']['researcher']['grant'] = new CervieResearcherGrantProcedure();

        //Create Main
        $result['main']['create'] = $model['cervie']['researcher']['grant']->createRecord(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'representation_role_id'=>($request->has('project_representation_role_id')?$request->project_representation_role_id:null),
              'status_id'=>($request->has('status_id')?$request->status_id:null),
              'date_start'=>($request->has('date_start')?$request->date_start:null),
              'date_end'=>($request->has('date_end')?$request->date_end:null),
              'title'=>($request->has('title')?$request->title:null),
              'is_ongoing'=>(($request->is_ongoing)?1:0),
              'currency_code_id'=>($request->has('currency_code_id')?$request->currency_code_id:null),
              'quantum'=>($request->has('quantum')?$request->quantum:null),
              'representation_category_id'=>($request->has('representation_category_id')?$request->representation_category_id:null),
              'sustainable_development_goal'=>$sustainable_development_goal,
              'need_verification'=>1,
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
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/grant/'.$result['main']['create']->last_insert_id.'/';

            //Set Modified File Name Without Extension (Using last_insert_id)
            $file['name']['modified']['without']['extension'] = ($key+1);

            //Set Modified File Name With Extension
            $file['name']['modified']['with']['extension'] = $file['name']['modified']['without']['extension'].'.'.$file['extension'];

            //Set The Full Upload Path
            $path['upload'] = $path['folder'].$file['name']['modified']['with']['extension'];

            //Check If The File Already Exists In Storage
            $check['exist']['storage'] = Storage::disk()->exists($path['upload']);

            //If File Exists, Delete It
            if($check['exist']['storage']){Storage::disk()->delete($path['upload']);}

            //Store File
            Storage::disk()->put($path['upload'], fopen($value,'r+'));

            //Set Model Evidence
            $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

            //Create Evidence
            $result['evidence']['create'] = $model['cervie']['researcher']['evidence']->createRecord(
              [
                'column'=>[
                  'employee_id'=>Auth::id(),
                  'file_id'=>$file['name']['modified']['without']['extension'],
                  'file_name'=>(($request->document_name[$key])?$request->document_name[$key]:null),
                  'file_raw_name'=>$file['name']['raw']['without']['extension'],
                  'file_extension'=>$file['extension'],
                  'table_name'=>'cervie_researcher_grant',
                  'table_id'=>$result['main']['create']->last_insert_id,
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
                 'representation_role_id'=>$request->representation_role_id[$key],
                 'table_name'=>'cervie_researcher_grant',
                 'table_id'=>$result['main']['create']->last_insert_id,
                 'remark'=>(($request->remark)?$request->remark:null),
                 'remark_user'=>(($request->remark_user)?$request->remark_user:null),
                 'created_by'=>Auth::id(),
               ]
             ]
           );

         }

       }


      break;

      //Default
      default:

        //Abort
        abort(555,'Form Token Missing');

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['list'])
                     ->with('alert_type','success')
                     ->with('message','Grant Added');

  }

  /**************************************************************************************
 		List
 	**************************************************************************************/
  public function list(Request $request)
  {
      // Get Route Path
      $this->routePath();

      // Set Hyperlink
      $hyperlink = $this->hyperlink;

      // Set Page Sub
      $page = $this->page;
      $page['sub'] .= 'list.sub';

      // Set Breadcrumb Icon
      $data['breadcrumb']['icon'] = '<i class="bi bi-house"></i>';

      // Set Breadcrumb Title
      $data['breadcrumb']['title'] = ['Welcome Back, ' . Auth::user()->name];

      // Set Breadcrumb
      $data['title'] = array($this->header['category']);

      // Set Model Award
      $model['cervie']['researcher']['grant'] = new CervieResearcherGrantView();
      $model['cervie']['researcher']['ongoing'] = new CervieResearcherGrantProcedure();

      // Set Main Data Researcher Grant List
      $data['main']['cervie']['researcher']['grant'] = $model['cervie']['researcher']['grant']->getList(
          [
              'eloquent'=>'pagination',
              'column'=>[
                  'employee_id'=>Auth::id(),
              ]
          ]
      );

      // Set Table Researcher Grant
      $data['table']['column']['cervie']['researcher']['grant'] = $this->getDataTable();

      // Set Main Data Researcher Ongoing Grants
      $ongoingGrants = $model['cervie']['researcher']['ongoing']->readRecordOngoing(
          [
              'column'=>[
                  'employee_id'=>Auth::id(),
              ]
          ]
      );


      // // Calculate Progress for Ongoing Grants
      // $data['main']['cervie']['researcher']['ongoing'] = [];
      // foreach ($ongoingGrants as $grant) {
      //     $startDate = Carbon::parse($grant->date_start);
      //     $endDate = Carbon::parse($grant->date_end);
      //     $currentDate = Carbon::now();
      //
      //     // Calculate total duration
      //     $totalDays = $endDate->diffInDays($startDate);
      //
      //     // Calculate days passed since the start date
      //     $daysPassed = max(0, $currentDate->diffInDays($startDate));
      //
      //     // Initialize progress percentage
      //     $progressPercentage = 0;
      //
      //     if ($currentDate < $startDate) {
      //         // Before start date: 0%
      //         $progressPercentage = 0;
      //     } elseif ($currentDate >= $startDate && $currentDate <= $endDate) {
      //         // Between start and end date: calculate progress
      //         $progressPercentage = ($daysPassed / $totalDays) * 100;
      //     } else {
      //         // After end date: 100%
      //         $progressPercentage = 100;
      //     }
      //
      //     // Ensure progress does not go below 0 or above 100
      //     $progressPercentage = max(0, min(100, round($progressPercentage)));
      //
      //     // Store grant progress data
      //     $data['main']['cervie']['researcher']['ongoing'][] = [
      //         'grant_id'=>$grant->grant_id,
      //         'grant_title'=>$grant->title,
      //         'progress'=>$progressPercentage,
      //         'date_start'=>$grant->date_start,
      //         'date_end'=>$grant->date_end,
      //     ];
      // }

      $data['main']['cervie']['researcher']['ongoing'] = [];
foreach ($ongoingGrants as $grant) {
    $startDate = Carbon::parse($grant->date_start);
    $currentDate = Carbon::now();

    // Initialize progress percentage
    $progressPercentage = 0;

    if ($currentDate < $startDate) {
        // Before start date: 0%
        $progressPercentage = 0;
    } else {
        // After start date: calculate progress
        // Assume a total duration (for example, 1 year or 365 days)
        $totalDays = 365; // You can adjust this based on your requirements

        // Calculate days passed since the start date
        $daysPassed = $currentDate->diffInDays($startDate);

        // Calculate progress as a percentage of total duration
        $progressPercentage = ($daysPassed / $totalDays) * 100;

        // Ensure progress does not go below 0 or above 100
        $progressPercentage = max(0, min(100, round($progressPercentage)));
    }

    // Store grant progress data
    $data['main']['cervie']['researcher']['ongoing'][] = [
        'grant_id' => $grant->grant_id,
        'grant_title' => $grant->title,
        'progress' => $progressPercentage,
        'date_start' => $grant->date_start,
    ];
}

      // Get Form Token
      $form_token = $this->encrypt_token_form;

      // Return View
      return view($this->route['view'] . 'list.index', compact('data', 'form_token', 'page', 'hyperlink'));
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
        $model['cervie']['researcher']['grant'] = new CervieResearcherGrantProcedure();

        //Delete Main
        $result['main']['delete'] = $model['cervie']['researcher']['grant']->deleteRecord(
          [
            'column'=>[
              'grant_id'=>$request->id,
              'employee_id'=>Auth::id()
            ]
          ]
        );

        //Set Path Folder
        $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/grant/'.$request->id.'/';

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
              'employee_id'=>Auth::id(),
              'table_name'=>'cervie_researcher_grant',
              'table_id'=>$request->id
            ]
          ]
        );

        //Set Model
        $model['cervie']['researcher']['grant'] = new CervieResearcherGrantProcedure();

        //Delete Evidence
        $data['main']['verification'] = $model['cervie']['researcher']['grant']->needVerification(
          [
            'column'=>[
              'grant_id'=>$request->id,
              'employee_id'=>Auth::id(),
              'need_verification'=>1,
              'updated_by'=>Auth::id()
            ]
          ]
        );

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['list'])
                     ->with('alert_type','success')
                     ->with('message','Grant Deleted');

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
              'employee_id'=>Auth::id()
            ]
          ]
        );

        //Set Path Folder
        $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/grant/'.$data['evidence']->table_id.'/';

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
              'employee_id'=>Auth::id()
            ]
          ]
        );

        //Set Model
        $model['cervie']['researcher']['grant'] = new CervieResearcherGrantProcedure();

        //Set Main Verification
        $data['main']['verification'] = $model['cervie']['researcher']['grant']->needVerification(
          [
            'column'=>[
              'grant_id'=>$data['evidence']->table_id,
              'employee_id'=>Auth::id(),
              'need_verification'=>1,
              'updated_by'=>Auth::id()
            ]
          ]
        );

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['view'],['id'=>$request->id])
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

    //Set Page Sub
    $page = $this->page;

    //Set Page Sub
    $page['sub'] .= 'view.sub';

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-house"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = ['Welcome Back, '.Auth::user()->name];

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

    //Set Model
    $model['cervie']['researcher']['table']['control'] = new CervieResearcherTableControlProcedure();

    //Get Table Control
    $data['cervie']['researcher']['table']['control'] = $model['cervie']['researcher']['table']['control']->readRecord(
      [
        'column'=>[
          'table_control_id'=>'cervie_researcher_grant'
        ]
      ]
    );

    //Set Model General - Representation Category
    $model['general']['representation']['category'] = new RepresentationCategoryView();

    //Get General - Representation Category
    $data['general']['representation']['category'] = $model['general']['representation']['category']->selectBox(
      [
        'column'=>[
          'category'=>'GRANT'
        ]
      ]
    );

    //Set Model General - Representation Role
    $model['general']['representation']['role'] = new RepresentationRoleView();

    //Get General - Representation Role
    $data['general']['representation']['role'] = $model['general']['representation']['role']->selectBox(
      [
        'column'=>[
          'category'=>'GRANT'
        ]
      ]
    );

    //Set Model General - Currency Code
    $model['general']['currency']['code'] = new CurrencyCodeView();

    //Get General - Currency Code
    $data['general']['currency']['code'] = $model['general']['currency']['code']->selectBox();

    //Set Model General Sustainable Development Goal
    $model['general']['sustainable']['development']['goal'] = new SustainableDevelopmentGoalView();

    //Get General General Sustainable Development Goal
    $data['general']['sustainable']['development']['goal'] = $model['general']['sustainable']['development']['goal']->selectBox();

    //Set Model General Status
    $model['general']['status'] = new StatusView();

    //Get General Status
    $data['general']['status'] = $model['general']['status']->selectBox(
      [
        'column'=>[
          'table'=>'cervie_researcher_grant'
        ]
      ]
    );

    //Set Model
    $model['cervie']['researcher']['grant'] = new CervieResearcherGrantProcedure();

    //Read Main
    $data['main'] = $model['cervie']['researcher']['grant']->readRecord(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'grant_id'=>$request->id
        ]
      ]
    );

    //Set Model
    $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

    //Read Evidence
    $data['evidence'] = $model['cervie']['researcher']['evidence']->readRecordByResearcherTable(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'table_name'=>'cervie_researcher_grant',
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
           'table_name'=>'cervie_researcher_grant',
           'table_id'=>$request->id
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
         'class'=>'col-4',
         'icon'=>'<i class="mdi mdi-account-group"></i>',
         'name'=>' Name',
       ],
       2=>[
         'class'=>'col-4',
         'icon'=>'<i class="mdi mdi-badge-account"></i>',
         'name'=>' Role',
       ],
       3=>[
         'icon'=>'<i class="mdi mdi-settings"></i>',
         'name'=>' Control',
       ]
     ];


    //Set Asset
    $asset['document'] = '/public/resources/researcher/'.trim(Auth::id()).'/document/grant/'.$request->id.'/';

    //Set Document
    $hyperlink['document'] = $request->root().'/public/storage/resources/researcher/'.trim(Auth::id()).'/document/grant/'.$request->id.'/';

    //Get Form Token
		$form_token = $this->encrypt_token_form;

  	//Return View
		return view($this->route['view'].'view.index',compact('data','page','asset','form_token','hyperlink'));

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
        $model['cervie']['researcher']['grant'] = new CervieResearcherGrantProcedure();

        //Create Main
        $result['main']['update'] = $model['cervie']['researcher']['grant']->updateRecord(
          [
            'column'=>[
              'grant_id'=>$request->id,
              'employee_id'=>Auth::id(),
              'representation_role_id'=>($request->has('project_representation_role_id')?$request->project_representation_role_id:null),
              'status_id'=>($request->has('status_id')?$request->status_id:null),
              'date_start'=>($request->has('date_start')?$request->date_start:null),
              'date_end'=>($request->has('date_end')?$request->date_end:null),
              'is_ongoing'=>(($request->is_ongoing)?1:0),
              'title'=>($request->has('title')?$request->title:null),
              'currency_code_id'=>($request->has('currency_code_id')?$request->currency_code_id:null),
              'quantum'=>($request->has('quantum')?$request->quantum:null),
              'representation_category_id'=>($request->has('representation_category_id')?$request->representation_category_id:null),
              'sustainable_development_goal'=>$sustainable_development_goal,
              'need_verification'=>1,
              'remark'=>(($request->remark)?$request->remark:null),
              'remark_user'=>(($request->remark_user)?$request->remark_user:null),
              'updated_by'=>Auth::id()
            ]
          ]
        );

        //If Files Exist
        if($request->has('document')){

          //Get File Loop
          foreach($request->file('document') as $key=>$value){

            //Set Model
            $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

            //Read Evidence Current
            $data['evidence'] = $model['cervie']['researcher']['evidence']->readRecordByResearcherTable(
              [
                'column'=>[
                  'employee_id'=>Auth::id(),
                  'table_name'=>'cervie_researcher_grant',
                  'table_id'=>$request->id
                ]
              ]
            );

            //Set Counter
            $counter = ((count($data['evidence']) == $key)?$key:count($data['evidence']));

            //Set file name with extension
            $file['name']['raw']['with']['extension'] = $value->getClientOriginalName();

            //Set file name without extension
            $file['name']['raw']['without']['extension'] = pathinfo($file['name']['raw']['with']['extension'], PATHINFO_FILENAME);

            //Get file extension
            $file['extension'] = $value->getClientOriginalExtension();

            //Set path folder
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/grant/'.$request->id.'/';

            //Set modified file name without extension (using last_insert_id)
            $file['name']['modified']['without']['extension'] = ($counter+1);

            //Set modified file name with extension
            $file['name']['modified']['with']['extension'] = $file['name']['modified']['without']['extension'].'.'.$file['extension'];

            //Set the full upload path
            $path['upload'] = $path['folder'].$file['name']['modified']['with']['extension'];

            //Check if the file already exists in storage
            $check['exist']['storage'] = Storage::disk()->exists($path['upload']);

            //If the file exists, delete it
            if($check['exist']['storage']){Storage::disk()->delete($path['upload']);}

            //Store the file in storage (you may use `fopen` if needed for specific storages)
            Storage::disk()->put($path['upload'],fopen($value,'r+'));

            //Set the model and create a new record in the database
            $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

            //Create Evidence Upload
            $data['evidence']['upload'] = $model['cervie']['researcher']['evidence']->createRecord(
              [
                'column'=>[
                  'employee_id'=>Auth::id(),
                  'file_id'=>$file['name']['modified']['without']['extension'],
                  'file_name'=>(($request->document_name[$key])?$request->document_name[$key]:null),
                  'file_raw_name'=>$file['name']['raw']['without']['extension'],
                  'file_extension'=>$file['extension'],
                  'table_name'=>'cervie_researcher_grant',
                  'table_id'=>$request->id,
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
                  'representation_role_id'=>$request->representation_role_id[$key],
                  'table_name'=>'cervie_researcher_grant',
                  'table_id'=>$request->id,
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
    return redirect()->route($hyperlink['page']['view'],['id'=>$request->id])
                     ->with('alert_type','success')
                     ->with('message','Grant Saved');

  }

  /**************************************************************************************
 		Get Data Table
 	**************************************************************************************/
  public function getDataTable(){

    //Defined Column
    $table = [
      0=>[
        'icon'=>'<i class="mdi mdi-numeric"></i>',
        'name'=>'No',
      ],
      1=>[
        'icon'=>'<i class="mdi mdi-account-card-details"></i>',
        'name'=>' Type',
      ],
      2=>[
        'icon'=>'<i class="mdi person-supervisor-circle"></i>',
        'name'=>' Title',
      ],
      3=>[
        'icon'=>'<i class="mdi mdi-certificate"></i>',
        'name'=>' Role',
      ],
      4=>[
        'icon'=>'<i class="mdi mdi-currency-usd"></i>',
        'name'=>' Quantum',
      ],
      5=>[
        'icon'=>'<i class="mdi mdi-google-earth"></i>',
        'name'=>' SDG',
      ],
      6=>[
        'icon'=>'<i class="mdi mdi-shield-check"></i>',
        'name'=>' Verfication',
      ],
      7=>[
        'icon'=>'<i class="mdi mdi-settings"></i>',
        'name'=>' Control',
      ]
    ];

    //Return Table
    return $table;

  }

}
