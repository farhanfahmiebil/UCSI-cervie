<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\General\Information\Professional\Membership;

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
use App\Models\UCSI_V2_General\MSSQL\View\ProfessionalMembershipType AS ProfessionalMembershipTypeView;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTableControl AS CervieResearcherTableControlProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherProfessionalMembership AS CervieResearcherProfessionalMembershipProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherEvidence AS CervieResearcherEvidenceProcedure;

//Get Request
use Illuminate\Http\Request;

//Get Storage
use Storage;

//Get Validator
use Illuminate\Http\Validator;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'researcher';

  //Path Header
	protected $header = [
		'application'=>'Dashboard',
    'category'=>'General Information',
		'module'=>'Professional Membership',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.general.information.professional.membership.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.general.information.professional.membership.';

    //Set Navigation
		$this->page['sub'] = $this->route['view'];

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //List
    $this->hyperlink['page']['list'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.general.information.'.'home.list';

    //Hyperlink
    $this->hyperlink['page']['create'] = $this->route['name'].'create';
    $this->hyperlink['page']['update'] = $this->route['name'].'update';
    $this->hyperlink['page']['view'] = $this->route['name'].'view';
    $this->hyperlink['page']['new'] = $this->route['name'].'new';
    $this->hyperlink['page']['delete']['main'] = $this->route['name'].'delete';
    $this->hyperlink['page']['delete']['evidence'] = $this->route['name'].'evidence.delete';

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
    $data['breadcrumb']['title'] = '';

		//Set Breadcrumb
		$data['title'] = array($this->header['category'],$this->header['module']);

    //Set Model Representation Category
    $model['general']['representation']['category'] = new RepresentationCategoryView();

    //Get Representation Category
    $data['general']['representation']['category'] = $model['general']['representation']['category']->selectBox(
      [
        'column'=>[
          'category'=>'PROFESSIONAL_MEMBERSHIP'
        ]
      ]
    );

    //Set Model Representation Role
    $model['general']['representation']['role'] = new RepresentationRoleView();

    //Get Representation Role
    $data['general']['representation']['role'] = $model['general']['representation']['role']->selectBox(
      [
        'column'=>[
          'category'=>'PROFESSIONAL_MEMBERSHIP'
        ]
      ]
    );

    //Set Model Professional Membership Type
    $model['general']['professional']['membership']['type'] = new ProfessionalMembershipTypeView();

    //Get Professional Membership Type
    $data['general']['professional']['membership']['type'] = $model['general']['professional']['membership']['type']->selectBox();

    //Set Model
    $model['cervie']['researcher']['table']['control'] = new CervieResearcherTableControlProcedure();

    //Get Table Control
    $data['cervie']['researcher']['table']['control'] = $model['cervie']['researcher']['table']['control']->readRecord(
      [
        'column'=>[
          'table_control_id'=>'cervie_researcher_professional_membership'
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

    //Get Form Token
		$form_token = $this->encrypt_token_form;

		//Return View
		return view($this->route['view'].'new.index',compact('data','form_token','page','hyperlink'));

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
        $model['cervie']['researcher']['professional']['membership'] = new CervieResearcherProfessionalMembershipProcedure();

        //Create Main
        $result['main']['create'] = $model['cervie']['researcher']['professional']['membership']->createRecord(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'name'=>$request->name,
              'representation_category_id'=>$request->representation_category_id,
              'representation_role_id'=>$request->representation_role_id,
              'professional_membership_type_id'=>$request->professional_membership_type_id,
              'date_start'=>$request->date_start,
              'date_end'=>$request->date_end,
              'is_lifetime'=>(($request->is_lifetime)?1:0),
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
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/professional_membership/'.$result['main']['create']->last_insert_id.'/';

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
                  'table_name'=>'cervie_researcher_professional_membership',
                  'table_id'=>$result['main']['create']->last_insert_id,
                  'need_verification'=>1,
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
                     ->with('message','Professional Membership Added');

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
        $model['cervie']['researcher']['professional']['membership'] = new CervieResearcherProfessionalMembershipProcedure();

        //Delete Main
        $result['main']['delete'] = $model['cervie']['researcher']['professional']['membership']->deleteRecord(
          [
            'column'=>[
              'professional_membership_id'=>$request->id,
              'employee_id'=>Auth::id(),
              'created_by'=>Auth::id(),
            ]
          ]
        );

        //Set Path Folder
        $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/professional_membership/'.$request->id.'/';

        //Check If The Folder Already Exists In Storage
        $check['exist']['storage'] = Storage::disk()->exists($path['folder']);

        //If Folder Exists, Delete It
        if($check['exist']['storage']){Storage::disk()->deleteDirectory($path['folder']);}

        //Set Model Evidence
        $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

        //Delete Evidence
        $result['evidence']['delete'] = $model['cervie']['researcher']['evidence']->deleteRecordByResearcherTable(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'table_name'=>'cervie_researcher_professional_membership',
              'table_id'=>$request->id
            ]
          ]
        );

        //Set Main Verification
        $data['main']['verification'] = $model['cervie']['researcher']['professional']['membership']->needVerification(
          [
            'column'=>[
              'professional_membership_id'=>$request->id,
              'need_verification'=>1,
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
                     ->with('message','Professional Membership Deleted');

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

        //Read Evidence Current
        $data['evidence'] = $model['cervie']['researcher']['evidence']->readRecord(
          [
            'column'=>[
              'evidence_id'=>$request->evidence_id,
              'employee_id'=>Auth::id(),
              'created_by'=>Auth::id()
            ]
          ]
        );

        //Set Path Folder
        $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/professional_membership/'.$data['evidence']->table_id.'/';

        //Set Modified File Name Without Extension (Using last_insert_id)
        $file['name']['modified']['without']['extension'] = $data['evidence']->file_id;

        //Set Modified File Name With Extension
        $file['name']['modified']['with']['extension'] = $file['name']['modified']['without']['extension'].'.'.$data['evidence']->file_extension;

        //Set The Full Upload Path
        $path['upload'] = $path['folder'] . $file['name']['modified']['with']['extension'];

        //Check If The File Already Exists In Storage
        $check['exist']['storage'] = Storage::disk()->exists($path['upload']);

        //If The File Exists, Delete It
        if($check['exist']['storage']){Storage::disk()->delete($path['upload']);}

        //Delete Evidence
        $result['evidence']['delete'] = $model['cervie']['researcher']['evidence']->deleteRecord(
          [
            'column'=>[
              'evidence_id'=>$data['evidence']->evidence_id,
              'employee_id'=>Auth::id()
            ]
          ]
        );

        //Set Model
        $model['cervie']['researcher']['professional']['membership'] = new CervieResearcherProfessionalMembershipProcedure();

        //Set Main Verification
        $data['main']['verification'] = $model['cervie']['researcher']['professional']['membership']->needVerification(
          [
            'column'=>[
              'professional_membership_id'=>$data['evidence']->table_id,
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

    //Set Model Representation Category
    $model['general']['representation']['category'] = new RepresentationCategoryView();

    //Get Representation Category
    $data['general']['representation']['category'] = $model['general']['representation']['category']->selectBox(
      [
        'column'=>[
          'category'=>'PROFESSIONAL_MEMBERSHIP'
        ]
      ]
    );

    //Set Model Representation Role
    $model['general']['representation']['role'] = new RepresentationRoleView();

    //Get Representation Role
    $data['general']['representation']['role'] = $model['general']['representation']['role']->selectBox(
      [
        'column'=>[
          'category'=>'PROFESSIONAL_MEMBERSHIP'
        ]
      ]
    );

    //Set Model Professional Membership Type
    $model['general']['professional']['membership']['type'] = new ProfessionalMembershipTypeView();

    //Get Professional Membership Type
    $data['general']['professional']['membership']['type'] = $model['general']['professional']['membership']['type']->selectBox();

    //Set Model
    $model['cervie']['researcher']['table']['control'] = new CervieResearcherTableControlProcedure();

    //Get Table Control
    $data['cervie']['researcher']['table']['control'] = $model['cervie']['researcher']['table']['control']->readRecord(
      [
        'column'=>[
          'table_control_id'=>'cervie_researcher_professional_membership'
        ]
      ]
    );

    //Set Model
    $model['cervie']['researcher']['professional']['membership'] = new CervieResearcherProfessionalMembershipProcedure();

    //Read Main
    $data['main'] = $model['cervie']['researcher']['professional']['membership']->readRecord(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'professional_membership_id'=>$request->id
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
          'table_name'=>'cervie_researcher_professional_membership',
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

    //Set Asset
    $asset['document'] = '/public/resources/researcher/'.trim(Auth::id()).'/document/professional_membership/'.$request->id.'/';

    //Set Document
    $hyperlink['document'] = $request->root().'/public/storage/resources/researcher/'.trim(Auth::id()).'/document/professional_membership/'.$request->id.'/';

    //Get Form Token
		$form_token = $this->encrypt_token_form;

    //Return View
		return view($this->route['view'].'view.index',compact('data','asset','form_token','hyperlink'));

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
        $model['cervie']['researcher']['professional']['membership'] = new CervieResearcherProfessionalMembershipProcedure();

        //Update Main
        $result['main']['update'] = $model['cervie']['researcher']['professional']['membership']->updateRecord(
          [
            'column'=>[
              'professional_membership_id'=>$request->id,
              'employee_id'=>Auth::id(),
              'name'=>$request->name,
              'representation_category_id'=>$request->representation_category_id,
              'representation_role_id'=>$request->representation_role_id,
              'professional_membership_type_id'=>$request->professional_membership_type_id,
              'date_start'=>$request->date_start,
              'date_end'=>$request->date_end,
              'is_lifetime'=>(($request->is_lifetime)?1:0),
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
                  'table_name'=>'cervie_researcher_professional_membership',
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
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/professional_membership/'.$request->id.'/';

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
                  'table_name'=>'cervie_researcher_professional_membership',
                  'table_id'=>$request->id,
                  'need_verification'=>1,
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
                     ->with('message','Professional Membership Saved');

  }

  /**************************************************************************************
 		Validate Data
 	**************************************************************************************/
  public function getValidateData(Request $request){

    //Define validation rules
    $rules = [
      'name'=>['required'],
      'representation_category_id'=>['required'],
      'representation_role_id'=>['required'],
      'professional_membership_type_id'=>['required'],
      'date_start' => ['required','date'],
      'date_end' => ['nullable','date','after:date_start'],
      'is_lifetime'=>['boolean'], // Not required, but must be boolean if present
      'document.*'=>['required', 'mimes:pdf', 'max:3072'], // Validate each file in the array
      'document_name.*'=>['required'], // Validate that each file has an associated name
    ];

    //Custom validation messages
    $messages = [
      'name.required'=>'Membership Name is required',
      'representation_category_id.required'=>'Professional Membership Level is required',
      'representation_role_id.required'=>'Professional Membership Role is required',
      'professional_membership_type_id.required'=>'Professional Membership Type is required',
      'date_start.required'=>'Date Start is Required',
      'date_start.date'=>'Date Start Must Be Date Format',
      'date_end.date'=>'Date End Must Be Date Format',
      'date_end.after'=>'Date End must be after Date Start',
    ];

    //If Document Name Exist
    if($request->has('document_name')){

      //Get Document Name
      foreach($request->document_name as $key=>$value){

        $rules['document.' . $key] = ['required', 'mimes:pdf', 'max:3072'];

        $messages['document.'.$key.'.required'] = 'Evidence item '.($key + 1).': File is required';
        $messages['document.'.$key.'.mimes'] = 'Evidence item '.($key + 1).': File must be a PDF';
        $messages['document.'.$key.'.max'] = 'Evidence item '.($key + 1).': File size cannot exceed 3MB';
        $messages['document_name.'.$key.'.required'] = 'Evidence item '.($key + 1).': File name is required';
      }

    }

    //Create a validator instance
    $validator = \Validator::make($request->all(), $rules, $messages);

    //Custom rule: either date end or is lifetime must be present (but not both)
    $validator->after(function ($validator) use ($request) {

      $date_end = $request->input('date_end');
      $is_lifetime = $request->input('is_lifetime');

      //Check if both date end and is life time are empty
      if(empty($date_end) && empty($is_lifetime)){
        $validator->errors()->add('date_or_work', 'Either Date End or Is Lifetime must be provided.');
      }

      //Check if both fields are filled
      if(!empty($date_end) && !empty($is_lifetime)){
        $validator->errors()->add('date_or_work', 'Only one of Date End or Is Lifetime should be provided.');
      }

    });

    // Run the validation
    $validator->validate();

  }

}
