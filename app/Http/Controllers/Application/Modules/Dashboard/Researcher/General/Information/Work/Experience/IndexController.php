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

//Model View
use App\Models\UCSI_V2_Education\MSSQL\View\Organization;
use App\Models\UCSI_V2_Education\MSSQL\View\Status;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherWorkExperience AS CervieResearcherWorkExperienceView;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherWorkExperience AS CervieResearcherWorkExperienceProcedure;
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
    $this->hyperlink['page']['reupload'] = $this->route['name'].'reupload';

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
		$data['title'] = array($this->header['category'],$this->header['module']);

    //Set Model
    $model['general']['organization'] = new Organization();
    $model['general']['status'] = new Status();

    //Set Data Organization
    $data['general']['organization'] = $model['general']['organization']->selectBox(
      [
        'column'=>[
          'company_id'=>'UCSI_EDUCATION',
          'company_office_id'=>'MAIN_CAMPUS'
        ]
      ]
    );

    //Set Data Status
    $data['general']['status']['cervie']['researcher']['position'] = $model['general']['status']->selectBox(
      [
        'column'=>[
          'table'=>'cervie_researcher_position'
        ]
      ]
    );

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
        'company_name' => ['required'],
        'designation' => ['required'],
        'year_start' => ['nullable', 'regex:/^\d{4}$/'], // 4-digit year (nullable)
        'year_end' => ['nullable', 'regex:/^\d{4}$/', 'after:year_start'], // 4-digit year (nullable)
        'is_working_here' => ['boolean'], // Not required, but must be boolean if present
        'file'=>['required','mimes:pdf','max:3072'],
    ];

    // Custom validation messages
    $messages = [
      'company_name.required' => 'Company Name Required',
      'designation.required' => 'Designation Required',
      'year_start.regex' => 'Year Start must be a 4-digit year',
      'year_end.regex' => 'Year End must be a 4-digit year',
      'year_end.after' => 'Year End must be after Year Start',
      'file.required'=>'File Required',
      // 'file.mimes'=>'File Must Be .pdf',
      'file.mimes'=>'File Must Be PDF',
      'file.max'=>'File Maximum Size is 3MB'
    ];

    // Create a validator instance
    $validator = \Validator::make($request->all(), $rules, $messages);

    // Custom rule: either year_end or is_working_here must be present (but not both)
    $validator->after(function ($validator) use ($request){
      $yearEnd = $request->input('year_end');
      $isWorkingHere = $request->input('is_working_here');

      // Check if both year_end and is_working_here are empty
      if(empty($yearEnd) && empty($isWorkingHere)){
        $validator->errors()->add('year_or_work','Either Year End or Is Working Here must be provided.');
      }

      // Check if both fields are filled
      if(!empty($yearEnd) && !empty($isWorkingHere)){
        $validator->errors()->add('year_or_work','Only One of Year End or Is Working Here should be provided.');
      }
    });

    // Run the validation
    $validator->validate();

    //If Form Token Exist
		if(!$request->has('form_token')){
      abort(555,'Form Token Missing');
    }

		//Check Type Request
		switch($this->encrypter->decrypt($request->form_token)){

      //Create
      case 'create':

        //Set Model
        $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceProcedure();

        //Set Main
        $data['main'] = $model['cervie']['researcher']['work']['experience']->createRecord(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'company_name'=>$request->company_name,
              'designation'=>$request->designation,
              'year_start'=>$request->year_start,
              'year_end'=>$request->year_end,
              'is_working_here'=>(($request->is_working_here)?1:0),
              'created_by'=>Auth::id()
            ]
          ]
        );

        //If File Exist
        if($request->has('file')){

          //Set File Name Original With Extension
          $file['name']['raw']['with']['extension'] = $request->file->getClientOriginalName();

          //Set File Name Original Without Extension
          $file['name']['raw']['without']['extension'] = pathinfo($file['name']['raw']['with']['extension'],PATHINFO_FILENAME);

          //Get Extension
          $file['extension'] = $request->file->getClientOriginalExtension();

          //Set Path Folder
          $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/work_experience/';

          //Set File Name
          //$file['name'] = 'index.'.$file['extension'];
          $file['name']['modified']['without']['extension'] = $data['main']->last_insert_id;
          $file['name']['modified']['with']['extension'] = $data['main']->last_insert_id.'.'.$file['extension'];

          //Set Path to Upload
          $path['upload'] = $path['folder'].''.$file['name']['modified']['with']['extension'];

          //Check Exist Storage File
          $check['exist']['storage'] = Storage::disk()->exists($path['upload']);

          //If Exist
          if($check['exist']['storage']){

            //Delete File
            Storage::disk()->delete($path);

          }

          //Store File in FTP Storage
          Storage::disk()->put($path['upload'],fopen($request->file('file'),'r+'));

          //Set Model
          $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

          //Set Main
          $data['main'] = $model['cervie']['researcher']['evidence']->createRecord(
            [
              'column'=>[
                'employee_id'=>Auth::id(),
                'file_raw_name'=>$file['name']['raw']['without']['extension'],
                'file_name'=>$data['main']->last_insert_id,
                'file_extension'=>$file['extension'],
                'description'=>(($request->description)?$request->description:null),
                'table_name'=>'cervie_researcher_work_experience',
                'table_id'=>$data['main']->last_insert_id,
                'created_by'=>Auth::id()
              ]
            ]
          );

        }

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
		if($request->has('form_token')){

			//Check Type Request
			switch($this->encrypter->decrypt($request->form_token)){

        //Create
        case 'delete':

          //Set Model
          $model['cervie']['researcher']['position'] = new CervieResearcherPositionStoredProcedure();

          //Set Main
          $data['main'] = $model['cervie']['researcher']['position']->deleteRecord(
            [
              'column'=>[
                'position_id'=>$request->id,
                'employee_id'=>Auth::id()
              ]
            ]
          );

        break;

      }

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['list'])
                     ->with('alert_type','success')
                     ->with('message','Research Position Deleted');

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
    $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceProcedure();

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

    //Set Document
    $data['document'] = $model['cervie']['researcher']['evidence']->readRecord(
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
        'class'=>'col-md-9',
        'icon'=>'<i class="mdi mdi-file-account-outline"></i>',
        'name'=>' File',
      ],
      2=>[
        'icon'=>'<i class="mdi mdi-settings"></i>',
        'name'=>' Control',
      ]
    ];
