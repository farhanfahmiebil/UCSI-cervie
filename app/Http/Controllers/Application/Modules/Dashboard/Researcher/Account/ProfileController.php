<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Account;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_General\MSSQL\Table\Company;
use App\Models\UCSI_V2_General\MSSQL\Table\ContactCategory;
use App\Models\UCSI_V2_General\MSSQL\Table\Salutation;
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeProfile;
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeContact;
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeePosition;
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeVirtualCard;
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeSalutation;

//Get Request
use Illuminate\Http\Request;

//Get Storage
use Illuminate\Support\Facades\Storage;

//Get Class
class ProfileController extends Controller{

	//Application
  protected $application = 'application';

  //Application
  protected $page = 'account';

  //User
  protected $user = 'employee.researcher';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'Account',
		'sub'=>'Profile',
		'gate'=>''
	];

	//Route Link
	protected $route;

	//Asset
	public $asset;

	//Hyperlink
	public $hyperlink;

	/**************************************************************************************
		Route Path
	**************************************************************************************/
	public function routePath(){

		//Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.'.$this->page.'.profile.view';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.'.$this->page.'.profile';

		//Set Image Route
		// $this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/home/';

    //Set Navigation
    $this->hyperlink['page']['update'] = $this->route['name'].'.update';
    $this->hyperlink['page']['view'] = $this->route['name'].'.view';
    $this->hyperlink['page']['download'] = $this->route['name'].'.view.download';
    $this->hyperlink['page']['virtual']['card'] = config('routing.application.modules.landing.name').'.virtual_card.index';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Set Page Sub
    // $this->hyperlink['page']['sub'] = $this->route['view'].'.navigation';
    $this->hyperlink['page']['navigation']['main'] = $this->route['view'].'.navigation.main';
    $this->hyperlink['page']['navigation']['setting'] = $this->route['view'].'.navigation.setting';
// dd($this->hyperlink['page']['download']);
	}

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){
// dd(32);
// abort(404);

// phpinfo();
// exit();
// $routes = \Route::getRoutes();
// dd($routes);
  // return view($this->route['view'].'route', compact('routes'));

    // dd(\Auth::guard());
		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Check If Not Empty
    if(empty($request->tab_category)){

      //Return to Default Route
      return redirect()->route($hyperlink['page']['view'],['tab'=>'tab','tab_category'=>'personal']);

    }

    //Check If Tab Category is Setting And Not Empty Tab Sub Category
    if($request->tab_category == 'setting' && empty($request->tab_sub_category)){
// dd(32);
      //Return to Default Route
      return redirect()->route($hyperlink['page']['view'],['tab'=>'tab','tab_category'=>'setting','tab_sub_category'=>'virtual_card']);

    }

    //Set Breadcrumb
		$data['breadcrumb']['icon'] = '<i class=\'bi bi-person\'></i>';
    $data['breadcrumb']['title'] = array($this->header['category'],$this->header['module'],$this->header['sub']);

    //Set Input Status
    $data['input']['status'] = '';

    //Check Status is Pending
    if(Auth::user()->employee->status->name == 'pending'){

      //Set Input Status Disabled
      $data['input']['status'] = 'disabled';

    }

    //Get Tab Category
    switch($request->tab_category){

      //Avatar
      case 'avatar':

      break;

      //Work
      case 'work':

        //Set Model
        $model['employee']['position'] = new EmployeePosition();

        //Get Data
        $data['employee']['position'] = $model['employee']['position']::find(Auth::id());

      break;

      //Personal
      case 'personal':

        //Set Model
        $model['general']['salutation'] = new Salutation();
        $model['employee']['profile'] = new EmployeeProfile();
        $model['employee']['salutation'] = new EmployeeSalutation();
// dd($hyperlink);
        //Get Data
        $data['general']['salutation'] = json_encode($model['general']['salutation']->selectBox());
        $data['employee']['profile'] = $model['employee']['profile']::find(Auth::id());
        $data['employee']['salutation'] = $model['employee']['salutation']->getSalutation(
          [
            'column'=>[
              'employee_id'=>Auth::id()
            ]
          ]
        );
// dd($data['employee']['salutation']);
        $salutations = []; // Initialize an empty array to store salutation IDs

        // Iterate over each item in the array
        foreach($data['employee']['salutation'] as $item){
            // Add the salutation ID to the $salutations array
            $salutations[] = $item->salutation_id;
        }

        // Convert the array of salutation IDs into a single string separated by commas
        $data['employee']['salutation_id'] = implode(',', $salutations);
// dd($data['employee']['salutation_id']);
// echo $salutationsString; // Output the result
//
// dd($data['employee']['salutation']);
      break;

      //My QR
      case 'qr':

        //Set Model
        $model['employee']['profile'] = new EmployeeProfile();

        //Get Data
        $data['employee']['profile'] = $model['employee']['profile']::find(Auth::id());

      break;

      //Contact
      case 'contact':

        //Set Model
        $model['contact']['category'] = new ContactCategory();
        $model['employee']['contact'] = new EmployeeContact();

        //Get Data

        //Get Office Telephone Number
        $data['employee']['contact']['office']['telephone']['number'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'contact_category_id'=>2,
            ]
          ]
        );
