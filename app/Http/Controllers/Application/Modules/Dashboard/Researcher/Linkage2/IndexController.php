<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Linkage;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_General\MSSQL\Table\AgreementType;
use App\Models\UCSI_V2_General\MSSQL\Table\AgreementLevel;
use App\Models\UCSI_V2_General\MSSQL\Table\LinkageCategory;
use App\Models\UCSI_V2_General\MSSQL\Table\Country;
use App\Models\UCSI_V2_Education\MSSQL\Table\CervieResearcherLinkage;
use App\Models\UCSI_V2_Education\MSSQL\Table\CervieResearcherEvidence;

//Get Request
use Illuminate\Http\Request;

//Get Request
use File;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'researcher';

  //Path Header
	protected $header = [
		'application'=>'Dashboard',
    'category'=>'Linkage',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.linkage.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.linkage.';

    //Set Navigation
		$this->page['sub'] = $this->route['view'];

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];
    $this->hyperlink['page']['view'] = $this->route['name'].'view';
    $this->hyperlink['page']['new'] = $this->route['name'].'new';
    $this->hyperlink['page']['list'] = $this->route['name'].'list';
    $this->hyperlink['page']['create'] = $this->route['name'].'create';
    $this->hyperlink['page']['delete'] = $this->route['name'].'delete';
    $this->hyperlink['page']['view_file'] = $this->route['name'].'view_file';
    $this->hyperlink['page']['update'] = $this->route['name'].'update';
    $this->hyperlink['page']['ajax']['linkage'] = config('routing.application.modules.dashboard.researcher.name').'.ajax.university.cervie.linkage.view';
    $this->hyperlink['page']['ajax']['evidence'] = config('routing.application.modules.dashboard.researcher.name').'.ajax.university.cervie.evidence.view';

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
		$data['title'] = array($this->header['category']);

    //Set Model
    $model['general']['agreement']['level'] = new AgreementLevel();
    $model['general']['agreement']['type'] = new AgreementType();
    $model['general']['linkage']['category'] = new LinkageCategory();
    $model['general']['country'] = new Country();

    //Get Data
    $data['general']['agreement']['level'] = $model['general']['agreement']['level']->selectBox();
    $data['general']['agreement']['type'] = $model['general']['agreement']['type']->selectBox();
    $data['general']['linkage']['category'] = $model['general']['linkage']['category']->selectBox();
    $data['general']['country'] = $model['general']['country']->selectBox();

		//Return View
		return view($this->route['view'].'new.index',compact('data','page','hyperlink'));

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
      //Check Validation
      [
        'title'=>'required',
        'organization'=>'required',
        'linkage_category_id'=>'required',
        'agreement_level_id'=>'required',
        'agreement_type_id'=>'required',
        'amount'=>'required',
        'country_id'=>'required',
        'date_start'=>'required',
        'date_end'=>'required',

      ],
      //Error Message
      [
        'title.required'=>'Qualification Type is Required',
        'organization.required'=>'Organization is Required',
        'linkage_category_id.required'=>'Category is Required',
        'agreement_level_id.required'=>'Agreement Level is Required',
        'agreement_type_id.required'=>'Agreement Type is Required',
        'amount.required'=>'Amount is Required',
        'country_id.required'=>'Country is Required',
        'date_start.required'=>'Date Start is Required',
        'date_end.required'=>'Date End is Required',

      ]
    );

    //Set Model
    $model['cervie']['researcher']['linkage'] = new CervieResearcherLinkage();

    //Get Last ID
    $last_id = (($model['cervie']['researcher']['linkage']->getLastID())?$model['cervie']['researcher']['linkage']->getLastID()->linkage_id+1:1);