// dd($request->root());
    $asset['document'] = '/public/resources/researcher/'.trim(Auth::id()).'/document/work_experience/';
    $hyperlink['document'] = $request->root().'/public/storage/resources/researcher/'.trim(Auth::id()).'/document/work_experience/';

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
		if(!$request->has('form_token')){
      abort(555,'Form Token Missing');
    }
// dd($this->encrypter->decrypt($request->form_token));
    //Check Type Request
    switch($this->encrypter->decrypt($request->form_token)){

      //Create
      case 'update':

        // Define validation rules
        $rules = [
          'company_name' => ['required'],
          'designation' => ['required'],
          'year_start' => ['nullable', 'regex:/^\d{4}$/'], // 4-digit year (nullable)
          'year_end' => ['nullable', 'regex:/^\d{4}$/', 'after:year_start'], // 4-digit year (nullable)
          'is_working_here' => ['boolean'], // Not required, but must be boolean if present
        ];

        // Custom validation messages
        $messages = [
          'company_name.required' => 'Company Name Required',
          'designation.required' => 'Designation Required',
          'year_start.regex' => 'Year Start must be a 4-digit year',
          'year_end.regex' => 'Year End must be a 4-digit year',
          'year_end.after' => 'Year End must be after Year Start',
        ];

        // Create a validator instance
        $validator = \Validator::make($request->all(), $rules, $messages);

        // Custom rule: either year_end or is_working_here must be present (but not both)
        $validator->after(function ($validator) use ($request){
          $yearEnd = $request->input('year_end');
          $isWorkingHere = $request->input('is_working_here');

          // Check if both year_end and is_working_here are empty
          if(empty($yearEnd) && empty($isWorkingHere)){
            $validator->errors()->add('year_or_work','Either Year End or Is Working Here must be provided.');
          }

          // Check if both fields are filled
          if(!empty($yearEnd) && !empty($isWorkingHere)){
            $validator->errors()->add('year_or_work','Only One of Year End or Is Working Here should be provided.');
          }
        });

        // Run the validation
        $validator->validate();

        //Set Model
        $model['cervie']['researcher']['work']['experience'] = new CervieResearcherWorkExperienceProcedure();

        //Set Main
        $data['main'] = $model['cervie']['researcher']['work']['experience']->updateRecord(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'work_experience_id'=>$request->id,
              'company_name'=>$request->company_name,
              'designation'=>$request->designation,
              'year_start'=>$request->year_start,
              'year_end'=>$request->year_end,
              'is_working_here'=>(($request->is_working_here)?1:0),
              'updated_by'=>Auth::id()
            ]
          ]
        );

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['view'],['id'=>$request->id])
                     ->with('alert_type','success')
                     ->with('message','Researcher Work Experience Saved');

  }

  /**************************************************************************************
 		Reupload
 	**************************************************************************************/
	public function reupload(Request $request){

    //Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //If Form Token Exist
		if(!$request->has('form_token')){
      abort(555,'Form Missing Token');
    }

    //Check Request Validation
    $validate = $request->validate(

      //Check Validation
      [
        'file'=>['required','mimes:pdf','max:3072'],
      ],

      //Error Message
      [
        'file.required'=>'File Required',
        'file.mimes'=>'File Must Be PDF',
        'file.max'=>'File Maximum Size is 3MB'
      ]
    );

    // dd($request);

    //If File Exist
    if($request->has('file')){

      //Set File Name Original With Extension
      $file['name']['raw']['with']['extension'] = $request->file->getClientOriginalName();

      //Set File Name Original Without Extension
      $file['name']['raw']['without']['extension'] = pathinfo($file['name']['raw']['with']['extension'],PATHINFO_FILENAME);

      //Get Extension
      $file['extension'] = $request->file->getClientOriginalExtension();

      //Set Path Folder
      $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/work_experience/';

      //Set File Name
      //$file['name'] = 'index.'.$file['extension'];
      $file['name']['modified']['without']['extension'] = $request->work_experience_id;
      $file['name']['modified']['with']['extension'] = $request->work_experience_id.'.'.$file['extension'];

      //Set Path to Upload
      $path['upload'] = $path['folder'].''.$file['name']['modified']['with']['extension'];

      //Check Exist Storage File
      $check['exist']['storage'] = Storage::disk()->exists($path['upload']);

      //If Exist
      if($check['exist']['storage']){

        //Delete File
        Storage::disk()->delete($path);

      }

      //Store File in FTP Storage
      Storage::disk()->put($path['upload'],fopen($request->file('file'),'r+'));

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['view'],['id'=>$request->work_experience_id])
                     ->with('alert_type','success')
                     ->with('message','Researcher Evidence Reupload');
  }

}