// dd($data['employee']['contact']['office']['telephone']['number']);
        //Get Office Telephone Extension Number
        $data['employee']['contact']['office']['telephone_extension']['number'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'contact_category_id'=>3,
            ]
          ]
        );

        //Get Mobile Number
        $data['employee']['contact']['mobile']['phone']['number'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'contact_category_id'=>6,
            ]
          ]
        );

        //Get Internal Email Office
        $data['employee']['contact']['email']['office']['internal'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'contact_category_id'=>12,
            ]
          ]
        );

        //Get External Email Office
        $data['employee']['contact']['email']['office']['external'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
              'contact_category_id'=>13,
            ]
          ]
        );

      break;

      //Setting
      case 'setting':

        //Get Tab Sub Category
        switch($request->tab_sub_category){

          //Virtual Card
          case 'virtual_card':

            //Set Model
            $model['company'] = new Company();

            //Set Data Status
            $data['company'] = $model['company']->selectBox();

            //Set Model
            $model['employee']['virtual_card'] = new EmployeeVirtualCard();

            //Get Data
            $data['employee']['virtual_card'] = $model['employee']['virtual_card']::find(Auth::id());

            // dd($data['employee']['virtual_card']->logo_header);
          break;

        }

      break;

      default:
        // code...


      break;

    }

		//Return View
		return view($this->route['view'].'.index',compact('data','hyperlink'));

  }

  /**************************************************************************************
 		Update
 	**************************************************************************************/
	public function update(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Get Tab Category
    switch($request->tab_category){

      //Avatar
      case 'avatar':

        //Check Request Validation
        $validate = $request->validate(

          //Check Validation
          [
            'avatar'=>['required','image:png','mimetypes:image/png','max:1024'],
          ],
          //Error Message
          [
            'avatar.required'=>'Avatar Required',
            'avatar.image'=>'File Must Be Image',
            'avatar.mimetypes'=>'Avatar Must Be PNG',
            'avatar.max'=>'Avatar Maximum Size is 1MB'
          ]
        );

        //Get Extension
        $file['extension'] = $request->avatar->getClientOriginalExtension();

        //Set Path Folder
        $path['folder'] = 'public/resources/employee/'.trim(Auth::id()).'/avatar/';

        //Set File Name
        $file['name'] = 'index.'.$file['extension'];

        //Set Path to Upload
        $path['upload'] = $path['folder'].''.$file['name'];

        // dd(Storage::disk()->exists('public/resources/employee/41459/avatar/index.png'),$path['upload'],Storage::disk()->exists($path['upload']));
        // dd(Storage::files($path['folder']));
        // dd(Storage::directories($path['folder']),$path['folder']);
        //Check Exist Storage File
        $check['exist']['storage'] = Storage::disk()->exists($path['upload']);
// dd($check['exist']['storage']);
        //If Exist
        if($check['exist']['storage']){

          //Delete File
          Storage::disk()->delete($path);

        }

        //Store File in FTP Storage
        Storage::disk()->put($path['upload'],fopen($request->file('avatar'),'r+'));

      break;

      //Personal
      case 'personal':

        //Check Request Validation
        $validate = $request->validate(

          //Check Validation
          [
            'salutation_id'=>['nullable'],
            'full_name'=>['required'],
            'first_name'=>['required'],
            'middle_name'=>['nullable'],
            'last_name'=>['required'],
            'nickname'=>['nullable'],
            'dob'=>['required'],
          ],
          //Error Message
          [
            'full_name.required'=>'Full Name Required',
            'first_name.required'=>'First Name Required',
            'last_name.required'=>'Last Name Required',
            'dob.required'=>'Date of Birth Required',
          ]
        );

        //Set Model
        $model['employee']['profile'] = new EmployeeProfile();

        //Check Exist
        $data['main'] = $model['employee']['profile']::find(Auth::id());

        //If Query Not found
        if(!$data['main']){

          //Return Failed
          return back()->with('alert_type','error')
                       ->with('message','Data Not Exist');

        }
// dd($request->salutation_id);
        //Set Query
        // $data['main']->salutation_id = $request->salutation_id;
        $data['main']->full_name = $request->full_name;
        $data['main']->first_name = $request->first_name;
        $data['main']->middle_name = $request->middle_name;
        $data['main']->last_name = $request->last_name;
        $data['main']->nickname = $request->nickname;
        $data['main']->dob = $request->dob;
        $data['main']->save();

        $salutation = explode(',',$request->salutation_id);

        // dd($salutation);

        if(count($salutation) >= 1){

          //Set Model
          $model['employee']['salutation'] = new EmployeeSalutation();

          //Delete Data
          $model['employee']['salutation']::where('employee_id',Auth::id())
                                          ->delete();

          foreach($salutation as $key=>$value){

            //Set Model
            $model['employee']['salutation'] = new EmployeeSalutation();

            //Set Data
            $model['employee']['salutation']->employee_id = Auth::id();
            $model['employee']['salutation']->salutation_id = $value;
            $model['employee']['salutation']->ordering = $key;
            $model['employee']['salutation']->created_by = Auth::id();
            $model['employee']['salutation']->created_at = Carbon::now();
            $model['employee']['salutation']->save();

          }

        }

        //Set Model
        // $model['employee']['salutation'] = new EmployeeSalutation();
        //
        // $data['main']->full_name = $request->full_name;
        // $data['main']->first_name = $request->first_name;
        // $data['main']->middle_name = $request->middle_name;
        // $data['main']->last_name = $request->last_name;
        // $data['main']->nickname = $request->nickname;
        // $data['main']->dob = $request->dob;
        // $data['main']->save();

        //Return Success
        // return redirect()->route($hyperlink['page']['view'],['tab'=>'tab','tab_category'=>$request->tab_category])
        //                  ->with('message',ucwords($request->tab_category).' Updated');



      break;

      //Contact
      case 'contact':

        //Check Request Validation
        $validate = $request->validate(
          //Check Validation
          [
            'name'=>['required'],
          ],
          //Error Message
          [
            'name.required'=>'Contact Required'
          ]
        );
        // dd($request);
        $k =3;
        // dd($request->name);
// dd($request,$request->name[$k],(!empty($request->name[$k])));
        //Check Contact Category ID Exist
        if($request->has('contact_category_id') && $request->has('contact_category_id')){

          //Get Loop Data Contact Category ID
          foreach($request->contact_category_id as $key=>$value){

            if(!empty($request->name[$key])){

              //Set Model
              $model['employee']['contact'] = new EmployeeContact();

              //Get Data
              // $model['employee']['contact']::updateOrCreate(
              //     [
              //       'contact_category_id'=>$value,
              //       'employee_id' => Auth::id()
              //     ],
              //     [
              //       'contact_category_id'=>$value,
              //       'employee_id' => Auth::id(),
              //       'name' =>$request->name[$key]
              //     ]
              // );

              $model['employee']['contact']::upsert([
                [
                  'contact_category_id'=>$value,
                  'employee_id' => Auth::id(),
                  'name' =>$request->name[$key]
                ],
              ],
              uniqueBy: ['employee_id', 'contact_category_id'],
              update:
                [
                  'contact_category_id',
                  'employee_id',
                  'name'
                ]
              );

              // echo $key.'='.$value.'-'.$request->name[$key].'-'.Auth::id();
              // echo '<br>';

            }
            // dd(
            //   [
            //     'contact_category_id'=>$value,
            //     'employee_id' => Auth::id(),
            //     'name' =>$request->name[$key]
            //   ],
            //   [
            //     'contact_category_id'=>$value,
            //     'employee_id' => Auth::id(),
            //     'name' =>$request->name[$key]
            //   ]
            // );

          }

          // dd(1);

        }

        // dd(1);
        //Return Success
        // return redirect()->route($hyperlink['page']['view'],['id'=>$request->id,'tab'=>'tab','tab_category'=>$request->tab_category])
        //                  ->with('message',ucwords($request->tab_category).' Updated');


      break;

      //Setting
      case 'setting':

        //Get Tab Sub Category
        switch($request->tab_sub_category){

          //Virtual Card
          case 'virtual_card':

            //Merge Array Into String
            $company_id = implode(',',$request->company_id);


            //Set Model
            $model['employee']['virtual_card'] = new EmployeeVirtualCard();

            //Check Exist
            $check['exist'] = $model['employee']['virtual_card']->checkExist(
              [
                'column'=>[
                  'id'=>Auth::id()
                ]
              ]
            );

            //IF Not Exist
            if($check['exist']){

              //Check Exist
              $data['main'] = $model['employee']['virtual_card']::find(Auth::id());

              $data['main']->logo_header = $company_id;
              $data['main']->created_by = Auth::id();
              $data['main']->created_at = Carbon::now();
              $data['main']->save();

            }else{

              $model['employee']['virtual_card']->logo_header = $company_id;
              $model['employee']['virtual_card']->employee_id = Auth::id();
              $model['employee']['virtual_card']->created_by = Auth::id();
              $model['employee']['virtual_card']->created_at = Carbon::now();
              $model['employee']['virtual_card']->save();

            }

          break;

      }

      break;

    }

    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['view'],['tab'=>'tab','tab_category'=>$request->tab_category])
                     ->with('message',ucwords($request->tab_category).' Updated');

  }

  /**************************************************************************************
 		Download
 	**************************************************************************************/
  public function download(Request $request){
// dd($request->category);

    //If Request Category Exist
    if(isset($request->category)){

      //Get Category
      switch($request->category){

        //QR
        case 'qr':

        response()->streamDownload(
            function () {
                echo QrCode::size(200)
                          ->format('png')
                          ->generate('https://harrk.dev');
            },
            'qr-code.png',
            [
                'Content-Type' => 'image/png',
            ]
        );

        break;

        default:
          // code...
          break;
      }

    }

  }

}
