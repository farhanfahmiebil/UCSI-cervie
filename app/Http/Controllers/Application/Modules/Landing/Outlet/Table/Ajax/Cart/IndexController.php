<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Landing\Outlet\Table\Ajax\Cart;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Get Model
use App\Models\UCSI_Hotel_POS\MSSQL\Table\TableApps_OrderBodies AS TableOrderBody;
use App\Models\UCSI_Hotel_POS\MSSQL\Table\TableApps_OrderHeader AS TableOrderHeader;
use App\Models\UCSI_Hotel_POS\MSSQL\Table\POS_Items AS ItemMenu;
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
    'sub'=>'table'
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
    $this->route['view'] = config('routing.'.$this->application.'.modules.landing.view').'.'.$this->module['main'].'.'.$this->module['sub'];

    //Set Route Name
    $this->route['name'] = config('routing.'.$this->application.'.modules.landing.name').'.'.$this->module['main'].'.'.$this->module['sub'];

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

		//Set Hyperlink
    $this->hyperlink['page']['index'] = $this->route['view'].'index';
// dd($this->hyperlink['page']['index']);
	}

  /**************************************************************************************
 		Cart List Total
 	**************************************************************************************/
	public function total(Request $request){

    //Set Model
    $model['table']['order']['header'] = new TableOrderHeader();

    $data['count'] = $model['table']['order']['header']->getCustomerListCartTotal(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'order_id'=>$request->order_id,
        ]
      ]
    );
// dd($data['count'],[
//   'column'=>[
//     'outlet_id'=>$request->outlet_id,
//     'table_no'=>$request->table_no,
//     'order_id'=>$request->order_id,
//   ]
// ]);
    //Return Response
    return response()->json(array('result'=>$data['count']),200);

  }

  /**************************************************************************************
 		Cart List
 	**************************************************************************************/
	public function list(Request $request){

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

    // Convert BLOB data to Base^4 Encode
    foreach($data['main'] as $key =>$value){
      if(!empty($value->item_image)){
        $value->item_image = base64_encode($value->item_image);
      }
    }

// dd($data['main']);
    //Return Response
    return response()->json(array('result'=>$data['main']),200);

  }

}
