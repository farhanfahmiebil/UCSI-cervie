<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Publication;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model View
use App\Models\UCSI_V2_General\MSSQL\View\AcademicIndexingBody AS AcademicIndexingBodyView;
use App\Models\UCSI_V2_General\MSSQL\View\PublicationType AS PublicationTypeView;
use App\Models\UCSI_V2_General\MSSQL\View\Quartile AS QuartileView;
use App\Models\UCSI_V2_General\MSSQL\View\SustainableDevelopmentGoal AS SustainableDevelopmentGoalView;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherPublication AS CervieResearcherPublicationView;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTableControl AS CervieResearcherTableControlProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherPublication AS CervieResearcherPublicationProcedure;
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.publication.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.publication.';

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

    //Set Model General Publication Type
    $model['general']['publication']['type'] = new PublicationTypeView();

    //Get General Publication Type
    $data['general']['publication']['type'] = $model['general']['publication']['type']->selectBox();

    //Set Model General Academic Indexing Body
    $model['general']['academic']['indexing']['body'] = new AcademicIndexingBodyView();

    //Get General General Academic Indexing Body
    $data['general']['academic']['indexing']['body'] = $model['general']['academic']['indexing']['body']->selectBox();

    //Set Model General Quartile
    $model['general']['quartile'] = new QuartileView();

    //Get General General Quartile
    $data['general']['quartile'] = $model['general']['quartile']->selectBox();

    //Set Model General Sustainable Development Goal
    $model['general']['sustainable']['development']['goal'] = new SustainableDevelopmentGoalView();

    //Get General General Sustainable Development Goal
    $data['general']['sustainable']['development']['goal'] = $model['general']['sustainable']['development']['goal']->selectBox();

    //Set Model
    $model['cervie']['researcher']['table']['control'] = new CervieResearcherTableControlProcedure();

    //Get Table Control
    $data['cervie']['researcher']['table']['control'] = $model['cervie']['researcher']['table']['control']->readRecord(
      [
        'column'=>[
          'table_control_id'=>'cervie_researcher_publication'
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
 		Validate Data
 	**************************************************************************************/
  public function getValidateData(Request $request){

    //Check Has Publication Type
    if($request->has('publication_type_id')){

      //Get Publication Type
      switch($request->publication_type_id){

        //Article
        case '1':

          //Define Validation Rules
          $rules = [
            'publication_type_id'=>['required'],
            'title'=>['required'],
            'author'=>['required'],
            'name'=>['required'],
            'publisher'=>['nullable'],
            'day'=>['nullable'],
            'month'=>['nullable'],
            'year'=>['required','regex:/^\d{4}$/'],
            'edition'=>['nullable'],
            'volume'=>['nullable'],
            'issue'=>['nullable'],
            'page_no'=>['nullable'],
            'chapter_no'=>['nullable'],
            'isbn'=>['nullable'],
            'issn'=>['nullable'],
            'eissn'=>['nullable'],
            'doi'=>['nullable'],
            'indexing_body_id'=>['nullable'],
            'quartile'=>['nullable'],
            'sustainable_development_goal_id'=>['nullable'],
            'hyperlink'=>['nullable'],
            'document.*'=>['required','mimes:pdf','max:3072'], // Validate each file in the array
            'document_name.*'=>['required'], // Validate that each file has an associated name
          ];

          //Custom Validation Messages
          $messages = [
            'publication_type_id.required'=>'Publication Type is required',
            'title.required'=>'Title is required',
            'author.required'=>'Author Required',
            'name.required'=>'Article Name Required',
            'year.required'=>'Year must be a 4-digit year',
          ];

        break;

        //Journal
        case '2':

          //Define Validation Rules
          $rules = [
            'publication_type_id'=>['required'],
            'title'=>['required'],
            'author'=>['required'],
            'name'=>['required'],
            'publisher'=>['nullable'],
            'day'=>['nullable'],
            'month'=>['nullable'],
            'year'=>['required','regex:/^\d{4}$/'],
            'edition'=>['nullable'],
            'volume'=>['nullable'],
            'issue'=>['nullable'],
            'page_no'=>['nullable'],
            'chapter_no'=>['nullable'],
            'isbn'=>['nullable'],
            'issn'=>['nullable'],
            'eissn'=>['nullable'],
            'doi'=>['nullable'],
            'indexing_body_id'=>['nullable'],
            'quartile'=>['nullable'],
            'sustainable_development_goal_id'=>['nullable'],
            'hyperlink'=>['nullable'],
            'document.*'=>['required','mimes:pdf','max:3072'], // Validate each file in the array
            'document_name.*'=>['required'], // Validate that each file has an associated name
          ];

          //Custom Validation Messages
          $messages = [
            'publication_type_id.required'=>'Publication Type is required',
            'title.required'=>'Title is required',
            'author.required'=>'Author Required',
            'name.required'=>'Journal Name Required',
            'year.required'=>'Year must be a 4-digit year',
          ];


// dd($rules,$messages);
        break;

        //Book
        case '3':

          //Define Validation Rules
          $rules = [
            'publication_type_id'=>['required'],
            'title'=>['required'],
            'author'=>['required'],
            'name'=>['nullable'],
            'publisher'=>['nullable'],
            'day'=>['nullable'],
            'month'=>['nullable'],
            'year'=>['required','regex:/^\d{4}$/'],
            'edition'=>['nullable'],
            'volume'=>['nullable'],
            'issue'=>['nullable'],
            'page_no'=>['nullable'],
            'chapter_no'=>['nullable'],
            'isbn'=>['nullable'],
            'issn'=>['nullable'],
            'eissn'=>['nullable'],
            'doi'=>['nullable'],
            'indexing_body_id'=>['nullable'],
            'quartile'=>['nullable'],
            'sustainable_development_goal_id'=>['nullable'],
            'hyperlink'=>['nullable'],
            'document.*'=>['required','mimes:pdf','max:3072'], // Validate each file in the array
            'document_name.*'=>['required'], // Validate that each file has an associated name
          ];

          //Custom Validation Messages
          $messages = [
            'publication_type_id.required'=>'Publication Type is required',
            'title.required'=>'Title is required',
            'author.required'=>'Author Required',
            'year.required'=>'Year must be a 4-digit year',
          ];

        break;

        //Book Chapter
        case '4':

          //Define Validation Rules
          $rules = [
            'publication_type_id'=>['required'],
            'title'=>['required'],
            'author'=>['required'],
            'name'=>['nullable'],
            'publisher'=>['nullable'],
            'day'=>['nullable'],
            'month'=>['nullable'],
            'year'=>['required','regex:/^\d{4}$/'],
            'edition'=>['nullable'],
            'volume'=>['nullable'],
            'issue'=>['nullable'],
            'page_no'=>['nullable'],
            'chapter_no'=>['nullable'],
            'isbn'=>['nullable'],
            'issn'=>['nullable'],
            'eissn'=>['nullable'],
            'doi'=>['nullable'],
            'indexing_body_id'=>['nullable'],
            'quartile'=>['nullable'],
            'sustainable_development_goal_id'=>['nullable'],
            'hyperlink'=>['nullable'],
            'document.*'=>['required','mimes:pdf','max:3072'], // Validate each file in the array
            'document_name.*'=>['required'], // Validate that each file has an associated name
          ];

          //Custom Validation Messages
          $messages = [
            'publication_type_id.required'=>'Publication Type is required',
            'title.required'=>'Title is required',
            'author.required'=>'Author Required',
            'year.required'=>'Year must be a 4-digit year',
          ];

        break;

      }

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

      //Create A Validator Instance
      $validator = Validator::make($request->all(), $rules, $messages);

      //Run The Validation
      $validator->validate();

    }

  }

  /**************************************************************************************
 		Create
 	**************************************************************************************/
	public function create(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Get Validate Data
    $this->getValidateData($request);

    //If Form Token Exist
		if(!$request->has('form_token')){abort(555,'Form Token Missing');}

		//Check Type Request
		switch($this->encrypter->decrypt($request->form_token)){

      //Create
      case 'create':

        //Convert array to string with commas separating the values
        $sustainable_development_goal = implode(',',$request->sustainable_development_goal_id);

        //Set Model
        $model['cervie']['researcher']['publication'] = new CervieResearcherPublicationProcedure();

        //Create Main
        $result['main']['create'] = $model['cervie']['researcher']['publication']->createRecord(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'publication_type_id'=>($request->has('publication_type_id')?$request->publication_type_id:null),
              'author'=>($request->has('author')?$request->author:null),
              'title'=>($request->has('title')?$request->title:null),
              'name'=>($request->has('name')?$request->name:null),
              'publisher'=>($request->has('publisher')?$request->publisher:null),
              'day'=>($request->has('day')?$request->day:null),
              'month'=>($request->has('month')?$request->month:null),
              'year'=>($request->has('year')?$request->year:null),
              'edition'=>($request->has('edition')?$request->edition:null),
              'volume'=>($request->has('volume')?$request->volume:null),
              'issue'=>($request->has('issue')?$request->issue:null),
              'doi'=>($request->has('doi')?$request->doi:null),
              'quartile_id'=>($request->has('quartile_id')?$request->quartile_id:null),
              'academic_indexing_body_id'=>($request->has('academic_indexing_body_id')?$request->academic_indexing_body_id:null),
              'academic_indexing_body_other'=>($request->has('academic_indexing_body_other')?$request->academic_indexing_body_other:null),
              'isbn'=>($request->has('isbn')?$request->isbn:null),
              'issn'=>($request->has('issn')?$request->issn:null),
              'eissn'=>($request->has('eissn')?$request->eissn:null),
              'page_no'=>($request->has('page_no')?$request->page_no:null),
              'chapter_no'=>($request->has('chapter_no')?$request->chapter_no:null),
              'sustainable_development_goal'=>$sustainable_development_goal,
              'hyperlink'=>($request->has('hyperlink')?$request->hyperlink:null),
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
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/publication/'.$result['main']['create']->last_insert_id.'/';

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
                  'table_name'=>'cervie_researcher_publication',
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
                     ->with('message','Publication Added');

  }

  /**************************************************************************************
 		List
 	**************************************************************************************/
	public function list(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Model General Publication Type
    $model['general']['publication']['type'] = new PublicationTypeView();

    //Check Exist
    $model['general']['publication']['type']->checkExist(
      [
        'column'=>[
          'publication_type_id'=>$request->route('publication_type_id')
        ]
      ]
    );

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

    //Get General Publication Type Select Box
    $data['general']['publication']['type'] = $model['general']['publication']['type']->selectBox();
// dd($data['general']['publication']['type']);

    //Set Model Publication
    $model['cervie']['researcher']['publication'] = new CervieResearcherPublicationView();

    //Get General Publication Type
    foreach($data['general']['publication']['type'] as $key=>$value){

      //Set Main Data Researcher Publication
      $data['main']['cervie']['researcher']['publication'][$value->publication_type_id] = $model['cervie']['researcher']['publication']->getList(
        [
          'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
          'column'=>[
            'employee_id'=>Auth::id(),
            'publication_type_id'=>$value->publication_type_id
          ]
        ]
      );

      //Set Table Researcher Publication
      $data['table']['column']['cervie']['researcher']['publication'][$value->publication_type_id] = $this->getDataTable(
        [
          'category'=>$value->publication_type_id
        ]
      );

    }
    // dd($data['main']['cervie']['researcher']['professional']['membership']);
// dd($data['main']['cervie']['researcher']['publication']);
    // dd(count($data['main']['cervie']['researcher']['position']));
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
        $model['cervie']['researcher']['publication'] = new CervieResearcherPublicationProcedure();

        //Delete Main
        $result['main']['delete'] = $model['cervie']['researcher']['publication']->deleteRecord(
          [
            'column'=>[
              'publication_id'=>$request->id,
              'employee_id'=>Auth::id()
            ]
          ]
        );

        //Set Path Folder
        $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/publication/'.$request->id.'/';

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
              'table_name'=>'cervie_researcher_publication',
              'table_id'=>$request->id
            ]
          ]
        );

        //Set Model
        $model['cervie']['researcher']['publication'] = new CervieResearcherPublicationProcedure();

        //Delete Evidence
        $data['main']['verification'] = $model['cervie']['researcher']['publication']->needVerification(
          [
            'column'=>[
              'publication_id'=>$request->id,
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
                     ->with('message','Publication Deleted');

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
        $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/publication/'.$data['evidence']->table_id.'/';

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
        $model['cervie']['researcher']['publication'] = new CervieResearcherPublicationProcedure();

        //Set Main Verification
        $data['main']['verification'] = $model['cervie']['researcher']['publication']->needVerification(
          [
            'column'=>[
              'publication_id'=>$data['evidence']->table_id,
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
          'table_control_id'=>'cervie_researcher_publication'
        ]
      ]
    );

    //Set Model General Publication Type
    $model['general']['publication']['type'] = new PublicationTypeView();

    //Get General Publication Type
    $data['general']['publication']['type'] = $model['general']['publication']['type']->selectBox();

    //Set Model General Academic Indexing Body
    $model['general']['academic']['indexing']['body'] = new AcademicIndexingBodyView();

    //Get General General Academic Indexing Body
    $data['general']['academic']['indexing']['body'] = $model['general']['academic']['indexing']['body']->selectBox();

    //Set Model General Quartile
    $model['general']['quartile'] = new QuartileView();

    //Get General General Quartile
    $data['general']['quartile'] = $model['general']['quartile']->selectBox();

    //Set Model General Sustainable Development Goal
    $model['general']['sustainable']['development']['goal'] = new SustainableDevelopmentGoalView();

    //Get General General Sustainable Development Goal
    $data['general']['sustainable']['development']['goal'] = $model['general']['sustainable']['development']['goal']->selectBox();
// dd($data['general']['sustainable']['development']['goal']);
    //Set Model
    $model['cervie']['researcher']['publication'] = new CervieResearcherPublicationProcedure();

    //Read Main
    $data['main'] = $model['cervie']['researcher']['publication']->readRecord(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'publication_id'=>$request->id
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
          'table_name'=>'cervie_researcher_publication',
          'table_id'=>$request->id
        ]
      ]
    );
// dd(    $data['evidence']);
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
    $asset['document'] = '/public/resources/researcher/'.trim(Auth::id()).'/document/publication/'.$request->id.'/';

    //Set Document
    $hyperlink['document'] = $request->root().'/public/storage/resources/researcher/'.trim(Auth::id()).'/document/publication/'.$request->id.'/';
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

        //Get Publication Type
        $this->getValidateData($request);

        //Convert array to string with commas separating the values
        $sustainable_development_goal = implode(',',$request->sustainable_development_goal_id);

        //Set Model
        $model['cervie']['researcher']['publication'] = new CervieResearcherPublicationProcedure();

        //Create Main
        $result['main']['update'] = $model['cervie']['researcher']['publication']->updateRecord(
          [
            'column'=>[
              'publication_id'=>$request->id,
              'employee_id'=>Auth::id(),
              'publication_type_id'=>($request->has('publication_type_id')?$request->publication_type_id:null),
              'author'=>($request->has('author')?$request->author:null),
              'title'=>($request->has('title')?$request->title:null),
              'name'=>($request->has('name')?$request->name:null),
              'publisher'=>($request->has('publisher')?$request->publisher:null),
              'day'=>($request->has('day')?$request->day:null),
              'month'=>($request->has('month')?$request->month:null),
              'year'=>($request->has('year')?$request->year:null),
              'edition'=>($request->has('edition')?$request->edition:null),
              'volume'=>($request->has('volume')?$request->volume:null),
              'issue'=>($request->has('issue')?$request->issue:null),
              'doi'=>($request->has('doi')?$request->doi:null),
              'quartile_id'=>($request->has('quartile_id')?$request->quartile_id:null),
              'academic_indexing_body_id'=>($request->has('academic_indexing_body_id')?$request->academic_indexing_body_id:null),
              'academic_indexing_body_other'=>($request->has('academic_indexing_body_other')?$request->academic_indexing_body_other:null),
              'isbn'=>($request->has('isbn')?$request->isbn:null),
              'issn'=>($request->has('issn')?$request->issn:null),
              'eissn'=>($request->has('eissn')?$request->eissn:null),
              'page_no'=>($request->has('page_no')?$request->page_no:null),
              'chapter_no'=>($request->has('chapter_no')?$request->chapter_no:null),
              'sustainable_development_goal'=>$sustainable_development_goal,
              'hyperlink'=>($request->has('hyperlink')?$request->hyperlink:null),
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
                  'table_name'=>'cervie_researcher_publication',
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
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/publication/'.$request->id.'/';

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
                  'table_name'=>'cervie_researcher_publication',
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
                     ->with('message','Publication Saved');

  }

  /**************************************************************************************
 		Get Data Table
 	**************************************************************************************/
  public function getDataTable($data){

    //Check Data Category Exist
    if(!isset($data['category'])){abort(404);}

    //Get Data Category
    switch($data['category']){

      //Article
      case '1':

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
            'icon'=>'<i class="mdi mdi-city"></i>',
            'name'=>' Name',
          ],
          3=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Volume/Issue/PageNo',
          ],
          4=>[
            'icon'=>'<i class="mdi mdi-google-earth"></i>',
            'name'=>' SDG',
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

      break;

      //Journal
      case '2':

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
            'icon'=>'<i class="mdi mdi-city"></i>',
            'name'=>' Name',
          ],
          3=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Volume/Issue/PageNo',
          ],
          4=>[
            'icon'=>'<i class="mdi mdi-google-earth"></i>',
            'name'=>' SDG',
          ],
          5=>[
            'icon'=>'<i class="mdi mdi-shield-check"></i>',
            'name'=>' Verification',
          ],
          6=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Control',
          ]
        ];

      break;

      //Book
      case '3':

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
            'icon'=>'<i class="mdi mdi-city"></i>',
            'name'=>' Publisher',
          ],
          3=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' PageNo',
          ],
          4=>[
            'icon'=>'<i class="mdi mdi-google-earth"></i>',
            'name'=>' SDG',
          ],
          5=>[
            'icon'=>'<i class="mdi mdi-shield-check"></i>',
            'name'=>' Verification',
          ],
          6=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Control',
          ]
        ];

      break;

      //Book Chapter
      case '4':

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
            'icon'=>'<i class="mdi mdi-city"></i>',
            'name'=>' Publisher',
          ],
          3=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' PageNo/ChapterNo',
          ],
          4=>[
            'icon'=>'<i class="mdi mdi-google-earth"></i>',
            'name'=>' SDG',
          ],
          5=>[
            'icon'=>'<i class="mdi mdi-shield-check"></i>',
            'name'=>' Verification',
          ],
          6=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Control',
          ]
        ];

      break;

      default:

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
            'icon'=>'<i class="mdi mdi-city"></i>',
            'name'=>' Name',
          ],
          3=>[
            'icon'=>'<i class="mdi mdi-settings"></i>',
            'name'=>' Volume/Issue/PageNo',
          ],
          4=>[
            'icon'=>'<i class="mdi mdi-google-earth"></i>',
            'name'=>' SDG',
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

      break;
    }

    //Return Table
    return $table;

  }

}
