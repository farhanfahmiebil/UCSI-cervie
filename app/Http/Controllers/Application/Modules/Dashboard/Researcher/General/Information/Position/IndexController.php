<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\General\Information\Position;

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
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherPosition AS CervieResearcherPositionView;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherPosition AS CervieResearcherPositionProcedure;

//Get Request
use Illuminate\Http\Request;

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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.general.information.position.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.general.information.position.';

    //Set Navigation
		$this->page['sub'] = $this->route['view'];

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //List
    $this->hyperlink['page']['list'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.general.information.'.'home.list';

    //Create
    $this->hyperlink['page']['create'] = $this->route['name'].'create';
    $this->hyperlink['page']['update'] = $this->route['name'].'update';
    $this->hyperlink['page']['view'] = $this->route['name'].'view';
    $this->hyperlink['page']['new'] = $this->route['name'].'new';
    // $this->hyperlink['page']['delete'] = $this->route['name'].'.delete';

		//Set Hyperlink
    // $this->hyperlink['page']['ajax']['navigation']['access']['module']['company'] = config('routing.application.modules.dashboard.'.$this->user.'.name').'.ajax.authorization.access.module.company';

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

// dd($data['general']['status']);
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

    //Check Request Validation
    $validate = $request->validate(

      // Check Validation
      [
        'name' => ['required'],
        'organization_id' => ['required'],
        'date_start' => ['required','date','before:date_end'],
        'date_end' => ['required','date','after:date_start'],
        'is_main' => ['required'],
        'status_id' => ['required'],
          // 'avatar' => ['required', 'image', 'mimetypes:image/png', 'max:1024'],
      ],
      // Error Message
      [
        'name.required' => 'Name Required',
        'organization_id.required' => 'Organization Required',
        'date_start.required' => 'Date Start Required',
        'date_start.before' => 'Date Start must be before Date End',
        'date_end.required' => 'Date End Required',
        'date_end.after' => 'Date End must be after Date Start',
        'is_main.required' => 'Is Main Position Required',
        'status_id.required' => 'Status Required',
      ]
    );

    //If Form Token Exist
		if(!$request->has('form_token')){
      abort(555,'Form Missing Token');
    }

		//Check Type Request
		switch($this->encrypter->decrypt($request->form_token)){

      //Create
      case 'create':

        //Set Model
        $model['cervie']['researcher']['position'] = new CervieResearcherPositionStoredProcedure();

        //Set Main
        $data['main'] = $model['cervie']['researcher']['position']->createRecord(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'name'=>$request->name,
              'organization_id'=>$request->organization_id,
              'organization_name'=>null,
              'is_main'=>$request->is_main,
              'user_position_id'=>null,
              'date_start'=>$request->date_start,
              'date_end'=>$request->date_end,
              'created_by'=>Auth::id()
            ]
          ]
        );

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['list'])
                     ->with('alert_type','success')
                     ->with('message','Researcher Position Added');

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
    $model['general']['organization'] = new Organization();
    $model['general']['status'] = new Status();
    $model['cervie']['researcher']['position'] = new CervieResearcherPositionView();

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

    //Set Main
    $data['main'] = $model['cervie']['researcher']['position']->viewSelected(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'position_id'=>$request->id
        ]
      ]
    );

// dd($data['main']);
// dd($data['main']->date_start);
    //Get Form Token
		$form_token = $this->encrypt_token_form;

    //Return View
		return view($this->route['view'].'view.index',compact('data','form_token','hyperlink'));

  }

  /**************************************************************************************
 		Update
 	**************************************************************************************/
	public function update(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Check Request Validation
    $validate = $request->validate(

      // Check Validation
    [
        'name' => ['required'],
        'organization_id' => ['required'],
        'date_start' => ['required', 'date'],
        'date_end' => ['required', 'date', function ($attribute, $value, $fail) use ($request) {
            $dateStart = $request->input('date_start');

            // Check if date_end is either equal to or after date_start
            if ($value != $dateStart && $value < $dateStart) {
                $fail('Date End must be equal to or after Date Start.');
            }
        }],
        'is_main' => ['required'],
        'status_id' => ['required'],
    ],

    // Error Message
    [
        'name.required' => 'Name Required',
        'organization_id.required' => 'Organization Required',
        'date_start.required' => 'Date Start Required',
        'date_start.date' => 'Date Start must be a valid date',
        'date_end.required' => 'Date End Required',
        'date_end.date' => 'Date End must be a valid date',
        'is_main.required' => 'Is Main Position Required',
        'status_id.required' => 'Status Required',
    ]
    );

    //If Form Token Exist
		if($request->has('form_token')){

			//Check Type Request
			switch($this->encrypter->decrypt($request->form_token)){

        //Create
        case 'update':

          //Set Model
          $model['cervie']['researcher']['position'] = new CervieResearcherPositionStoredProcedure();

          //Set Main
          $data['main'] = $model['cervie']['researcher']['position']->updateRecord(
            [
              'column'=>[
                'position_id'=>$request->position_id,
                'employee_id'=>Auth::id(),
                'name'=>$request->name,
                'organization_id'=>$request->organization_id,
                'organization_name'=>null,
                'is_main'=>$request->is_main,
                'user_position_id'=>null,
                'date_start'=>$request->date_start,
                'date_end'=>$request->date_end,
                'updated_by'=>Auth::id()
              ]
            ]
          );

        break;

      }

    }
// dd($request->position_id);
    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['view'],['id'=>$request->position_id])
                     ->with('alert_type','success')
                     ->with('message','Researcher Position Saved');

  }

}
