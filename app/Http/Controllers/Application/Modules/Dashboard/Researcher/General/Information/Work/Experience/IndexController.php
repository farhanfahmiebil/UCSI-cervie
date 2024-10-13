<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\General\Information\Work\Experience;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTableControl AS CervieResearcherTableControlProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherWorkExperience AS CervieResearcherWorkExperienceProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherEvidence AS CervieResearcherEvidenceProcedure;

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
    'category'=>'General Information',
		'module'=>'Work Information',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.general.information.work.experience.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.general.information.work.experience.';

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

    //Define validation rules
    $rules = [
      'company_name'=>['required'],
      'designation'=>['required'],
      'year_start'=>['nullable', 'regex:/^\d{4}$/'], // 4-digit year (nullable)
      'year_end'=>['nullable', 'regex:/^\d{4}$/', 'after_or_equal:year_start'], // 4-digit year (nullable)
      'is_working_here'=>['boolean'], // Not required, but must be boolean if present
      'document.*'=>['required', 'mimes:pdf', 'max:3072'], // Validate each file in the array
      'document_name.*'=>['required'], // Validate that each file has an associated name
    ];

    //Custom validation messages
    $messages = [
      'company_name.required'=>'Company Name is required',
      'designation.required'=>'Designation is required',
      'year_start.regex'=>'Year Start must be a 4-digit year',
      'year_end.regex'=>'Year End must be a 4-digit year',
      'year_end.after'=>'Year End must be after Year Start',
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

    //Custom rule: Either Year End Or Is Working Here Must Be Present (But Not Both)
    $validator->after(function ($validator) use ($request) {

      $year_end = $request->input('year_end');
      $is_working_here = $request->input('is_working_here');

      //Check If Both Year End And Is Working Here Are Empty
      if(empty($year_end) && empty($is_working_here)){
        $validator->errors()->add('year_or_work', 'Either Year End or Is Working Here must be provided.');
      }

      //Check If Both Fields Are Filled
      if(!empty($year_end) && !empty($is_working_here)){
        $validator->errors()->add('year_or_work', 'Only one of Year End or Is Working Here should be provided.');
      }

    });

    //Run The Validation
    $validator->validate();

    //If Form Token Exist
		if(!$request->has('form_token')){abort(555,'Form Token Missing');}

		//Check Type Request
		switch($this->encrypter->decrypt($request->form_token)){

      //Create
      case 'create':

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
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/work_experience/'.$result['main']['create']->last_insert_id.'/';

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
                  'table_name'=>'cervie_researcher_work_experience',
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
                     ->with('message','Work Experience Added');

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
              'employee_id'=>Auth::id(),
              'created_by'=>Auth::id(),
            ]
          ]
        );

        //Set Path Folder
        $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/work_experience/'.$request->id.'/';

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
              'table_name'=>'cervie_researcher_work_experience',
              'table_id'=>$request->id
            ]
          ]
        );

        //Set Main Verification
        $data['main']['verification'] = $model['cervie']['researcher']['work']['experience']->needVerification(
          [
            'column'=>[
              'work_experience_id'=>$request->id,
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
                     ->with('message','Work Experience Deleted');

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
        $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/work_experience/'.$data['evidence']->table_id.'/';

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
        $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceProcedure();

        //Set Main Verification
        $data['main']['verification'] = $model['cervie']['researcher']['work']['experience']->needVerification(
          [
            'column'=>[
              'work_experience_id'=>$data['evidence']->table_id,
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
 		View
 	**************************************************************************************/
	public function view(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

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
    $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceProcedure();

    //Read Main
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

    //Read Evidence
    $data['evidence'] = $model['cervie']['researcher']['evidence']->readRecordByResearcherTable(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'table_name'=>'cervie_researcher_work_experience',
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

    //Set Asset
    $asset['document'] = '/public/resources/researcher/'.trim(Auth::id()).'/document/work_experience/'.$request->id.'/';

    //Set Document
    $hyperlink['document'] = $request->root().'/public/storage/resources/researcher/'.trim(Auth::id()).'/document/work_experience/'.$request->id.'/';

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

        //Set Model
        $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceProcedure();

        //Update Main
        $result['main']['update'] = $model['cervie']['researcher']['work']['experience']->updateRecord(
          [
            'column'=>[
              'work_experience_id'=>$request->id,
              'employee_id'=>Auth::id(),
              'company_name'=>$request->company_name,
              'designation'=>$request->designation,
              'year_start'=>$request->year_start,
              'year_end'=>$request->year_end,
              'is_working_here'=>(($request->is_working_here)?1:0),
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
                  'table_name'=>'cervie_researcher_work_experience',
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
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/work_experience/'.$request->id.'/';

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
                  'table_name'=>'cervie_researcher_work_experience',
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
                     ->with('message','Work Experience Saved');

  }

}
