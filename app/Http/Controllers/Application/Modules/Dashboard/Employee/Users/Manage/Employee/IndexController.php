<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Users\Manage\Employee;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model General
// use App\Models\UCSI_V2_General\MSSQL\Table\Company;
use App\Models\UCSI_V2_General\MSSQL\View\ContactCategory;
use App\Models\UCSI_V2_General\MSSQL\View\Salutation;

//Model Main
use App\Models\UCSI_V2_Main\MSSQL\View\Company;
use App\Models\UCSI_V2_Main\MSSQL\View\Status;
use App\Models\UCSI_V2_Main\MSSQL\Table\Employee;
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeLDAP;
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeContact;
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeePosition;
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeProfile;
use App\Models\UCSI_V2_Main\MSSQL\View\EmployeeProfile AS EmployeeProfile1;
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeSalutation;
use App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeVirtualCard;

//Get Request
use Illuminate\Http\Request;

//Get Storage
use Storage;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //Application
  protected $page = 'manage';

  //User
  protected $user = 'employee';

	//Path Header
	protected $header = [
		'application'=>'Dashboard',
    'category'=>'User',
		'module'=>'Manage',
		'module_sub'=>'Employee',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.users.manage.employee';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.users.manage.employee';

		//Set Image Route
		// $this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/home/';

    //Set Navigation
    $this->hyperlink['page']['new'] = $this->route['name'].'.new';
    $this->hyperlink['page']['create'] = $this->route['name'].'.create';
    $this->hyperlink['page']['list'] = $this->route['name'].'.list';
    $this->hyperlink['page']['synchronize']['view'] = $this->route['name'].'.synchronize.view';
    $this->hyperlink['page']['delete'] = $this->route['name'].'.delete';
    $this->hyperlink['page']['view'] = $this->route['name'].'.view';
    $this->hyperlink['page']['update'] = $this->route['name'].'.update';
    $this->hyperlink['page']['download'] = $this->route['name'].'.download';
    $this->hyperlink['page']['virtual']['card'] = config('routing.application.modules.landing.name').'.virtual_card.index';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Set Page Sub
    $this->hyperlink['page']['navigation']['main'] = $this->route['view'].'.view.navigation.main';
    $this->hyperlink['page']['navigation']['setting'] = $this->route['view'].'.view.navigation.setting';
    // $this->hyperlink['page']['sub'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.'.$this->page.'.navigation';

	}

  /**************************************************************************************
    New
  **************************************************************************************/
  public function new(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class=\'bi bi-person\'></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = [
      $this->header['application'],
      $this->header['category'],
      $this->header['module'],
      $this->header['module_sub'],
      'Add',
      'New'
    ];

    //Set Model
    $model['employee']['profile'] = new EmployeeProfile();

    //Return View
    return view($this->route['view'].'.new.index',compact('data','hyperlink'));

  }

  /**************************************************************************************
 		Create
 	**************************************************************************************/
	public function create(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Model
    $model['employee']['contact'] = new EmployeeContact();

    //Check Request Validation
    $validate = $request->validate(
      //Check Validation
      [
        'mobile_no'=>'required',
      ],
      //Error Message
      [
        'mobile_no.required'=>'Contact is Required'
      ]
    );

    //Set Model
    $model['employee']['contact'] = new EmployeeContact();
      //Set Request to Model
    $model['employee']['contact']->employee_id = $request->employee_id;
    $model['employee']['contact']->name = $request->name['office_no_extension'];
    $model['employee']['contact']->contact_category_id = 3;

    //Execute Query
    $model['employee']['contact']->save();

    //Set Model
    $model['employee']['contact'] = new EmployeeContact();

    //Set Request to Model
    $model['employee']['contact']->employee_id = $request->employee_id;
    $model['employee']['contact']->name = $request->name['office_no'];
    $model['employee']['contact']->contact_category_id = 2;

      //Execute Query
    $model['employee']['contact']->save();

    //Set Model
    $model['employee']['contact'] = new EmployeeContact();

    //Set Request to Model
    $model['employee']['contact']->employee_id = $request->employee_id;
    $model['employee']['contact']->name = $request->mobile_no;
    $model['employee']['contact']->contact_category_id = 6;

      //Execute Query
    $model['employee']['contact']->save();


    //Return Success
    return redirect()->route($hyperlink['page']['list'])->with('alert_type','sucess')
			 						     ->with('message','Create Employee Success');

		//Return View
		return view($this->route['view'].'.index',compact('data','hyperlink'));

  }

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function list(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Breadcrumb Icon
		$data['breadcrumb']['icon'] = '<i class=\'bi bi-person\'></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = [
      $this->header['application'],
      $this->header['category'],
      $this->header['module'],
      $this->header['module_sub']
    ];

    //Set Model
    $model['employee']['profile'] = new EmployeeProfile1();
    $model['status']['employee']['main'] = new Status();
    $model['status']['employee']['ldap'] = new Status();

    //Set Data Status
    $data['status']['employee']['ldap'] = $model['status']['employee']['ldap']->selectBox(
      [
        'column'=>[
          'table'=>'employee_ldap'
        ]
      ]
    );

    //Set Data Status
    $data['status']['employee']['main'] = $model['status']['employee']['main']->selectBox(
      [
        'column'=>[
          'table'=>'employee'
        ]
      ]
    );

    //Set Data
    $data['main']['data'] = $model['employee']['profile']->getList(
      [
        'eloquent'=>'pagination',
        // 'pagination'=>['size'=>2]
      ]
    );

    //Defined Column
    $data['main']['column'] = [
      0=>[
        'checkbox'=>'<div class=\'form-check\'><input type=\'checkbox\' id=\'selectAll\' class=\'form-check-input\'></div>',
      ],
      1=>[
        'icon'=>'<i class="bi bi-card-text"></i>',
        'name'=>'Employee ID',
      ],
      2=>[
        'icon'=>'<i class="bi person-badge"></i>',
        'name'=>' Position',
      ],
      3=>[
        'icon'=>'<i class="bi bi-building"></i>',
        'name'=>' Department',
      ],
      4=>[
        'icon'=>'<i class="bi bi-telephone"></i>',
        'name'=>' Contact',
      ],
      5=>[
        'icon'=>'<i class="bi bi-envelope"></i>',
        'name'=>' Email Address',
      ],
      6=>[
        'icon'=>'<i class="bi bi-activity"></i>',
        'name'=>' Status',
      ],
      7=>[
        'icon'=>'<i class="bi bi-wrench-adjustable"></i>',
        'name'=>' Control',
      ]
    ];

    //If Type Exist
		if($request->has('form_token')){
// dd($request->form_token);
// dd($this->encrypter->decrypt($request->form_token));
			//Check Type Request
			switch($this->encrypter->decrypt($request->form_token)){

				//List Type
				case 'filter':
				case 'search':
				case 'sort':

					//Filter Category
					$filter['search'] = ($request->search != null)?$request->search:null;
					$filter['status_employee_ldap_id'] = ($request->employee_ldap_status_id != null)?['status_employee_ldap_id'=>$request->employee_ldap_status_id]:null;
          $filter['status_employee_id'] = ($request->employee_status_id != null)?['status_employee_id'=>$request->employee_status_id]:null;
					$filter['order']['ordercolumn'] = ($request->sorting_column != null)?$request->sorting_column:null;
					$filter['order']['orderby'] = ($request->sorting != null)?$request->sorting:null;

					//Execute Query
					$data['main']['data'] = $model['employee']['profile']->getList(
						[
							'type'=>$this->encrypter->decrypt($request->form_token),
							'column'=>$filter,
              'eloquent'=>'pagination'
						]
					);

				break;

				//If Request Type Not Found
				default:

					//Return Failed
					return redirect($request->url)->with('alert_type','error')
																				->with('message','Execute Failed');

				break;

			}

		}

		//Get Form Token
		$form_token = $this->encrypt_token_form;

		//Return View
		return view($this->route['view'].'.list.index',compact('data','form_token','hyperlink'));

  }

  /**************************************************************************************
 		Delete
 	**************************************************************************************/
	public function delete(Request $request){

    //Check Type Revert
		if($request->has('form_token')){

			//Set Status Tag
			$status_tag = '';
// dd($request);
			//Get Model
			$model['employee']['ldap'] = new EmployeeLDAP();

			//Check Data Been Sent in Array Submission
			for($x = 0; $x < count($request->id); $x++){

				//Check Type Request
				switch($this->encrypter->decrypt($request->form_token)){

					//Delete
					case 'delete':

						//Check Data
						$check['exist'] = $model['employee']['ldap']->checkExist(
							[
								'type'=>'check_status',
								'column'=>[
									'employee_id'=>$request->id[$x]
								]
							]
						);

						//If Exist Delete Permanently
						if($check['exist'] > 0){

							//Get Query
							$data['main'] = $model['employee']['ldap']::destroy($request->id[$x]);

							//If Query Not found
							if(!$data['main']){

								//Return Failed
								return back()->with('alert_type','error')
														 ->with('message','Delete Failed');

							}

							//Set Status Tag
							$status_tag = 'permanently';

						}

						//If Exist Delete Softly
						else{

							//Get Query
							$data['main'] = $model['employee']['ldap']::find($request->id[$x]);

							//If Query Not found
							if(!$data['main']){

								//Return Failed
								return back()->with('alert_type','error')
														 ->with('message','Data Not Exist');

							}

              //Set Model
              $model['status'] = new Status();

              //Get Status
              $data['status'] = $model['status']->getStatusID(
                [
                  'column'=>[
                    'table'=>'employee_ldap',
                    'name'=>'deleted'
                  ]
                ]

              );

							//Set Request to Model
							$data['main']->status_id = $data['status'];
							$data['main']->remark = $request->remark;
							$data['main']->deleted_by = Auth::id();
							$data['main']->deleted_at = Carbon::now();

							//Execute Query
							$data['main']->save();

							//If Query Not found
							if(!$data['main']){

								//Return Failed
								return back()->with('alert_type','error')
														 ->with('message','Delete Failed');

							}

							//Set Status Tag
							$status_tag = 'softly';

						}

					break;

					//Revert
					case 'revert':

						//Get Query
						$data['main'] = $model['employee']['ldap']::find($request->id[$x]);

						//If Query Not found
						if(!$data['main']){

							//Return Failed
							return back()->with('alert_type','error')
													 ->with('message','Data Not Exist');

						}

            //Set Model
            $model['status'] = new Status();

            //Get Status
            $data['status'] = $model['status']->getStatusID(
              [
                'column'=>[
                  'table'=>'employee_ldap',
                  'name'=>'inactive'
                ]
              ]

            );

						//Set Request to Model
						$data['main']->status_id = $data['status'];
						$data['main']->remark = $request->remark;
						$data['main']->updated_by = Auth::id();
						$data['main']->updated_at = Carbon::now();
						$data['main']->deleted_by = null;
						$data['main']->deleted_at = null;

						//Execute Query
						$data['main']->save();

						//If Query Not found
						if(!$data['main']){

							//Return Failed
							return back()->with('alert_type','error')
													 ->with('message','Revert failed');

						}

						//Set Status Tag
						$status_tag = 'revert';

					break;

					//If Status Tag Failed
					default:

						//Return Failed
						return back()->with('alert_type','error')
												 ->with('message','Execute Failed');

					break;

				}

			}

			//Check Status Tag
			switch($status_tag){

				//Permanently
				case 'permanently':

					//Return Success
					return back()->with('alert_type','success')
											 ->with('message','Data Deleted');

				break;

				//Softly
				case 'softly':

					//Return Success
					return back()->with('alert_type','success')
											 ->with('message','Data Softly Deleted');

				break;

				//Revert
				case 'revert':

					//Return Success
					return back()->with('alert_type','success')
											 ->with('message','Data Revert');

				break;

				//If Status Tag Failed
				default:

					//Return Failed
					return back()->with('alert_type','error')
											 ->with('message','Execute Failed');

				break;

			}

		}

		//Return Error
		return back()->with('alert_type','error')
								 ->with('message','Execute Failed');

  }

  /**************************************************************************************
 		View
 	**************************************************************************************/
	public function view(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Check If Not Empty
    if(empty($request->tab_category)){

      //Return to Default Route
      return redirect()->route($hyperlink['page']['view'],['id'=>$request->id,'tab'=>'tab','tab_category'=>'personal']);

    }

    //Check If Tab Category is Setting And Not Empty Tab Sub Category
    if($request->tab_category == 'setting' && empty($request->tab_sub_category)){

      //Return to Default Route
      return redirect()->route($hyperlink['page']['view'],['id'=>$request->id,'tab'=>'tab','tab_category'=>'setting','tab_sub_category'=>'virtual_card']);

    }

    //Set Breadcrumb Icon
		$data['breadcrumb']['icon'] = '<i class=\'bi bi-person\'></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = [
      $this->header['application'],
      $this->header['category'],
      $this->header['module'],
      $this->header['module_sub'],
      'View',
      $request->id
    ];

    //Set Model
    $model['employee']['profile'] = new EmployeeProfile();
    $model['employee']['position'] = new EmployeePosition();

    //Get Data
    $data['employee']['profile'] = $model['employee']['profile']::find($request->id);
    $data['employee']['position'] = $model['employee']['position']::find($request->id);

    //Get Tab Category
    switch($request->tab_category){

      //Avatar
      case 'avatar':

      break;

      //Work
      case 'work':

        //Set Model
        $model['employee']['position'] = new EmployeePosition();
        $data['employee']['position'] = $model['employee']['position']->getListSelected(
          [
            'column'=>[
              'employee_id'=>$request->id
            ]
          ]
        );

      break;

      //Personal
      case 'personal':

        //Set Model
        $model['general']['salutation'] = new Salutation();
        $model['employee']['salutation'] = new EmployeeSalutation();

        //Get Data
        $data['general']['salutation'] = json_encode($model['general']['salutation']->selectBox());
        $data['employee']['salutation'] = $model['employee']['salutation']->getSalutation(
          [
            'column'=>[
              'employee_id'=>$request->id
            ]
          ]
        );

        //Set Salutations
        $salutations = []; // Initialize an empty array to store salutation IDs

        // Iterate over each item in the array
        foreach($data['employee']['salutation'] as $item){
            // Add the salutation ID to the $salutations array
            $salutations[] = $item->salutation_id;
        }

        // Convert the array of salutation IDs into a single string separated by commas
        $data['employee']['salutation_id'] = implode(',', $salutations);

      break;


      //Contact
      case 'contact':

        //Set Model
        $model['contact']['category'] = new ContactCategory();
        $model['employee']['contact'] = new EmployeeContact();

        //Get Office Telephone Number
        $data['employee']['contact']['office']['telephone']['number'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>$request->id,
              'contact_category_id'=>2,
            ]
          ]
        );

        //Get Office Telephone Extension Number
        $data['employee']['contact']['office']['telephone_extension']['number'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>$request->id,
              'contact_category_id'=>3,
            ]
          ]
        );

        //Get Mobile Number
        $data['employee']['contact']['mobile']['phone']['number'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>$request->id,
              'contact_category_id'=>6,
            ]
          ]
        );

        //Get Internal Email Office
        $data['employee']['contact']['email']['office']['internal'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>$request->id,
              'contact_category_id'=>12,
            ]
          ]
        );

        //Get External Email Office
        $data['employee']['contact']['email']['office']['external'] = $model['employee']['contact']->viewSelected(
          [
            'column'=>[
              'employee_id'=>$request->id,
              'contact_category_id'=>13,
            ]
          ]
        );

      break;

      //Status
      case 'status':

        //Set Model
        $model['employee']['ldap'] = new EmployeeLDAP();
        $model['employee']['main'] = new Employee();
        $model['status']['employee']['main'] = new Status();
        $model['status']['employee']['ldap'] = new Status();

        //Set Data Status
        $data['status']['employee']['ldap'] = $model['status']['employee']['ldap']->selectBox(
          [
            'column'=>[
              'table'=>'employee_ldap'
            ]
          ]
        );

        //Set Data Status
        $data['status']['employee']['main'] = $model['status']['employee']['main']->selectBox(
          [
            'column'=>[
              'table'=>'employee'
            ]
          ]
        );

        //Get Data
        $data['employee']['ldap'] = $model['employee']['ldap']::find($request->id);
        $data['employee']['main'] = $model['employee']['main']::find($request->id);

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
// dd(  $data['company']);
            //Set Model
            $model['employee']['virtual_card'] = new EmployeeVirtualCard();

            //Get Data
            $data['employee']['virtual_card'] = $model['employee']['virtual_card']::find($request->id);
