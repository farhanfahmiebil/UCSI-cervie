<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\General\Information\Area\Interest;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherAreaInterest AS CervieResearcherAreaInterestView;

use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherAreaInterest AS CervieResearcherAreaInterestProcedure;

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
		'module'=>'Area Interest',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.general.information.area.interest.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.general.information.area.interest.';

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

    //Check Request Validation
    $validate = $request->validate(

      // Check Validation
      [
        'name' => ['required']
      ],
      // Error Message
      [
        'name.required' => 'Name Required'
      ]
    );

    //If Form Token Exist
		if($request->has('form_token')){

			//Check Type Request
			switch($this->encrypter->decrypt($request->form_token)){

        //Create
        case 'create':

          //Set Model
          $model['cervie']['researcher']['area']['interest'] = new CervieResearcherAreaInterestStoredProcedure();

          //Set Main
          $data['main'] = $model['cervie']['researcher']['area']['interest']->createRecord(
            [
              'column'=>[
                'employee_id'=>Auth::id(),
                'name'=>$request->name,
                'created_by'=>Auth::id()
              ]
            ]
          );

        break;

      }

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['list'])
                     ->with('alert_type','success')
                     ->with('message','Researcher Area Interest Added');

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
          $model['cervie']['researcher']['area']['interest'] = new CervieResearcherAreaInterestStoredProcedure();

          //Set Main
          $data['main'] = $model['cervie']['researcher']['area']['interest']->deleteRecord(
            [
              'column'=>[
                'area_interest_id'=>$request->id,
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
                     ->with('message','Area Interest Deleted');

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
    $model['cervie']['researcher']['area']['interest'] = new CervieResearcherAreaInterestView();

    //Set Main
    $data['main'] = $model['cervie']['researcher']['area']['interest']->viewSelected(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'area_interest_id'=>$request->id
        ]
      ]
    );

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
        'name' => ['required']
    ],

    // Error Message
    [
        'name.required' => 'Name Required'
    ]
    );

    //If Form Token Exist
		if($request->has('form_token')){

			//Check Type Request
			switch($this->encrypter->decrypt($request->form_token)){

        //Create
        case 'update':

          //Set Model
          $model['cervie']['researcher']['area']['interest'] = new CervieResearcherAreaInterestStoredProcedure();

          //Set Main
          $data['main'] = $model['cervie']['researcher']['area']['interest']->updateRecord(
            [
              'column'=>[
                'area_interest_id'=>$request->area_interest_id,
                'employee_id'=>Auth::id(),
                'name'=>$request->name,
                'updated_by'=>Auth::id()
              ]
            ]
          );

        break;

      }

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['view'],['id'=>$request->area_interest_id])
                     ->with('alert_type','success')
                     ->with('message','Area Interest Saved');

  }

}
