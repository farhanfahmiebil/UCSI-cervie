<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Landing\Outlet\Table\Checkout;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_Hotel_POS\MSSQL\Table\POS_FNBOutlet;
use App\Models\UCSI_Hotel_POS\MSSQL\Table\TableApps_OrderHeader AS TableOrderHeader;
use App\Models\UCSI_Hotel_POS\MSSQL\Table\TableApps_OrderBodies AS TableOrderBody;
use App\Models\UCSI_Hotel_POS\MSSQL\StoredProcedure\Order;

//Get Request
use Illuminate\Http\Request;

//Get Storage
use Storage;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //Module
  protected $module = [
    'main'=>'outlet',
    'sub'=>'table',
    'page'=>'checkout',
  ];

	//Path Header
	protected $header = [
		'category'=>'Landing',
		'module'=>'',
		'sub'=>'',
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

    //Set Ajax
    $this->hyperlink['page']['ajax']['cart']['insert'] = config('routing.application.modules.landing.name').'.ajax.outlet.table.cart.item.insert';

		//Set Image Route
		// $this->asset['images'] = '/images/'.$this->application.'/modules/dashboard/'.$this->user.'/pages/home/';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
    $this->hyperlink['page']['process'] = $this->route['view'].'.process';
    $this->hyperlink['page']['submit'] = $this->route['view'].'.submit';
// dd($this->hyperlink['page']['index']);
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
		$data['title'] = array('Checkout Table '.$request->table_no);

    //Set Model
    $model['outlet']['main'] = new POS_FNBOutlet();
    $data['outlet']['store'] = $model['outlet']['main']->viewSelected(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id
        ]
      ]
    );

    //Set Model
    $model['table']['order']['body'] = new TableOrderBody();

    $data['main'] = $model['table']['order']['body']->getCustomerListCart(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'order_id'=>$request->order_id,
        ]
      ]
    );

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

    //Set Model
    $model['table']['order']['body'] = new TableOrderBody();

    $data['main'] = $model['table']['order']['body']->getCustomerListCart(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'order_id'=>$request->order_id,
        ]
      ]
    );

    $total = [
      'sst_6'=>0.00,
      'sst_8'=>0.00,
      'subtotal'=>0.00,
      'total'=>0.00,
    ];

    foreach($data['main'] as $key=>$value){

      $total['subtotal'] += number_format($value->item_total,2);
      $total['total'] += number_format($value->item_total_amount,2);

      if($value->item_is_taxable){

        switch($value->item_tax_rate){

          //6.00
          case '6.00':
            $total['sst_6'] += number_format($value->item_tax,2);
          break;

          //8.00
          case '8.00':
            $total['sst_8'] += number_format($value->item_tax,2);
          break;

        }
      }

    }
// dd([
//   'column'=>[
//     'order_id'=>$request->order_id,
//     'queue_no'=>null,
//     'total'=>$total['subtotal'],
//     'total_tax'=>$total['sst_6']+$total['sst_8'],
//     'total_discount'=>0,
//     'total_amount'=>$total['total'],
//     'status'=>'Submitted'
//   ]
// ]);
    //Set Model
    $model['order']= new Order();

    //Get Data
    $data['order']['header'] = $model['order']->checkoutOrderHeader(
      [
        'column'=>[
          'order_id'=>$request->order_id,
          'queue_no'=>null,
          'total'=>$total['subtotal'],
          'total_tax'=>$total['sst_6']+$total['sst_8'],
          'total_discount'=>0,
          'total_amount'=>$total['total'],
          'status'=>'Submitted'
        ]
      ]
    );

    if(!$data['order']['header']){

      //Redirect to Submit Menu
      return redirect()->route($hyperlink['page']['submit'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no,'order_id'=>$request->order_id])
                       ->with('alert_type','error')
                       ->with('message','Something Wrong, Please Contact Staff Nearby');

    }

    //Redirect to Submit Menu
    return redirect()->route($hyperlink['page']['submit'],['outlet_id'=>$request->outlet_id,'table_no'=>$request->table_no,'order_id'=>$request->order_id])
                     ->with('alert_type','success')
                     ->with('message','Your Order Has Been Submitted to The Kitchen');

  }

  /**************************************************************************************
 		Process
 	**************************************************************************************/
	public function submit(Request $request){

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

    //Set Model
    $model['table']['order']['header'] = new TableOrderHeader();

    $check['exist']['customer'] = $model['table']['order']['header']->checkExist(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'order_id'=>$request->order_id,
          'status'=>'Submitted',
        ]
      ]
    );

    if(!$check['exist']['customer']){

      //Abort
      abort(404);

    }

    $data['customer']['table']['header'] = $model['table']['order']['header']->viewSelected(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'order_id'=>$request->order_id,
        ]
      ]
    );

    //Set Model
    $model['table']['order']['body'] = new TableOrderBody();

    $data['main'] = $model['table']['order']['body']->getCustomerListCart(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'order_id'=>$request->order_id,
        ]
      ]
    );

    //Return View
    return view($this->route['view'].'.submit',compact('data','hyperlink'));

    dd(2);

  }

}
