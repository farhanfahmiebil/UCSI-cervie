<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Consultancies;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model View
use App\Models\UCSI_V2_General\MSSQL\View\Country AS CountryView;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherConsultancies AS CervieResearcherConsultanciesView;
use App\Models\UCSI_V2_General\MSSQL\View\RepresentationRole AS RepresentationRoleView;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTableControl AS CervieResearcherTableControlProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherConsultancies AS CervieResearcherConsultanciesProcedure;
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
    'category'=>'Consultancies',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.consultancies.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.consultancies.';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Set Navigation
		$this->page['sub'] = $this->route['view'];

    //Set Navigation
    $this->hyperlink['page']['new'] = $this->route['name'].'new';
    $this->hyperlink['page']['create'] = $this->route['name'].'create';
		$this->hyperlink['page']['list'] = $this->route['name'].'list';
    $this->hyperlink['page']['delete']['main'] = $this->route['name'].'delete';
    $this->hyperlink['page']['delete']['evidence'] = $this->route['name'].'evidence.delete';
    $this->hyperlink['page']['delete']['team']['member'] = $this->route['name'].'team_member.delete';
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

    //Set Model
    $model['cervie']['researcher']['table']['control'] = new CervieResearcherTableControlProcedure();

    //Get Table Control
    $data['cervie']['researcher']['table']['control'] = $model['cervie']['researcher']['table']['control']->readRecord(
      [
        'column'=>[
          'table_control_id'=>'cervie_researcher_consultancies'
        ]
      ]
    );

    //Set Model General Country
    $model['general']['country'] = new CountryView();

    //Set Model General Country
    $data['general']['country'] = $model['general']['country']->selectBox();

    //Set Model General Representation Role
    $model['general']['representation']['role'] = new RepresentationRoleView();

    //Get General Representation Role
    $data['general']['representation']['role'] = $model['general']['representation']['role']->selectBox(
      [
        'column'=>[
          'category'=>'CONSULTANCIES'
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
        'icon'=>'<i class="mdi mdi-file-account-outline"></i>',
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
      'client'=>['required'],
      'title'=>['required'],
      'amount'=>['required'],
      'description'=>['required'],
      'reference_no'=>['required'],
      'date_start' => ['required','date'],
      'date_end' => ['required','date'],
      'document.*'=>['required','mimes:pdf','max:3072'], // Validate each file in the array
      'document_name.*'=>['required'], // Validate that each file has an associated name
      'team_member_name.*'=>['required'], // Validate that each team member has an associated name
      'representation_role_id.*'=>['required'], // Validate that each team member has an associated role

    ];

    //Custom Validation Messages
    $messages = [
      'client.required'=>'Client is required',
      'title.required'=>'Title is required',
      'amount.required'=>'Amount is required',
      'reference_no.required'=>'Reference No is required',
      'description.required'=>'Description is required',
      'date_start.required'=>'Date Start is required',
      'date_end.required'=>'Date End is Required',
    ];

    //If Document Name Exist
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

    //Create A Validator Instance
    $validator = Validator::make($request->all(), $rules, $messages);

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
        $country = implode(',',$request->country);

        //Set Model
        $model['cervie']['researcher']['consultancies'] = new CervieResearcherConsultanciesProcedure();

        //Create Main
        $result['main']['create'] = $model['cervie']['researcher']['consultancies']->createRecord(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'client'=>($request->has('client')?$request->client:null),
              'title'=>($request->has('title')?$request->title:null),
              'amount'=>($request->has('amount')?$request->amount:null),
              'country'=>$country,
              'reference_no'=>($request->has('reference_no')?$request->reference_no:null),
              'description'=>($request->has('description')?$request->description:null),
              'date_start'=>($request->has('date_start')?$request->date_start:null),
              'date_end'=>($request->has('date_end')?$request->date_end:null),
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
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/consultancies/'.$result['main']['create']->last_insert_id.'/';

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
                  'table_name'=>'cervie_researcher_consultancies',
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
                  'table_name'=>'cervie_researcher_consultancies',
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
                     ->with('message','Consultancies Added');

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

    //Set Page Sub
    $page['sub'] .= 'list.sub';

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-house"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = ['Welcome Back, '.Auth::user()->name];

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

    //Set Model Award
    $model['cervie']['researcher']['consultancies'] = new CervieResearcherConsultanciesView();

    //Set Main Data Consultancies
    $data['main']['cervie']['researcher']['consultancies'] = $model['cervie']['researcher']['consultancies']->getList(
      [
        'eloquent'=>'pagination',
        'column'=>[
          'employee_id'=>Auth::id(),
        ]
      ]
    );

    //Set Table Researcher Publication
    $data['table']['column']['cervie']['researcher']['consultancies'] = $this->getDataTable();

    //Get Form Token
		$form_token = $this->encrypt_token_form;

		//Return View
		return view($this->route['view'].'list.index',compact('data','form_token','page','hyperlink'));

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
        $model['cervie']['researcher']['consultancies'] = new CervieResearcherConsultanciesProcedure();

        //Delete Main
        $result['main']['delete'] = $model['cervie']['researcher']['consultancies']->deleteRecord(
          [
            'column'=>[
              'consultancies_id'=>$request->id,
              'employee_id'=>Auth::id()
            ]
          ]
        );

        //Set Path Folder
        $path['folder'] = 'resources/researcher/'.trim(Auth::id()).'/document/consultancies/'.$request->id.'/';

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
              'table_name'=>'cervie_researcher_consultancies',
              'table_id'=>$request->id
            ]
          ]
        );

        //Set Model
        $model['cervie']['researcher']['consultancies'] = new CervieResearcherConsultanciesProcedure();

        //Delete Evidence
        $data['main']['verification'] = $model['cervie']['researcher']['consultancies']->needVerification(
          [
            'column'=>[
              'consultancies_id'=>$request->id,
              'employee_id'=>Auth::id(),
              'updated_by'=>Auth::id()
            ]
          ]
        );

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['list'])
                     ->with('alert_type','success')
                     ->with('message','Consultancies Deleted');

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
        $path['folder'] = 'resources/researcher/'.trim(Auth::id()).'/document/consultancies/'.$data['evidence']->table_id.'/';

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
        $model['cervie']['researcher']['consultancies'] = new CervieResearcherConsultanciesProcedure();

        //Set Main Verification
        $data['main']['verification'] = $model['cervie']['researcher']['consultancies']->needVerification(
          [
            'column'=>[
              'consultancies_id'=>$data['evidence']->table_id,
              'employee_id'=>Auth::id(),
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
        $model['cervie']['researcher']['consultancies'] = new CervieResearcherConsultanciesProcedure();

        //Set Main Verification
        $data['main']['verification'] = $model['cervie']['researcher']['consultancies']->needVerification(
          [
            'column'=>[
              'consultancies_id'=>$data['team_member']->table_id,
              'employee_id'=>Auth::id(),
              'updated_by'=>Auth::id()
            ]
          ]
        );

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['view'],['id'=>$request->id])
                     ->with('alert_type','success')
                     ->with('message','Team Member Deleted');

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
          'table_control_id'=>'cervie_researcher_consultancies'
        ]
      ]
    );

    //Set Model
    $model['cervie']['researcher']['consultancies'] = new CervieResearcherConsultanciesProcedure();

    //Read Main
    $data['main'] = $model['cervie']['researcher']['consultancies']->readRecord(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'consultancies_id'=>$request->id
        ]
      ]
    );

    //Set Model General Country
    $model['general']['country'] = new CountryView();

    //Set Model General Country
    $data['general']['country'] = $model['general']['country']->selectBox();

    //Set Model General Representation Role
    $model['general']['representation']['role'] = new RepresentationRoleView();

    //Get General Representation Role
    $data['general']['representation']['role'] = $model['general']['representation']['role']->selectBox(
      [
        'column'=>[
          'category'=>'CONSULTANCIES'
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
          'table_name'=>'cervie_researcher_consultancies',
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
          'table_name'=>'cervie_researcher_consultancies',
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
        'class'=>'col-4',
        'icon'=>'<i class="mdi mdi-file-account-outline"></i>',
        'name'=>' Name',
      ],
      2=>[
        'class'=>'col-4',
        'icon'=>'<i class="mdi mdi-file-account-outline"></i>',
        'name'=>' Role',
      ],
      3=>[
        'icon'=>'<i class="mdi mdi-settings"></i>',
        'name'=>' Control',
      ]
    ];

    //Set Asset
    $asset['document'] = '/public/resources/researcher/'.trim(Auth::id()).'/document/consultancies/'.$request->id.'/';

    //Set Document
    $hyperlink['document'] = $request->root().'/storage/resources/researcher/'.trim(Auth::id()).'/document/consultancies/'.$request->id.'/';
// dd($hyperlink['document'] );
    //Get Form Token
		$form_token = $this->encrypt_token_form;
// dd($data['main']->title);
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
        $country = implode(',',$request->country);

        //Get Award Type
        $this->getValidateData($request);

        //Set Model
        $model['cervie']['researcher']['consultancies'] = new CervieResearcherConsultanciesProcedure();

        //Create Main
        $result['main']['update'] = $model['cervie']['researcher']['consultancies']->updateRecord(
          [
            'column'=>[
              'consultancies_id'=>$request->id,
              'employee_id'=>Auth::id(),
              'client'=>($request->has('client')?$request->client:null),
              'title'=>($request->has('title')?$request->title:null),
              'amount'=>($request->has('amount')?$request->amount:null),
              'reference_no'=>($request->has('reference_no')?$request->reference_no:null),
              'description'=>($request->has('description')?$request->description:null),
              'date_start'=>($request->has('date_start')?$request->date_start:null),
              'date_end'=>($request->has('date_end')?$request->date_end:null),
              'country'=>$country,
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
                  'table_name'=>'cervie_researcher_consultancies',
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
            $path['folder'] = 'resources/researcher/'.trim(Auth::id()).'/document/consultancies/'.$request->id.'/';

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
                  'table_name'=>'cervie_researcher_consultancies',
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
                  'table_name'=>'cervie_researcher_consultancies',
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
                     ->with('message','Consultancies Saved');

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
        'name'=>' Title',
      ],
      2=>[
        'icon'=>'<i class="mdi mdi-account"></i>',
        'name'=>' Client',
      ],
      3=>[
        'icon'=>'<i class="mdi mdi-calendar"></i>',
        'name'=>' Date Start',
      ],
      4=>[
        'icon'=>'<i class="mdi mdi-calendar"></i>',
        'name'=>' Date End',
      ],
      5=>[
        'icon'=>'<i class="mdi mdi-shield-check"></i>',
        'name'=>' Verfication',
      ],
      6=>[
        'icon'=>'<i class="mdi mdi-settings"></i>',
        'name'=>' Control',
      ]
    ];

    //Return Table
    return $table;

  }

}
