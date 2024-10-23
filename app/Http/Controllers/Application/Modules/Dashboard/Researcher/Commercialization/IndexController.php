<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Commercialization;

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
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherCommercialization AS CervieResearcherCommercializationView;
use App\Models\UCSI_V2_General\MSSQL\View\CurrencyCode AS CurrencyCodeView;
use App\Models\UCSI_V2_General\MSSQL\View\Country AS CountryView;
use App\Models\UCSI_V2_Education\MSSQL\View\Status AS StatusView;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTableControl AS CervieResearcherTableControlProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherCommercialization AS CervieResearcherCommercializationProcedure;
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
    'category'=>'commercialization',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.commercialization.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.commercialization.';

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

    //Set Model General commercialization Type
    $model['general']['representation']['category'] = new RepresentationCategoryView();

    //Get General commercialization Type
    $data['general']['representation']['category'] = $model['general']['representation']['category']->selectBox(
      [
        'column'=>[
          'category'=>'COMMERCIALIZATION'
        ]
      ]
    );

    //Set Model General Country
    $model['general']['country'] = new CountryView();

    //Get General Country
    $data['general']['country'] = $model['general']['country'] ->selectBox();

    //Set Model General Currency Code
    $model['general']['currency']['code'] = new CurrencyCodeView();

    //Get General Currency Code
    $data['general']['currency']['code'] = $model['general']['currency']['code'] ->selectBox();

    //Set Model General Status
    $model['general']['status'] = new StatusView();

    //Get General Status
    $data['general']['status'] = $model['general']['status'] ->selectBox(
      [
        'column'=>[
          'table'=>'cervie_researcher_commercialization'
        ]
      ]
    );

    //Set Model
    $model['cervie']['researcher']['table']['control'] = new CervieResearcherTableControlProcedure();

    //Get Table Control
    $data['cervie']['researcher']['table']['control'] = $model['cervie']['researcher']['table']['control']->readRecord(
      [
        'column'=>[
          'table_control_id'=>'cervie_researcher_commercialization'
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

    //Define Validation Rules
    $rules = [
      'commercialization_title'=>['required'],
      'status_id'=>['required'],
      'representation_category_id'=>['required'],
      'country'=>['required'],
      'currency_code_id'=>['required'],
      'amount_1'=>['required'],
      'amount_2'=>['required'],
      'amount_3'=>['required'],
      'date_approval' => ['required','date'],
      'date_filing' => ['required','date'],
      'document.*'=>['required','mimes:pdf','max:3072'], // Validate each file in the array
      'document_name.*'=>['required'], // Validate that each file has an associated name
    ];

    //Custom Validation Messages
    $messages = [
      'commercialization_title.required'=>'Title is required',
      'status_id.required'=>'Status is required',
      'representation_category_id.required'=>'Commercialization Level is required',
      'country.required'=>'Country is Required',
      'currency_code_id.required'=>'Currency Code is Required',
      'amount_1.required'=>'Amount 1 is Required',
      'amount_2.required'=>'Amount 2 is Required',
      'amount_3.required'=>'Amount 3 is Required',
      'date_approval.required'=>'Date Approval is Required',
      'date_filing.required'=>'Date Filing is Required',

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

    //Get commercialization Type
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
        $model['cervie']['researcher']['commercialization'] = new CervieResearcherCommercializationProcedure();

        //Create Main
        $result['main']['create'] = $model['cervie']['researcher']['commercialization']->createRecord(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'commercialization_title'=>($request->has('commercialization_title')?$request->commercialization_title:null),
              'representation_category_id'=>($request->has('representation_category_id')?$request->representation_category_id:null),
              'date_approval'=>($request->has('date_approval')?$request->date_approval:null),
              'date_filing'=>($request->has('date_filing')?$request->date_filing:null),
              'status_id'=>($request->has('status_id')?$request->status_id:null),
              'country'=>$country,
              'amount_1'=>($request->has('amount_1')?$request->amount_1:null),
              'amount_2'=>($request->has('amount_2')?$request->amount_2:null),
              'amount_3'=>($request->has('amount_3')?$request->amount_3:null),
              'currency_code_id'=>($request->has('currency_code_id')?$request->currency_code_id:null),
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
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/commercialization/'.$result['main']['create']->last_insert_id.'/';

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
                  'table_name'=>'cervie_researcher_commercialization',
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
                     ->with('message','Commercialization Added');

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

    //Set Model General Representation Category
    $model['general']['representation']['category'] = new RepresentationCategoryView();

    //Get General Representation Category Select Box
    $data['general']['representation']['category'] = $model['general']['representation']['category']->selectBox();

    //Set Model commercialization
    $model['cervie']['researcher']['commercialization'] = new CervieResearcherCommercializationView();

    //Get General commercialization Type
    foreach($data['general']['representation']['category'] as $key=>$value){

      //Set Main Data Researcher Publication
      $data['main']['cervie']['researcher']['commercialization'][$value->representation_category_id] = $model['cervie']['researcher']['commercialization']->getList(
        [
          'eloquent'=>((isset($data['eloquent']))?$data['eloquent']:null),
          'column'=>[
            'employee_id'=>Auth::id(),
            'representation_category_id'=>$value->representation_category_id
          ]
        ]
      );

      //Set Table Researcher Publication
      $data['table']['column']['cervie']['researcher']['commercialization'][$value->representation_category_id] = $this->getDataTable(
        [
          'category'=>$value->representation_category_id
        ]
      );

    }

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
        $model['cervie']['researcher']['commercialization'] = new CervieResearcherCommercializationProcedure();

        //Delete Main
        $result['main']['delete'] = $model['cervie']['researcher']['commercialization']->deleteRecord(
          [
            'column'=>[
              'commercialization_id'=>$request->id,
              'employee_id'=>Auth::id()
            ]
          ]
        );

        //Set Path Folder
        $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/commercialization/'.$request->id.'/';

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
              'table_name'=>'cervie_researcher_commercialization',
              'table_id'=>$request->id
            ]
          ]
        );

        //Set Model
        $model['cervie']['researcher']['commercialization'] = new CervieResearcherCommercializationProcedure();

        //Delete Evidence
        $data['main']['verification'] = $model['cervie']['researcher']['commercialization']->needVerification(
          [
            'column'=>[
              'commercialization_id'=>$request->id,
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
                     ->with('message','commercialization Deleted');

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
        $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/commercialization/'.$data['evidence']->table_id.'/';

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
        $model['cervie']['researcher']['commercialization'] = new CervieResearcherCommercializationProcedure();

        //Set Main Verification
        $data['main']['verification'] = $model['cervie']['researcher']['commercialization']->needVerification(
          [
            'column'=>[
              'commercialization_id'=>$data['evidence']->table_id,
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
          'table_control_id'=>'cervie_researcher_commercialization'
        ]
      ]
    );

    //Set Model General commercialization Type
    $model['general']['representation']['category'] = new RepresentationCategoryView();

    //Get General commercialization Type
    $data['general']['representation']['category'] = $model['general']['representation']['category']->selectBox();

    //Set Model General Country
    $model['general']['country'] = new CountryView();

    //Get General Country
    $data['general']['country'] = $model['general']['country'] ->selectBox();

    //Set Model General Currency Code
    $model['general']['currency']['code'] = new CurrencyCodeView();

    //Get General Currency Code
    $data['general']['currency']['code'] = $model['general']['currency']['code'] ->selectBox();

    //Set Model General Status
    $model['education']['status'] = new StatusView();

    //Get General Status
    $data['education']['status'] = $model['education']['status'] ->selectBox(
      [
        'column'=>[
          'table'=>'cervie_researcher_commercialization'
        ]
      ]
    );


    //Set Model
    $model['cervie']['researcher']['commercialization'] = new CervieResearcherCommercializationProcedure();

    //Read Main
    $data['main'] = $model['cervie']['researcher']['commercialization']->readRecord(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'commercialization_id'=>$request->id
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
          'table_name'=>'cervie_researcher_commercialization',
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
    $asset['document'] = '/public/resources/researcher/'.trim(Auth::id()).'/document/commercialization/'.$request->id.'/';

    //Set Document
    $hyperlink['document'] = $request->root().'/storage/resources/researcher/'.trim(Auth::id()).'/document/commercialization/'.$request->id.'/';
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

        //Get commercialization Type
        $this->getValidateData($request);

        //Set Model
        $model['cervie']['researcher']['commercialization'] = new CervieResearcherCommercializationProcedure();

        //Create Main
        $result['main']['update'] = $model['cervie']['researcher']['commercialization']->updateRecord(
          [
            'column'=>[
              'commercialization_id'=>$request->id,
              'employee_id'=>Auth::id(),
              'commercialization_title'=>($request->has('commercialization_title')?$request->commercialization_title:null),
              'representation_category_id'=>($request->has('representation_category_id')?$request->representation_category_id:null),
              'date_approval'=>($request->has('date_approval')?$request->date_approval:null),
              'date_filing'=>($request->has('date_filing')?$request->date_filing:null),
              'status_id'=>($request->has('status_id')?$request->status_id:null),
              'country'=>$country,
              'amount_1'=>($request->has('amount_1')?$request->amount_1:null),
              'amount_2'=>($request->has('amount_2')?$request->amount_2:null),
              'amount_3'=>($request->has('amount_3')?$request->amount_3:null),
              'currency_code_id'=>($request->has('currency_code_id')?$request->currency_code_id:null),
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
                  'table_name'=>'cervie_researcher_commercialization',
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
            $path['folder'] = 'public/resources/researcher/'.trim(Auth::id()).'/document/commercialization/'.$request->id.'/';

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
                  'table_name'=>'cervie_researcher_commercialization',
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
                     ->with('message','commercialization Saved');

  }

  /**************************************************************************************
 		Get Data Table
 	**************************************************************************************/
  public function getDataTable($data){

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
        'icon'=>'<i class="mdi mdi-calendar"></i>',
        'name'=>' Date Commercialization',
      ],
      3=>[
        'icon'=>'<i class="mdi mdi-shield-check"></i>',
        'name'=>' Verfication',
      ],
      4=>[
        'icon'=>'<i class="mdi mdi-settings"></i>',
        'name'=>' Control',
      ]
    ];

    //Return Table
    return $table;

  }

}
