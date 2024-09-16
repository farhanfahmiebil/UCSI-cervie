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
class ItemController extends Controller{

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

	}

  function check($data){

    $result = false;

    //Check Category
    switch($data['category']){

      //Customer Order
      case 'customer_order':

        //Set Model
        $model['table']['order']['body'] = new TableOrderBody();

        //Check Exist
        $result = $model['table']['order']['body']->checkExist(
          [
            'column'=>[
              'order_id'=>(isset($data['column']['order_id'])?$data['column']['order_id']:null),
              'order_body_id'=>(isset($data['column']['order_body_id'])?$data['column']['order_body_id']:null),
              'item_id'=>(isset($data['column']['item_id'])?$data['column']['item_id']:null),
            ]
          ]
        );

      break;

      //Customer Order
      case 'menu_item':

        //Get Model
        $model['item']['menu'] = new ItemMenu();

        //Get Data
        $result = $model['item']['menu']->checkExist(
          [
            'column'=>[
              'item_id'=>$data['column']['item_id'],
            ]
          ]
        );

      break;

      default:
        // code...
      break;

    }

    return $result;

  }

  function viewMenuItem($data){

    //Get Model
    $model['item']['menu'] = new ItemMenu();

    //Get Data
    $result = $model['item']['menu']->viewSelected(
      [
        'column'=>[
          'item_id'=>$data['column']['item_id'],
        ]
      ]
    );

    //Return Result
    return $result;

  }

	/**************************************************************************************
 		Cart Item Insert
 	**************************************************************************************/
	public function insert(Request $request){

    $item = [];

    //Check Customer Order
    $check['exist']['customer']['order'] = $this->check(
      [
        'category'=>'customer_order',
        'column'=>[
          'order_id'=>$request->order_id,
          'item_id'=>$request->item_id,
        ]
      ]
    );

    //Check Menu Item
    $check['exist']['menu']['item'] = $this->check(
      [
        'category'=>'menu_item',
        'column'=>[
          'item_id'=>$request->item_id,
        ]
      ]
    );

    //If Menu Item Not Exist
    if(!$check['exist']['menu']['item']){

      //Return Response
      return response()->json(array('result'=>false),200);

    }

    //Check Item Menu
    $data['item']['menu'] = $this->viewMenuItem(
      [
        'column'=>[
          'item_id'=>$request->item_id,
        ]
      ]
    );

    //Set Model
    $model['order'] = new Order();
    $model['table']['order']['body'] = new TableOrderBody();

    //If Not Exist
    if(!$check['exist']['customer']['order']){

      //Seting Up Here
      $item['menu']['order_id'] = $request->order_id;
      $item['menu']['item_id'] = (int)$request->item_id;
      $item['menu']['item_price'] = (float)$data['item']['menu']->item_price;
      $item['menu']['item_quantity'] = (int)$request->quantity;
      $item['menu']['item_discount'] = 0;
      $item['menu']['item_remark'] = null;
      $item['menu']['calculation']['tax'] = (((float)$data['item']['menu']->item_price * $item['menu']['item_quantity']) * ((float)$data['item']['menu']->item_tax / 100));
      $item['menu']['calculation']['total']['sub'] = (float)$data['item']['menu']->item_price * (int)$request->quantity;
      $item['menu']['calculation']['total']['overall'] = (float)($item['menu']['calculation']['total']['sub'] + $item['menu']['calculation']['tax']);

      // dd($item);
      //Get Data
      $data['order'] = $model['order']->addToCart(
        [
          'column'=>[
            'order_id'=>$item['menu']['order_id'],
            'item_id'=>$item['menu']['item_id'],
            'item_price'=>$item['menu']['item_price'],
            'item_quantity'=>$item['menu']['item_quantity'],
            'item_discount'=>0,
            'item_tax'=>$item['menu']['calculation']['tax'],
            'item_total_subtotal'=>$item['menu']['calculation']['total']['sub'],
            'item_total'=>$item['menu']['calculation']['total']['overall'],
            'item_remark'=>$item['menu']['item_remark'],
          ]
        ]
      );

    }else{

      //Check Exist
      $data['customer']['order']['body'] = $model['table']['order']['body']->viewSelected(
        [
          'column'=>[
            'order_id'=>$request->order_id,
            'item_id'=>$request->item_id,
          ]
        ]
      );

      //Seting Up Here
      $item['menu']['order_id'] = $request->order_id;
      $item['menu']['item_quantity'] = (int)$data['customer']['order']['body']->item_quantity + (int)$request->quantity;

      //Get Data
      $data['order'] = $model['order']->updateCartQuantity(
        [
          'column'=>[
            'order_body_id'=>$data['customer']['order']['body']->order_body_id,
            'item_quantity'=>$item['menu']['item_quantity'],
          ]
        ]
      );

    }

    //Return Response
    return response()->json(array('result'=>$data['order']),200);

  }

  /**************************************************************************************
 		Cart Item Update
 	**************************************************************************************/
	public function update(Request $request){

    //Set Model
    $model['table']['order']['body'] = new TableOrderBody();

    //Check Exist
    $check['exist']['customer']['order']['body'] = $this->check(
      [
        'category'=>'customer_order',
        'column'=>[
          'order_body_id'=>$request->order_body_id,
        ]
      ]
    );

    if(!$check['exist']['customer']['order']['body']){

      //Return Response
      return response()->json(array('result'=>false),200);

    }

// dd($request);
    //Input Category
    switch($request->input_category){

      //Quantity
      case 'quantity':

        //Set Model
        $model['order'] = new Order();

        //Get Data
        $data['main'] = $model['order']->updateCartQuantity(
          [
            'column'=>[
              'order_body_id'=>$request->order_body_id,
              'item_quantity'=>$request->quantity,
            ]
          ]
        );

      break;

      //Remark
      case 'remark':
// dd($request);
        //Set Model
        $model['order'] = new Order();

        //Get Data
        $data['main'] = $model['order']->updateCartRemark(
          [
            'column'=>[
              'order_body_id'=>$request->order_body_id,
              'item_remark'=>$request->remark,
            ]
          ]
        );

      break;

      default:
        // code...
      break;

    }

    // dd(32);

    //Return Response
    return response()->json(array('result'=>$data['main']),200);

  }

  /**************************************************************************************
 		Cart Item Delete
 	**************************************************************************************/
	public function delete(Request $request){

    //Set Model
    $model['table']['order']['body'] = new TableOrderBody();

    //Get Model
    $data['main'] = $model['table']['order']['body']::where('orderbodyid',$request->order_body_id)->delete();

    //Return Response
    return response()->json(array('result'=>$data['main']),200);

  }

}
