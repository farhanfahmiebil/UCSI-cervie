<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Qualification;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_General\MSSQL\Table\Qualification;
use App\Models\UCSI_V2_Education\MSSQL\Table\CervieResearcherAcademicQualification;

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
    'category'=>'Qualification',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.qualification.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.qualification.';

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
    $this->hyperlink['page']['ajax']['academic']['qualification'] = config('routing.application.modules.dashboard.researcher.name').'.ajax.university.cervie.qualification.view';

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
    $model['general']['qualification'] = new Qualification();

    //Get Data
    $data['general']['qualification'] = $model['general']['qualification']->selectBox();

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
        'qualification_id'=>'required',
        'qualification_name'=>'required',
        'institution_name'=>'required',
        'date_start'=>'required',
        'date_end'=>'required',
        'filename'=>'required'

      ],
      //Error Message
      [
        'qualification_id.required'=>'Qualification Type is Required',
        'qualification_name.required'=>'Qualification Name is Required',
        'institution_name.required'=>'Institution Name is Required',
        'date_start.required'=>'Date Start is Required',
        'date_end.required'=>'Date End is Required',
        'filename.required'=>'Filename is Required'

      ]
    );

    //Set Model
    $model['cervie']['researcher']['academic']['qualification'] = new CervieResearcherAcademicQualification();

    $last_id = (($model['cervie']['researcher']['academic']['qualification']->getLastID())?$model['cervie']['researcher']['academic']['qualification']->getLastID()->academic_qualification_id+1:1);
    //Attachment
    $attachment_extension = $request->filename->getClientOriginalExtension();
    $attachment_name = $last_id . "." .$attachment_extension;

    //Get Last ID
    $model['cervie']['researcher']['academic']['qualification']->academic_qualification_id = (($model['cervie']['researcher']['academic']['qualification']->getLastID())?$model['cervie']['researcher']['academic']['qualification']->getLastID()->academic_qualification_id+1:1);

    //Set Request to Model
    $model['cervie']['researcher']['academic']['qualification']->employee_id = $request->route('employee_id');
    $model['cervie']['researcher']['academic']['qualification']->qualification_id = $request->qualification_id;
    $model['cervie']['researcher']['academic']['qualification']->qualification_name = $request->qualification_name;
    $model['cervie']['researcher']['academic']['qualification']->institution_name = $request->institution_name;
    $model['cervie']['researcher']['academic']['qualification']->qualification_other = $request->qualification_other;
    $model['cervie']['researcher']['academic']['qualification']->date_start = $request->date_start;
    $model['cervie']['researcher']['academic']['qualification']->date_end = $request->date_end;
    $model['cervie']['researcher']['academic']['qualification']->filename = $attachment_name;

    $model['cervie']['researcher']['academic']['qualification']->created_by = Auth::id();
    $model['cervie']['researcher']['academic']['qualification']->created_at = Carbon::now();

    //Execute Query
    $model['cervie']['researcher']['academic']['qualification']->save();

    //File Store Location
    $request->filename->storeAs('public/resources/module/company/UCSI_EDUCATION/university/cervie/researcher/' . $request->route('employee_id') . '/academic_qualification/', $attachment_name);



    //Return Success
    return redirect()->route($hyperlink['page']['list'],['employee_id' => $request->route('employee_id')])->with('alert_type','success')
                       ->with('message','Create Academic Qualification Success');

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
    $model['cervie']['researcher']['academic']['qualification'] = new CervieResearcherAcademicQualification();

    //Get Data
    $data['main'] = $model['cervie']['researcher']['academic']['qualification']->getList(
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
        $model['cervie']['researcher']['academic']['qualification'] = new CervieResearcherAcademicQualification();

        //Check Exist
        $data['main'] = $model['cervie']['researcher']['academic']['qualification']::find($request->id);

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
    $model['cervie']['researcher']['academic']['qualification'] = new CervieResearcherAcademicQualification();

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

        $data['main']= $model['cervie']['researcher']['academic']['qualification']::find($request->id);

        //Set Data
        $data['check'] = $model['cervie']['researcher']['academic']['qualification']->checkExist(
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
         $filePath = storage_path('app/public/resources/module/company/UCSI_EDUCATION/university/cervie/researcher/' . $request->route('employee_id') . '/academic_qualification/' . $data['main']->filename);

         // Delete file if it exists
         if (File::exists($filePath)) {

           //Delete File
           File::delete($filePath);

           //Set Request to Model
           $model['cervie']['researcher']['academic']['qualification']::destroy($request->id);

         }

        //Return Success
        return back()->with('alert_type','success')
                     ->with('message','Qualification deleted');



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
    $model['cervie']['researcher']['academic']['qualification'] = new CervieResearcherAcademicQualification();
    $model['general']['qualification'] = new Qualification();

    //Set Data
    $data['main'] = $model['cervie']['researcher']['academic']['qualification']->viewSelected(
      [
        'column'=>[
          'id'=>$request->id
        ]
      ]
    );

    //Get Data
    $data['general']['qualification'] = $model['general']['qualification']->selectBox();

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
    $model['cervie']['researcher']['academic']['qualification'] = new CervieResearcherAcademicQualification();

    //Set Data
    $data['main'] = $model['cervie']['researcher']['academic']['qualification']::find($request->id);


    return response()->file(storage_path('app/public/resources/module/company/UCSI_EDUCATION/university/cervie/researcher/' . $data['main']->employee_id . '/academic_qualification/' . $data['main']->filename));

  }


}
