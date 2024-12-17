<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Researcher\Portfolio\Organization\User\Profile\Profile;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model General
use App\Models\UCSI_V2_General\MSSQL\View\ContactCategory;
use App\Models\UCSI_V2_General\MSSQL\View\Salutation;

//Model Main
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeLDAP;


//Model View
use App\Models\UCSI_V2_Access\MSSQL\View\NavigationCategory AS NavigationCategoryView;
use App\Models\UCSI_V2_Access\MSSQL\View\NavigationCategorySub AS NavigationCategorySubView;
use App\Models\UCSI_V2_General\MSSQL\View\AcademicIndexingBody as AcademicIndexingBodyView;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherIndexingBody as CervieResearcherIndexingBodyView;

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\Researcher AS ResearcherProcedure;
use App\Models\UCSI_V2_Main\MSSQL\Procedure\EmployeeProfile AS EmployeeProfileProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherIndexingBody AS CervieResearcherIndexingBodyProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherLog AS CervieResearcherLogProcedure;

//Get Request
use Illuminate\Http\Request;

//Get Storage
use Illuminate\Support\Facades\Storage;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'employee';

	//Path Header
	protected $header = [
    'application'=>'Dashboard',
    'category'=>'Researcher Profile',
		'module'=>'Organization',
		'module_sub'=>'User',
    'item'=>'Profile',
		'gate'=>''
	];

	//Route Link
	protected $route;

	//Asset
	public $asset;

  //Set Page
  public $page;

	//Hyperlink
	public $hyperlink;

	/**************************************************************************************
		Route Path
	**************************************************************************************/
	public function routePath(){

    //Set Route Name
		$this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.researcher.portfolio.organization.user.view.profile.profile.';

    //Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.researcher.portfolio.organization.user.view.profile.profile.';

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
    $this->page['navigation']['tab']['content']['view'] = $this->route['view'].'view.index';
    $this->page['navigation']['tab']['right'] = $this->page['main'].'navigation.tab.content.navigation.right.index';

		//Set Hyperlink
    $this->hyperlink['page']['back'] = $this->route['link'].'list';

    //General Information - Researcher Award
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
          'navigation_category_code'=>'PROFILE',
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

    $model['researcher'] = new ResearcherProcedure();
    $model['cervie']['researcher']['indexing']['body'] = new CervieResearcherIndexingBodyView();
    $model['general']['academic']['indexing']['body'] = new AcademicIndexingBodyView();

    //Get General Salulation
    $data['general']['academic']['indexing']['body'] = $model['general']['academic']['indexing']['body']->selectBox();
// dd($data['general']['academic']['indexing']['body']);

    //Read Main
    $data['researcher'] = $model['researcher']->readRecord(
      [
        'column'=>[
          'employee_id'=>$request->employee_id,
        ]
      ]
    );

    $data['cervie']['researcher']['indexing']['body'] = $model['cervie']['researcher']['indexing']['body']->getList(
      [
        'column'=>[
          'employee_id'=>$request->employee_id,
        ]
      ]
    );

    if($data['researcher']->need_verification_main){

      //Set Model Researcher - Employee Profile
      $model['cervie']['researcher']['log'] = new CervieResearcherLogProcedure();

      //Get Employee Profile
      $data['cervie']['researcher']['log']['researcher'] = $model['cervie']['researcher']['log']->readRecord(
        [
          'column'=>[
            'employee_id'=>$request->employee_id,
            'table_name'=>'researcher',
            'auditable_id' => $request->employee_id,
            'category' => 'main'
          ]
        ]
      );

      //Get Employee Profile
      $data['cervie']['researcher']['log']['indexing']['body'] = $model['cervie']['researcher']['log']->readRecord(
        [
          'column'=>[
            'employee_id'=>$request->employee_id,
            'table_name'=>'cervie_researcher_indexing_body',
            'auditable_id' => $request->employee_id,
            'category' => 'main'
          ]
        ]
      );

    }


    //Set Page
    $page = $this->page;

    //Set Page Pointer
    $page['navigation']['tab']['pointer'] =  $page['navigation']['tab']['content']['view'];
    // dd(  $page['navigation']['tab']['pointer']);
    //Get Form Token
    $form_token = $this->encrypt_token_form;

		//Return View
    return view($this->route['link'].'view.navigation.content.list.index',compact('data','page','form_token','hyperlink'));

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

    //Check Request Validation
    $validate = $request->validate(

      //Check Validation
      [
        'description'=>['required']
      ],
      //Error Message
      [
        'description.required'=>'Description Required'
      ]
    );

    //Set Model
    $model['researcher']['main'] = new ResearcherProcedure();

    //Create Main
    $result['researcher']['main'] = $model['researcher']['main']->updateRecord(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'description'=>($request->has('description')?$request->description:null),
          'need_verification'=>0,
          'table_name'=>'researcher',
          'remark'=>($request->has('remark')?$request->remark:null),
          'remark_user'=>($request->has('remark_user')?$request->remark_user:null),
          'updated_by'=>Auth::id()
        ]
      ]
    );

    $count = 0;

    // dd($request->hyperlink);

    if($request->has('indexing_body_id')){

      foreach($request->indexing_body_id as $key=>$value){

        $model['cervie']['researcher']['indexing']['body'] = new CervieResearcherIndexingBodyProcedure();

        //Create Main
        $model['cervie']['researcher']['indexing']['body'] = $model['cervie']['researcher']['indexing']['body']->updaterecord(
          [
            'column'=>[
              'indexing_body_id'=>$value,
              'employee_id'=>Auth::id(),
              'academic_indexing_body_id'=>$request->academic_indexing_body_id[$key],
              'hyperlink'=>$request->hyperlink[$key],
              'need_verification'=>0,
              'table_name'=>'cervie_researcher_indexing_body',
              'remark'=>($request->has('remark')?$request->remark:null),
              'remark_user'=>($request->has('remark_user')?$request->remark_user:null),
              'updated_by'=>Auth::id()
            ]
          ]
        );

        $count++;
      }

    }else{
      // Count of items to loop through
      $count_index = count($request->academic_indexing_body_id);

      for ($key = 0; $key < $count_index; $key++) {

        $model['cervie']['researcher']['indexing']['body'] = new CervieResearcherIndexingBodyProcedure();


          // Create Main
          $model['cervie']['researcher']['indexing']['body'] = $model['cervie']['researcher']['indexing']['body']->createRecord(
              [
                  'column' => [
                      'employee_id' => Auth::id(),
                      'academic_indexing_body_id' => $request->academic_indexing_body_id[$count],
                      'hyperlink' => $request->hyperlink[$count],
                      'need_verification' => 0,
                      'table_name'=>'cervie_researcher_indexing_body',
                      'remark' => ($request->has('remark') ? $request->remark : null),
                      'remark_user' => ($request->has('remark_user') ? $request->remark_user : null),
                      'created_by' => Auth::id()
                  ]
              ]
          );

          $count++;  // Increment the count (although this is unnecessary in this case)
      }

    }

    break;

  }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['view'],['organization_id'=>$request->organization_id,'employee_id'=>$request->employee_id,'id'=>$request->id])
                     ->with('alert_type','success')
                     ->with('message','Researcher Avatar Saved');
  }

}
