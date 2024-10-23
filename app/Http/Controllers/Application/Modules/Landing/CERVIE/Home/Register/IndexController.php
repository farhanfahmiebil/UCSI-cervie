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
class IndexController extends Controller{

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
    $this->hyperlink['page']['process'] = $this->route['name'].'.process';
    $this->hyperlink['page']['exist'] = $this->route['name'].'.exist';
    $this->hyperlink['page']['verification'] = $this->route['name'].'.verification';
    $this->hyperlink['page']['menu'] = config('routing.'.$this->application.'.modules.landing.name').'.'.$this->module['main'].'.'.$this->module['sub'].'.menu';

	}

  /**************************************************************************************
 		Register
 	**************************************************************************************/
	public function register(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

		//Set Breadcrumb
		$data['title'] = array('Register Your Table No '.$request->table_no);

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

    if($check['exist']['customer']){

      //Redirect to Order Menu
      return redirect()->route($hyperlink['page']['verification'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no]);

    }

// dd(  $check['exist']['customer'] );
    //Return View
    return view($this->route['view'].'.index',compact('data','hyperlink'));

  }

	/**************************************************************************************
 		Process
 	**************************************************************************************/
	public function process(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;
    // dd($request->outlet_id);

    //Set Model
    $model['outlet']['main'] = new POS_FNBOutlet();
    $model['table']['order']['header'] = new TableOrderHeader();

    //Check Exist
    $check['exist']['customer'] = $model['table']['order']['header']->checkExist(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'mobile_number'=>$request->mobile_number,
          'date'=>'now'
        ]
      ]
    );

    $request->session()->put('customer.outlet_id',$request->outlet_id);
    $request->session()->put('customer.table_no',$request->table_no);
    $request->session()->put('customer.name',$request->name);
    $request->session()->put('customer.mobile_number',$request->mobile_number);

    //If Not Exist
    if(!$check['exist']['customer']){

      $model['table']['order']['header'] = new TableOrderHeader();
      $model['table']['order']['header']->customername = $request->name;
      $model['table']['order']['header']->mobileno = $request->mobile_number;
      $model['table']['order']['header']->tableno = $request->table_no;
      $model['table']['order']['header']->numofpax = $request->pax_no;
      $model['table']['order']['header']->statuses = 'Created';
      $model['table']['order']['header']->fnboutletid = $request->outlet_id;
      $model['table']['order']['header']->save();

      //Get Last ID
      $last_id = $model['table']['order']['header']->orderid;
// dd($last_id,['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no,'order_id'=>$last_id]);
      //Redirect to Order Menu
      return redirect()->route($hyperlink['page']['menu'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no,'order_id'=>$last_id]);

    }

    //Check Exist
    $data['customer'] = $model['table']['order']['header']->viewSelected(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'status'=>'Created'
        ]
      ]
    );

    return redirect()->route($hyperlink['page']['exist'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no])->withInput(['mobile_number'=>$request->mobile_number]);

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

  /**************************************************************************************
 		Taken
 	**************************************************************************************/
	public function taken(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Model
    $model['outlet']['main'] = new POS_FNBOutlet();

    $data['outlet']['store'] = $model['outlet']['main']->viewSelected(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id
        ]
      ]
    );

    //Return View
    return view($this->route['view'].'.taken',compact('data','hyperlink'));

  }

}