// dd(  $data['employee']['virtual_card']);
            // dd($data['employee']['virtual_card']->logo_header);
          break;

        }

      break;

      default:
        // code...


      break;

    }

		//Return View
		return view($this->route['view'].'.view.index',compact('data','hyperlink'));

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

    //Get Tab Category
    switch($request->tab_category){

      //Avatar
      case 'avatar':

        //Check Request Validation
        $validate = $request->validate(

          //Check Validation
          [
            // 'avatar'=>['required','image:png','mimetypes:image/png','max:1024'],
            'avatar'=>['required','image:png','max:1024'],
          ],
          //Error Message
          [
            'avatar.required'=>'Avatar Required',
            'avatar.image'=>'File Must Be Image',
            // 'avatar.mimetypes'=>'Avatar Must Be PNG',
            'avatar.max'=>'Avatar Maximum Size is 1MB'
          ]
        );
// dd($_FILES);



        //Get Extension
        $file['extension'] = $request->avatar->getClientOriginalExtension();

        //Set Path Folder
        $path['folder'] = 'public/resources/employee/'.trim($request->id).'/avatar/';

        //Set File Name
        //$file['name'] = 'index.'.$file['extension'];
        $file['name'] = 'index.png';

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
        $data['main'] = $model['employee']['profile']::find($request->id);

        //If Query Not found
        if(!$data['main']){

          //Return Failed
          return back()->with('alert_type','error')
                       ->with('message','Data Not Exist');

        }

        //Set Query
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
          $model['employee']['salutation']::where('employee_id',$request->id)
                                          ->delete();

          foreach($salutation as $key=>$value){

            //Set Model
            $model['employee']['salutation'] = new EmployeeSalutation();

            //Set Data
            $model['employee']['salutation']->employee_id = $request->id;
            $model['employee']['salutation']->salutation_id = $value;
            $model['employee']['salutation']->ordering = $key;
            $model['employee']['salutation']->created_by = Auth::id();
            $model['employee']['salutation']->created_at = Carbon::now();
            $model['employee']['salutation']->save();

          }

        }
        //Return Success
        // return redirect()->route($hyperlink['page']['view'],['id'=>$request->id,'tab'=>'tab','tab_category'=>$request->tab_category])
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
                  'employee_id' => $request->id,
                  'name' =>$request->name[$key]
                ],
              ],
              uniqueBy: ['employee_id','contact_category_id'],
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

      //Status
      case 'status':

        //Set Model
        $model['employee']['main'] = new Employee();

        //Check Exist
        $data['main'] = $model['employee']['main']::find(trim($request->id));

        //If Query Not found
        if(!$data['main']){

          //Return Failed
          return back()->with('alert_type','error')
                       ->with('message','Data Not Exist');

        }

        //Set Query
        $data['main']->status_id = $request->employee_status_id;
        $data['main']->save();

        //Set Model
        $model['employee']['ldap'] = new EmployeeLDAP();

        //Check Exist
        $data['main'] = $model['employee']['ldap']::find(trim($request->id));

        //If Query Not found
        if(!$data['main']){

          //Return Failed
          return back()->with('alert_type','error')
                       ->with('message','Data Not Exist');

        }

        //Set Query
        $data['main']->status_id = $request->employee_ldap_status_id;
        $data['main']->save();


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
                  'id'=>$request->id
                ]
              ]
            );

            //IF Not Exist
            if($check['exist']){

              //Check Exist
              $data['main'] = $model['employee']['virtual_card']::find(trim($request->id));

              $data['main']->logo_header = $company_id;
              $data['main']->created_by = Auth::id();
              $data['main']->created_at = Carbon::now();
              $data['main']->save();

            }else{

              $model['employee']['virtual_card']->logo_header = $company_id;
              $model['employee']['virtual_card']->employee_id = $request->id;
              $model['employee']['virtual_card']->created_by = Auth::id();
              $model['employee']['virtual_card']->created_at = Carbon::now();
              $model['employee']['virtual_card']->save();

            }

          break;

      }

      break;

    }

    //Redirect
    $redirect = [
      'id'=>$request->id,
      'tab'=>'tab',
      'tab_category'=>$request->tab_category
    ];

    //Check Redirect Tab Sub Category
    if(isset($request->tab_category)){
      $redirect['tab_sub_category'] = $request->tab_sub_category;
    }
// dd($redirect);
    //Return to Selected Tab Category Route
    return redirect()->route($hyperlink['page']['view'],$redirect)
                     ->with('alert_type','success')
                     ->with('message',ucwords($request->tab_category).' for '.ucwords(str_replace('_', ' ',$request->tab_sub_category)).' Updated');

  }


}
