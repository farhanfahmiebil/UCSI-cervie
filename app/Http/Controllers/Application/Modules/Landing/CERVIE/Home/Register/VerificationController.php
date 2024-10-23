<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Landing\Outlet\Table\Register;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_Hotel_POS\MSSQL\Table\POS_FNBOutlet;
use App\Models\UCSI_Hotel_POS\MSSQL\Table\TableApps_OrderHeader AS TableOrderHeader;
use App\Models\UCSI_Hotel_POS\MSSQL\StoredProcedure\Order;

//Get Request
use Illuminate\Http\Request;

//Get Class
class VerificationController extends Controller{

	//Application
  protected $application = 'application';

  //Module
  protected $module = [
    'main'=>'outlet',
    'sub'=>'table',
    'page'=>'register'
  ];

	//Path Header
	protected $header = [
		'category'=>'Landing',
		'module'=>'Outlet',
		'sub'=>'Table',
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
    $this->route['view'] = config('routing.'.$this->application.'.modules.landing.view').'.'.$this->module['main'].'.'.$this->module['sub'].'.'.$this->module['page'];

    //Set Route Name
    $this->route['name'] = config('routing.'.$this->application.'.modules.landing.name').'.'.$this->module['main'].'.'.$this->module['sub'].'.'.$this->module['page'];

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
    $this->hyperlink['page']['process'] = $this->route['name'].'.verification.process';
    $this->hyperlink['page']['register'] = $this->route['name'];
    $this->hyperlink['page']['exist'] = $this->route['name'].'.exist';
    $this->hyperlink['page']['verification'] = $this->route['name'].'.verification';
    $this->hyperlink['page']['menu'] = config('routing.'.$this->application.'.modules.landing.name').'.'.$this->module['main'].'.'.$this->module['sub'].'.menu';

	}

  /**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Breadcrumb
		$data['title'] = array('Table No '.$request->table_no.' Has Been Taken. Please Verify.');

    //Set Model
    $model['outlet']['main'] = new POS_FNBOutlet();
    $model['table']['order']['header'] = new TableOrderHeader();

    //Get Outlet
    $data['outlet']['store'] = $model['outlet']['main']->viewSelected(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id
        ]
      ]
    );

    //Check Exist
    $check['exist']['customer'] = $model['table']['order']['header']->checkExist(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'mobile_number'=>$request->mobile_number,
          'status'=>'Created',
          'date'=>'now'
        ]
      ]
    );
// dd($check['exist']['customer']);
    if(!$check['exist']['customer']){

      //Redirect to Order Menu
      return redirect()->route($hyperlink['page']['register'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no]);

    }

// dd(  $check['exist']['customer'] );
    //Return View
    return view($this->route['view'].'.verification',compact('data','hyperlink'));

  }

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function process(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;
    // dd($request->outlet_id);

    //Set Model
    $model['table']['order']['header'] = new TableOrderHeader();

    //Check Exist
    $check['exist']['customer'] = $model['table']['order']['header']->checkExist(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'mobile_number'=>$request->mobile_number,
          'status'=>'Created',
          'date'=>'now',
        ]
      ]
    );

    if(!$check['exist']['customer']){

      return redirect()->back()->withErrors(
        [
          'alert_category' => 'error',
          'message' => 'Mobile Number Not Match With The Table Registered.'
        ]
      );

    }

    //Check Exist
    $data['customer'] = $model['table']['order']['header']->viewSelected(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'mobile_number'=>$request->mobile_number,
          'status'=>'Created',
          'date'=>'now',
        ]
      ]
    );




    return redirect()->route($hyperlink['page']['menu'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no,'order_id'=>$data['customer']->order_id]);

  }

  /**************************************************************************************
 		Exist
 	**************************************************************************************/
	public function exist(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Model
    $model['outlet']['main'] = new POS_FNBOutlet();
    $model['table']['order']['header'] = new TableOrderHeader();


    $data['outlet']['store'] = $model['outlet']['main']->viewSelected(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id
        ]
      ]
    );

    //Check Exist
    $data['customer'] = $model['table']['order']['header']->getListSelected(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'mobile_number'=>$request->session()->get('customer.mobile_number'),
          'status'=>'Created',
          'date'=>'now'
        ]
      ]
    );

    //Return View
    return view($this->route['view'].'.exist',compact('data','hyperlink'));

  }

}