// dd($request);
    //Get Last ID
    $model['cervie']['researcher']['linkage']->linkage_id = $last_id;

    //Set Request to Model
    $model['cervie']['researcher']['linkage']->employee_id = $request->route('employee_id');
    $model['cervie']['researcher']['linkage']->organization = $request->organization;
    $model['cervie']['researcher']['linkage']->title = $request->title;
    $model['cervie']['researcher']['linkage']->agreement_level_id = $request->agreement_level_id;
    $model['cervie']['researcher']['linkage']->agreement_type_id = $request->agreement_type_id;
    $model['cervie']['researcher']['linkage']->amount = $request->amount;
    $model['cervie']['researcher']['linkage']->country_id = $request->country_id;
    $model['cervie']['researcher']['linkage']->linkage_category_id = $request->linkage_category_id;
    $model['cervie']['researcher']['linkage']->date_start = $request->date_start;
    $model['cervie']['researcher']['linkage']->date_end = $request->date_end;

    $model['cervie']['researcher']['linkage']->created_by = Auth::id();
    $model['cervie']['researcher']['linkage']->created_at = Carbon::now();

    //Execute Query
    $model['cervie']['researcher']['linkage']->save();

    if($request->has('file')){

      foreach($request->file as $key => $value){

        //Set Model
        $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidence();


        //Get Last ID
        $last_evidence_id = (($model['cervie']['researcher']['evidence']->getLastID())?$model['cervie']['researcher']['evidence']->getLastID()->evidence_id+1:1);

        //Attachment
        $attachment_extension = $value->getClientOriginalExtension();
        $attachment_name = $last_id;
        $attachment_original_name = $value->getClientOriginalName();

        $model['cervie']['researcher']['evidence']->evidence_id = $last_evidence_id;
        $model['cervie']['researcher']['evidence']->employee_id = $request->route('employee_id');
        $model['cervie']['researcher']['evidence']->researcher_category_id = $last_id;
        $model['cervie']['researcher']['evidence']->file_raw_name = $attachment_original_name;
        $model['cervie']['researcher']['evidence']->file_name = $attachment_name;
        $model['cervie']['researcher']['evidence']->file_extension = $attachment_extension;
        $model['cervie']['researcher']['evidence']->description = $request->description[$key];
        $model['cervie']['researcher']['evidence']->category = 'cervie_researcher_linkage';
        $model['cervie']['researcher']['evidence']->created_by = Auth::id();
        $model['cervie']['researcher']['evidence']->created_at = Carbon::now();
        //Execute Query
        $model['cervie']['researcher']['evidence']->save();

        //File Store Location
        $value->storeAs('public/resources/module/company/UCSI_EDUCATION/university/cervie/researcher/' . $request->route('employee_id') . '/linkage/' .  $last_id, $attachment_name . "." .$attachment_extension);

      }

    }



    //Return Success
    return redirect()->route($hyperlink['page']['list'],['employee_id' => $request->route('employee_id')])->with('alert_type','success')
                       ->with('message','Create Linkage Success');

    //Return View
    return view($this->route['view'].'.index',compact('data','hyperlink'));

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

    $page['sub'] .= 'list.sub';
    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-house"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = ['Welcome Back, '.Auth::user()->name];

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

    //Set Model
    $model['cervie']['researcher']['linkage'] = new CervieResearcherLinkage();

    //Get Data
    $data['main'] = $model['cervie']['researcher']['linkage']->getList(
      [
        'column'=>[
          'employee_id'=>$request->route('employee_id')
        ]
      ]
    );


		//Return View
		return view($this->route['view'].'list.index',compact('data','page','hyperlink'));

  }

  /**************************************************************************************
 		Update
 	**************************************************************************************/
	public function update(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Redirect
    $redirect = [];

        //Check Request Validation
        $validate = $request->validate(

          //Check Validation
          [
            'id'=>'required',
            'qualification_id'=>'required',
            'qualification_name'=>'required',
            'institution_name'=>'required',
            'date_start'=>'required',
            'date_end'=>'required',
            'filename'=>'mimetypes:application/pdf'

          ],
          //Error Message
          [
            'id.required'=>'Academic Qualification ID is Required',
            'qualification_id.required'=>'Qualification Type is Required',
            'qualification_name.required'=>'Qualification Name is Required',
            'institution_name.required'=>'Institution Name is Required',
            'date_start.required'=>'Date Start is Required',
            'date_end.required'=>'Date End is Required',

          ]
        );

        //Set Model
        $model['cervie']['researcher']['linkage'] = new CervieResearcherAcademicQualification();

        //Check Exist
        $data['main'] = $model['cervie']['researcher']['linkage']::find($request->id);

        //If Query Not found
        if(!$data['main']){

          //Return Failed
          return back()->with('alert_type','error')
                       ->with('message','Data Not Exist');

        }

        //Attachment
        if($request->filename){
          $attachment_extension = $request->filename->getClientOriginalExtension();
          $attachment_name = $data['main']->academic_qualification_id . "." .$attachment_extension;
          $data['main']->filename = $attachment_name;

          File::delete(public_path('storage/resources/module/company/UCSI_EDUCATION/university/cervie/researcher/'. $request->route('employee_id') . '/academic_qualification/' . $data['main']->filename));

          //File Store Location
          $request->filename->storeAs('public/resources/module/company/UCSI_EDUCATION/university/cervie/researcher/' . $request->route('employee_id') . '/academic_qualification/', $attachment_name);

        }

        //Set Request to Model
        $data['main']->employee_id = $request->route('employee_id');
        $data['main']->qualification_id = $request->qualification_id;
        $data['main']->qualification_name = $request->qualification_name;
        $data['main']->institution_name = $request->institution_name;
        $data['main']->qualification_other = $request->qualification_other;
        $data['main']->date_start = $request->date_start;
        $data['main']->date_end = $request->date_end;
        $data['main']->updated_by = Auth::id();
        $data['main']->updated_at = Carbon::now();

        //Execute Query
        $data['main']->save();

        //Return Success
        return back()->with('alert_type','success')
                     ->with('message','Qualification Updated');

  }

  /**************************************************************************************
    Delete
  **************************************************************************************/
  public function delete(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Set Model
    $model['cervie']['researcher']['linkage'] = new CervieResearcherLinkage();

      //Check Request Validation
      $validate = $request->validate(
        //Check Validation
        [
          'id'=>'required'
        ],
        //Error Message
        [
          'id.required'=>'ID is Required'
        ]
      );

        $data['main']= $model['cervie']['researcher']['linkage']::find($request->id);

        //Set Data
        $data['check'] = $model['cervie']['researcher']['linkage']->checkExist(
          [
            'column'=>[
              'id'=>$request->id,
            ]
          ]
        );

        if($data['check'] < 1){

          //Return Failed
          return back()->with('alert_type','error')
                       ->with('message','No data found');
        }

         // Construct the file path
         $filePath = storage_path('app/public/resources/module/company/UCSI_EDUCATION/university/cervie/researcher/' . $request->route('employee_id') . '/linkage/' . $data['main']->linkage_id);

         // Delete file if it exists
         if (File::exists($filePath)) {

           //Delete File
           File::deleteDirectory($filePath);

           //Set Request to Model
           $model['cervie']['researcher']['linkage']::destroy($request->id);

         }

        //Return Success
        return back()->with('alert_type','success')
                     ->with('message','Linkage deleted');



  }

  /**************************************************************************************
 		Index
 	**************************************************************************************/
	public function view(Request $request){

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
    $data['title'] = array($this->header['category']);

    // Set Model
    $model['cervie']['researcher']['linkage'] = new CervieResearcherLinkage();
    $model['general']['agreement']['level'] = new AgreementLevel();
    $model['general']['agreement']['type'] = new AgreementType();
    $model['general']['linkage']['category'] = new LinkageCategory();
    $model['general']['country'] = new Country();

    //Get Data
    $data['general']['agreement']['level'] = $model['general']['agreement']['level']->selectBox();
    $data['general']['agreement']['type'] = $model['general']['agreement']['type']->selectBox();
    $data['general']['linkage']['category'] = $model['general']['linkage']['category']->selectBox();
    $data['general']['country'] = $model['general']['country']->selectBox();

    //Set Data
    $data['main'] = $model['cervie']['researcher']['linkage']->viewSelected(
      [
        'column'=>[
          'id'=>$request->id
        ]
      ]
    );

    //Set Data
    $data['evidence'] = $model['cervie']['researcher']['linkage']->getList(
      [
        'column'=>[
          'id'=>$request->id
        ]
      ]
    );

		//Return View
		return view($this->route['view'].'view.index',compact('data','hyperlink'));

  }

  /**************************************************************************************
    View File
  **************************************************************************************/
  public function viewFile(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    // Set Model
    $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidence();

    //Set Data
    $data['main'] = $model['cervie']['researcher']['evidence']::find($request->id);


    return response()->file(storage_path('app/public/resources/module/company/UCSI_EDUCATION/university/cervie/researcher/' . $data['main']->employee_id . '/linkage/'. $data['main']->researcher_category_id . '/'. $data['main']->file_name. '.' . $data['main']->file_extension));

  }


}
