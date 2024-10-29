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

//Model Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\Researcher AS ResearcherProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\ResearcherScopus AS ResearcherScopusProcedure;

//Get Request
use Illuminate\Http\Request;

//Get Storage
use Illuminate\Support\Facades\Storage;

//Get Validator
use Validator;


//Get Class
class ProfileController extends Controller{

	//Application
  protected $application = 'application';

  //Application
  protected $page = 'account';

  //User
  protected $user = 'researcher';

  //Path Header
	protected $header = [
		'application'=>'Dashboard',
    'category'=>'Profile',
		'module'=>'',
		'module_sub'=>'',
    'item'=>'',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.account.profile';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.account.profile';

    //Set Navigation
    $this->hyperlink['page']['update'] = $this->route['name'].'.update';
    $this->hyperlink['page']['view'] = $this->route['name'].'.view';
    $this->hyperlink['page']['download'] = $this->route['name'].'.view.download';
    $this->hyperlink['page']['virtual']['card'] = config('routing.application.modules.landing.name').'.virtual_card.index';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Set Page Sub
    $this->hyperlink['page']['navigation']['main'] = $this->route['view'].'.view.navigation.main';
    $this->hyperlink['page']['navigation']['setting'] = $this->route['view'].'.view.navigation.setting';

	}

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){
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

    //Check If Not Empty
    if(empty($request->tab_category)){

      //Return to Default Route
      return redirect()->route($hyperlink['page']['view'],['tab'=>'tab','tab_category'=>'personal']);

    }

    //Check If Tab Category is Setting And Not Empty Tab Sub Category
    if($request->tab_category == 'setting' && empty($request->tab_sub_category)){

      //Return to Default Route
      return redirect()->route($hyperlink['page']['view'],['tab'=>'tab','tab_category'=>'setting','tab_sub_category'=>'virtual_card']);

    }

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
      case 'profile':

        //Set Model
        $model['employee']['profile'] = new EmployeeProfile();
        $model['researcher'] = new ResearcherProcedure();

        //Read Main
        $data['researcher'] = $model['researcher']->readRecord(
          [
            'column'=>[
              'employee_id'=>Auth::id(),
            ]
          ]
        );

        //Get Data
        $data['employee']['profile'] = $model['employee']['profile']::find(Auth::id());

      break;

      //Personal
      case 'personal':

        //Set Model
        $model['general']['salutation'] = new Salutation();
        $model['employee']['profile'] = new EmployeeProfile();
        $model['employee']['salutation'] = new EmployeeSalutation();

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

        $salutations = []; // Initialize an empty array to store salutation IDs

        // Iterate over each item in the array
        foreach($data['employee']['salutation'] as $item){
            // Add the salutation ID to the $salutations array
            $salutations[] = $item->salutation_id;
        }

        // Convert the array of salutation IDs into a single string separated by commas
        $data['employee']['salutation_id'] = implode(',', $salutations);

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

          break;

        }

      break;

      default:
        // code...


      break;

    }

    //Get Form Token
    $form_token = $this->encrypt_token_form;

		//Return View
		return view($this->route['view'].'.view.index',compact('data','hyperlink','form_token'));

  }

  public function update(Request $request) {

      // Get Route Path
      $this->routePath();

      // Set Hyperlink
      $hyperlink = $this->hyperlink;

      // If Form Token Exist
      if (!$request->has('form_token')) {abort(555, 'Form Token Missing');}

      $this->getValidateData($request);

      // Check Type Request
      switch ($this->encrypter->decrypt($request->form_token)) {

          // Create
          case 'update':

              // Get Tab Category
              switch ($request->tab_category) {

                  // Avatar
                  case 'avatar':
                      // Check Request Validation
                      $validate = $request->validate(
                          [
                              'avatar' => ['required', 'image:png', 'mimetypes:image/png', 'max:1024'],
                          ],
                          [
                              'avatar.required' => 'Avatar Required',
                              'avatar.image' => 'File Must Be Image',
                              'avatar.mimetypes' => 'Avatar Must Be PNG',
                              'avatar.max' => 'Avatar Maximum Size is 1MB'
                          ]
                      );

                      // Get Extension
                      $file['extension'] = $request->avatar->getClientOriginalExtension();

                      // Set Path Folder
                      $path['folder'] = 'public/resources/employee/' . trim(Auth::id()) . '/avatar/';

                      // Set File Name
                      $file['name'] = 'index.' . $file['extension'];

                      // Set Path to Upload
                      $path['upload'] = $path['folder'] . '' . $file['name'];

                      // Check Exist Storage File
                      $check['exist']['storage'] = Storage::disk()->exists($path['upload']);

                      // If Exist
                      if ($check['exist']['storage']) {
                          // Delete File
                          Storage::disk()->delete($path['upload']);
                      }

                      // Store File in FTP Storage
                      Storage::disk()->put($path['upload'], fopen($request->file('avatar'), 'r+'));
                      break;

                  // Personal
                  case 'personal':
                      // Check Request Validation
                      $validate = $request->validate(
                          [
                              'salutation_id' => ['nullable'],
                              'full_name' => ['required'],
                              'first_name' => ['required'],
                              'middle_name' => ['nullable'],
                              'last_name' => ['required'],
                              'nickname' => ['nullable'],
                              'dob' => ['required'],
                          ],
                          [
                              'full_name.required' => 'Full Name Required',
                              'first_name.required' => 'First Name Required',
                              'last_name.required' => 'Last Name Required',
                              'dob.required' => 'Date of Birth Required',
                          ]
                      );

                      // Set Model
                      $model['employee']['profile'] = new EmployeeProfile();

                      // Check Exist
                      $data['main'] = $model['employee']['profile']::find(Auth::id());

                      // If Query Not found
                      if (!$data['main']) {
                          // Return Failed
                          return back()->with('alert_type', 'error')
                                       ->with('message', 'Data Not Exist');
                      }

                      $data['main']->full_name = $request->full_name;
                      $data['main']->first_name = $request->first_name;
                      $data['main']->middle_name = $request->middle_name;
                      $data['main']->last_name = $request->last_name;
                      $data['main']->nickname = $request->nickname;
                      $data['main']->dob = $request->dob;
                      $data['main']->save();

                      $salutation = explode(',', $request->salutation_id);

                      if (count($salutation) >= 1) {
                          // Set Model
                          $model['employee']['salutation'] = new EmployeeSalutation();

                          // Delete Data
                          $model['employee']['salutation']::where('employee_id', Auth::id())
                                                          ->delete();

                          foreach ($salutation as $key => $value) {
                              // Set Model
                              $model['employee']['salutation'] = new EmployeeSalutation();

                              // Set Data
                              $model['employee']['salutation']->employee_id = Auth::id();
                              $model['employee']['salutation']->salutation_id = $value;
                              $model['employee']['salutation']->ordering = $key;
                              $model['employee']['salutation']->created_by = Auth::id();
                              $model['employee']['salutation']->created_at = Carbon::now();
                              $model['employee']['salutation']->save();
                          }
                      }
                      break;

                  // Profile
                  case 'profile':

                  //Set Model
                  $model['researcher']['main'] = new ResearcherProcedure();

                  //Create Main
                  $result['researcher']['main'] = $model['researcher']['main']->updateRecord(
                    [
                      'column'=>[
                        'employee_id'=>Auth::id(),
                        'description'=>($request->has('description')?$request->description:null),
                        'need_verification'=>1,
                        'remark'=>($request->has('remark')?$request->remark:null),
                        'remark_user'=>($request->has('remark_user')?$request->remark_user:null),
                        'updated_by'=>Auth::id()
                      ]
                    ]
                  );

                  //Set Model
                  $model['researcher']['scopus'] = new ResearcherScopusProcedure();

                  if($request->has('researcher_scopus_id') && $request->researcher_scopus_id != null){

                    //Create Main
                    $result['researcher']['scopus'] = $model['researcher']['scopus']->updateRecord(
                      [
                        'column'=>[
                          'researcher_scopus_id'=>($request->has('researcher_scopus_id')?$request->researcher_scopus_id:null),
                          'employee_id'=>Auth::id(),
                          'scopus_id'=>($request->has('scopus_id')?$request->scopus_id:null),
                          'hyperlink'=>($request->has('hyperlink')?$request->hyperlink:null),
                          'need_verification'=>1,
                          'remark'=>($request->has('remark')?$request->remark:null),
                          'remark_user'=>($request->has('remark_user')?$request->remark_user:null),
                          'updated_by'=>Auth::id()
                        ]
                      ]
                    );


                  }else{

                    //Create Main
                    $result['researcher']['scopus'] = $model['researcher']['scopus']->createRecord(
                      [
                        'column'=>[
                          'employee_id'=>Auth::id(),
                          'scopus_id'=>($request->has('scopus_id')?$request->scopus_id:null),
                          'hyperlink'=>($request->has('hyperlink')?$request->hyperlink:null),
                          'need_verification'=>1,
                          'remark'=>($request->has('remark')?$request->remark:null),
                          'remark_user'=>($request->has('remark_user')?$request->remark_user:null),
                          'created_by'=>Auth::id()
                        ]
                      ]
                    );

                  }


                  // Get Validate Data
                  break;

                  // Contact
                  case 'contact':
                      // Check Request Validation
                      $validate = $request->validate(
                          [
                              'name' => ['required'],
                          ],
                          [
                              'name.required' => 'Contact Required'
                          ]
                      );

                      // Check Contact Category ID Exist
                      if ($request->has('contact_category_id') && $request->has('name')) {
                          // Get Loop Data Contact Category ID
                          foreach ($request->contact_category_id as $key => $value) {
                              if (!empty($request->name[$key])) {
                                  // Set Model
                                  $model['employee']['contact'] = new EmployeeContact();

                                  $model['employee']['contact']::upsert([
                                      [
                                          'contact_category_id' => $value,
                                          'employee_id' => Auth::id(),
                                          'name' => $request->name[$key]
                                      ],
                                  ],
                                  uniqueBy: ['employee_id', 'contact_category_id'],
                                  update: [
                                      'contact_category_id',
                                      'employee_id',
                                      'name'
                                  ]);
                              }
                          }
                      }
                      break;

                  // Setting
                  case 'setting':
                      // Get Tab Sub Category
                      switch ($request->tab_sub_category) {
                          // Virtual Card
                          case 'virtual_card':
                              // Merge Array Into String
                              $company_id = implode(',', $request->company_id);

                              // Set Model
                              $model['employee']['virtual_card'] = new EmployeeVirtualCard();

                              // Check Exist
                              $check['exist'] = $model['employee']['virtual_card']->checkExist(
                                  [
                                      'column' => [
                                          'id' => Auth::id()
                                      ]
                                  ]
                              );

                              // IF Not Exist
                              if ($check['exist']) {
                                  // Check Exist
                                  $data['main'] = $model['employee']['virtual_card']::find(Auth::id());
                                  $data['main']->logo_header = $company_id;
                                  $data['main']->created_by = Auth::id();
                                  $data['main']->created_at = Carbon::now();
                                  $data['main']->save();
                              } else {
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
              break;
      }

      // Return to Selected Tab Category Route
      return redirect()->route($hyperlink['page']['view'], ['tab' => 'tab', 'tab_category' => $request->tab_category])
                       ->with('alert_type','success')
                       ->with('message', ucwords($request->tab_category) . ' Updated');
  }


  /**************************************************************************************
    Validate Data
  **************************************************************************************/
  public function getValidateData(Request $request){

    //Check Has Publication Type
    if($request->has('tab_category')){

      //Get Publication Type
      switch($request->tab_category){

        //Article
        case 'profile':

          //Define Validation Rules
          $rules = [
            'description'=>['required'],
            'scopus_id'=>['required'],
            'hyperlink'=>['required'],
          ];

          //Custom Validation Messages
          $messages = [
            'description.required'=>'Description is required',
            'scopus_id.required'=>'Scopus ID required',
            'hyperlink.required'=>'Hyperlink Required',
          ];

        break;

        //Article
        case 'avatar':

        // Avatar
        $rules = [
            'avatar' => ['required', 'image:png', 'mimetypes:image/png', 'max:1024'], // Validate avatar
        ];

        // Custom Validation Messages
        $messages = [
            'avatar.required' => 'Avatar Required',
            'avatar.image' => 'File Must Be Image',
            'avatar.mimetypes' => 'Avatar Must Be PNG',
            'avatar.max' => 'Avatar Maximum Size is 1MB',
        ];

        // Check Request Validation
        $validate = $request->validate($rules, $messages);


        break;


      }

      //Create A Validator Instance
      $validator = Validator::make($request->all(), $rules, $messages);

      //Run The Validation
      $validator->validate();

    }

  }

}
