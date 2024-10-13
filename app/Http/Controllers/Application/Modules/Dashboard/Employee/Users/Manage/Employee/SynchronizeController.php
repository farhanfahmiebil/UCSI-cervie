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

//Get LDAP
use LdapRecord\Container;
use LdapRecord\Query\Builder;

//Model
use App\Models\UCSI_V2_Main\MSSQL\StoredProcedure\EmployeeLDAP;
use App\Models\UCSI_V2_Main\MSSQL\StoredProcedure\Employee;
use App\Models\UCSI_V2_Main\MSSQL\StoredProcedure\EmployeeProfile;
use App\Models\UCSI_V2_Main\MSSQL\StoredProcedure\EmployeePosition;
use App\Models\UCSI_V2_Main\MSSQL\StoredProcedure\EmployeeContact;

//Get Request
use Illuminate\Http\Request;

//Get Class
class SynchronizeController extends Controller{

	//Application
  protected $application = 'application';

  //Application
  protected $page = 'users';

  //User
  protected $user = 'employee';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'Manage User',
		'sub'=>'Employee',
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

    $this->hyperlink['page']['list'] = $this->route['name'].'.list';
    $this->hyperlink['page']['synchronize']['view'] = $this->route['name'].'.synchronize.view';
    $this->hyperlink['page']['synchronize']['search'] = $this->route['name'].'.synchronize.search';
    $this->hyperlink['page']['synchronize']['process'] = $this->route['name'].'.synchronize.process';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

	}

  /**************************************************************************************
    View
  **************************************************************************************/
  public function view(Request $request){

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Set Breadcrumb
    $data['breadcrumb']['icon'] = '<i class=\'bi bi-person\'></i>';
    $data['breadcrumb']['title'] = array($this->header['category'],$this->header['module'],$this->header['sub'],'Synchronize');

    //Get Form Token
		$form_token = $this->encrypt_token_form;

    //Return View
    return view($this->route['view'].'.synchronize.view.index',compact('data','form_token','hyperlink'));

  }

  /**************************************************************************************
 		Search
 	**************************************************************************************/
	public function search(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //If Type Exist
		if($request->has('form_token')){

      //Set Category
      $category = null;
			//Check Type Request
			switch($this->encrypter->decrypt($request->form_token)){

				//Search
				case 'search':

          //Check Request Validation
          $validate = $request->validate(
            //Check Validation
            [
              'synchronize_category'=>'required',
              'name'=>'required',
            ],
            //Error Message
            [
              'synchronize_category.required'=>'Synchronize Category Required',
              'name.required'=>'#synchronize_category is Required'
            ]
          );

          //Get Synchronize Category
          switch($request->synchronize_category){

            case 'employee_id':

              $category = 'samaccountname';
              $this->header['page'] = 'Employee ID';

            break;

            case 'employee_name':

              $category = 'cn';
              $this->header['page'] = 'Employee Name';

            break;

            default:
              // code...
            break;
          }

          //Set Breadcrumb
          $data['breadcrumb']['icon'] = '<i class=\'bi bi-person\'></i>';
          $data['breadcrumb']['title'] = array($this->header['category'],$this->header['module'],$this->header['sub'],'Synchronize','Search',$this->header['page'],$request->name);

          //Get LDAP Data
          $data['search'] = $request->name;
          $data['column'] = $this->getLDAPDataColumn();

          $data['raw'] = $this->getLDAPDataRaw(
            [
              'column'=>$data['column'],
              'search'=>$data['search'],
              'category'=>$category
            ]
          );
// dd(  $data['raw']);
          $data['main'] = $this->getLDAPData(
            [
              'column'=>$data['column'],
              'raw'=>$data['raw']
            ]
          );

          $data['main']['synchronize'] = $this->getLDAPDataSynchronizeStatus(
            [
              'main'=>$data['main']
            ]
          );
// dd($data['raw']);
          //Get Form Token
      		$form_token = $this->encrypt_token_form;

          //Return View
          return view($this->route['view'].'.synchronize.search.index',compact('data','form_token','hyperlink'));

				break;

				//If Request Type Not Found
				default:

					// //Return Failed
					// return redirect($request->url)->with('alert_type','error')
					// 															->with('message','Execute Failed');

				break;

			}

		}

  }

	/**************************************************************************************
 		Process
 	**************************************************************************************/
	public function process(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //If Type Exist
		if($request->has('form_token')){

      //Set Category
      $category = null;

			//Check Type Request
			switch($this->encrypter->decrypt($request->form_token)){

				//Synchronize
				case 'synchronize':

          //Get Synchronize Category
          switch($request->synchronize_category){

            case 'employee_id':

              $category = 'samaccountname';
              $this->header['page'] = 'Employee ID';

            break;

            case 'employee_name':

              $category = 'cn';
              $this->header['page'] = 'Employee Name';

            break;

            default:
              // code...
            break;
          }

          //Set Breadcrumb
          $data['breadcrumb']['icon'] = '<i class=\'bi bi-person\'></i>';
          $data['breadcrumb']['title'] = array($this->header['category'],$this->header['module'],$this->header['sub'],'Synchronize','Search',$this->header['page'],$request->name);

          //Get LDAP Data
          $data['search'] = $request->name;
          $data['column'] = $this->getLDAPDataColumn();

          $data['raw'] = $this->getLDAPDataRaw(
            [
              'column'=>$data['column'],
              'search'=>$data['search'],
              'category'=>$category
            ]
          );

          $data['main'] = $this->getLDAPData(
            [
              'column'=>$data['column'],
              'raw'=>$data['raw']
            ]
          );

          // dd($data['main']);

          /*  Employee LDAP
          **************************************************************************************/

          //Set Employee LDAP
          $model['employee']['ldap'] = new EmployeeLDAP();

          //Check Exist
          $check['exist'] = $model['employee']['ldap']->checkExist(
            [
              'column'=>[
                'employee_id'=>$data['main']['samaccountname']
              ]
            ]
          );
// dd(  $check['exist']);
          // dd($data['raw']->getConvertedGuid());

          // Ensure the GUID is in binary format
   // $binaryGuid = hex2bin(str_replace('-', '', $data['main']['objectguid']));

   // Convert binary GUID to hexadecimal string

   // dd($formattedGuid);
// dd($data['main']['objectguid']);
          //If Not Exist
          if(!$check['exist']){

            //Create Employee LDAP
            $result = $model['employee']['ldap']->create(
              [
                'column'=>[
                  'cn'=>$data['main']['cn'],
                  'sn'=>$data['main']['sn'],
                  'givenname'=>$data['main']['givenname'],
                  'displayname'=>$data['main']['displayname'],
                  'distinguishedname'=>$data['main']['distinguishedname'],
                  'name'=>$data['main']['name'],
                  'department'=>$data['main']['department'],
                  'title'=>$data['main']['title'],
                  'samaccountname'=>$data['main']['samaccountname'],
                  'mail'=>$data['main']['mail'],
                  'employee_id'=>$data['main']['samaccountname'],
                  'username'=>$data['main']['samaccountname'],
                  'userprincipalname'=>$data['main']['userprincipalname'],
                  'created_by'=>Auth::id()
                ]
              ]
            );

          }

          /*  Employee
          **************************************************************************************/

          //Set Employee
          $model['employee']['main'] = new Employee();

          //Check Exist
          $check['exist'] = $model['employee']['main']->checkExist(
            [
              'column'=>[
                'employee_id'=>$data['main']['samaccountname']
              ]
            ]
          );

          //If Not Exist
          if(!$check['exist']){

            //Create Employee
            $result = $model['employee']['main']->create(
              [
                'column'=>[
                  'email'=>$data['main']['mail'],
                  'username'=>$data['main']['samaccountname'],
                  'employee_id'=>$data['main']['samaccountname'],
                  'status_id'=>1,
                  'created_by'=>Auth::id(),
                ]
              ]
            );

          }

          /*  Employee Profile
         	**************************************************************************************/

          //Set Employee Profile
          $model['employee']['profile'] = new EmployeeProfile();

          //Check Exist
          $check['exist'] = $model['employee']['profile']->checkExist(
            [
              'column'=>[
                'employee_id'=>$data['main']['samaccountname']
              ]
            ]
          );

          //If Not Exist
          if(!$check['exist']){

            //Create Employee
            $result = $model['employee']['profile']->create(
              [
                'column'=>[
                  'employee_id'=>$data['main']['samaccountname'],
                  'first_name'=>$data['main']['cn'],
                  'last_name'=>$data['main']['givenname'],
                  'full_name'=>$data['main']['name'],
                  'created_by'=>Auth::id(),
                ]
              ]
            );

          }

          /*  Employee Position
         	**************************************************************************************/

          //Get Model
          $model['employee']['position'] = new EmployeePosition();

          //Check Exist
          $check['exist'] = $model['employee']['position']->checkExist(
            [
              'column'=>[
                'employee_id'=>$data['main']['samaccountname']
              ]
            ]
          );

        // dd($check['exist']);  //If Not Exist
          if(!$check['exist']){

            //Check If Semicolons
            //Remove spaces after semicolons
            $position = str_replace(' ;', ';',$data['main']['title']);

            // Explode the string based on semicolons or add the whole string if there's no semicolon
            $item['position']['raw'] = strpos($position,';')!==false?explode(';',$data['main']['title']):[$data['main']['title']];

            // Trim spaces from each piece
            $item['position']['main'] = array_map('trim',$item['position']['raw']);

            //Get Item Position Main
            foreach($item['position']['main'] as $key=>$value){

              //Get Model
              $model['employee']['position'] = new EmployeePosition();

              //Create Employee Position
              $result = $model['employee']['position']->create(
                [
                  'column'=>[
                    'employee_id'=>$data['main']['samaccountname'],
                    'position'=>$value,
                    'department'=>$data['main']['department'],
                    'created_by'=>Auth::id(),
                    'ordering'=>($key+1),
                  ]
                ]
              );

            }

          }

          /*  Employee Contact Email Internal
         	**************************************************************************************/

          //Get Model
          $model['employee']['contact']['email']['internal'] = new EmployeeContact();

          //Check Exist
          $check['exist'] = $model['employee']['contact']['email']['internal']->checkExist(
            [
              'column'=>[
                'employee_id'=>$data['main']['samaccountname'],
                'contact_category_id'=>12,
              ]
            ]
          );
// dd($check['exist'],[
//   'column'=>[
//     'employee_id'=>$data['main']['samaccountname'],
//     'contact_category_id'=>12,
//   ]
// ] );
          //If Not Exist Update
          if(!$check['exist']){

            //Check User Principal Name
            if(isset($data['main']['userprincipalname'])){

              //Create Employee Position
              $result = $model['employee']['contact']['email']['internal']->create(
                [
                  'column'=>[
                    'employee_id'=>$data['main']['samaccountname'],
                    'name'=>$data['main']['userprincipalname'],
                    'contact_category_id'=>12,
                    'created_by'=>Auth::id()
                  ]
                ]
              );

            }

          }

          /*  Employee Contact Email External
         	**************************************************************************************/

          //Get Model
          $model['employee']['contact']['email']['external'] = new EmployeeContact();

          //Check Exist
          $check['exist'] = $model['employee']['contact']['email']['external']->checkExist(
            [
              'column'=>[
                'employee_id'=>$data['main']['samaccountname'],
                'contact_category_id'=>13,
              ]
            ]
          );
// dd( $data['main']['userprincipalname'], $data['main']['mail']);
          //If Not Exist
          if(!$check['exist']){

            //Check Mail
            if(isset($data['main']['mail'])){

              //Create Employee Position
              $result = $model['employee']['contact']['email']['external']->create(
                [
                  'column'=>[
                    'employee_id'=>$data['main']['samaccountname'],
                    'name'=>$data['main']['userprincipalname'],
                    'contact_category_id'=>13,
                    'created_by'=>Auth::id()
                  ]
                ]
              );

            }

          }
// dd(32);
          //Set Synchronize Status
          $data['main']['synchronize'] = $this->getLDAPDataSynchronizeStatus(
            [
              'main'=>$data['main']
            ]
          );

          //Return View
          return view($this->route['view'].'.synchronize.process.index',compact('data','hyperlink'));

				break;

				//If Request Type Not Found
				default:

					//Return Failed
					return redirect($request->url)->with('alert_type','error')
																				->with('message','Execute Failed');

				break;

			}

		}

  }

  /**************************************************************************************
 		Get LDAP Data Column
 	**************************************************************************************/
	public function getLDAPDataColumn(){

    //Set Column
    $data = [
      'mail',
      'cn',
      'sn',
      'givenname',
      'displayname',
      'distinguishedname',
      'name',
      'samaccountname',
      'userprincipalname',
      'department',
      'title',
      'synchronize',
    ];

    //Return Data
    return $data;

  }

  /**************************************************************************************
    Get LDAP Data Raw
  **************************************************************************************/
  public function getLDAPDataRaw($data){

    //Get Container LDAP
    $ldap = Container::getConnection('default');

    //Create an LDAP query builder instance
    $query = $ldap->query();

    //Set Condition
    $condition = (($data['category'] == 'samaccountname')?'=':'starts_with');

    // Perform an LDAP search
    $result = $query->select($data['column'])
                    ->where($data['category'],$condition,$data['search'])
                    ->first();

    //Return Data
    return $result;

  }

  /**************************************************************************************
    Get LDAP Data
  **************************************************************************************/
  public function getLDAPData($data){

    //Set Status
    $status = [];

    //Get Loop
    foreach($data['column'] as $value){

      //Set Status Column
      $status['column'] = false;

      // Iterate through each attribute and retrieve its value
      foreach($data['raw'] as $k=>$v){

        // Skip non-attribute keys such as 'count' and 'dn'
        if(is_numeric($k) || $k === 'count' || $k === 'dn'){
          continue;
        }

        //If Column Match With Raw Data
        if($value == $k){

          $status['column'] = true;

          // Output each value of the attribute
          foreach($v as $w){

            //Set Attribute
            $result[$k] = $w;

          }

        }

      }

      //If Status Column False
      if(!$status['column']){

        //Set Attribute
        $result[$value] = null;

      }

    }

    //Return Data
    return $result;

  }

  /**************************************************************************************
    Get LDAP Data Status
  **************************************************************************************/
  public function getLDAPDataSynchronizeStatus($data){

    //Set Model
    $model['employee']['ldap'] = new EmployeeLDAP();

    //Get Data
    $check['exist'] = $model['employee']['ldap']->checkExist(
      [
        'column'=>[
          'employee_id'=>$data['main']['samaccountname']
        ]
      ]
    );

    //Set Synchronize Status
    $result = $check['exist'];

    //Return Data
    return $result;

  }

}
