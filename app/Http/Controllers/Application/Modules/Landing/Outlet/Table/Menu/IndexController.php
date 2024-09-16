<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Landing\Outlet\Table\Menu;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_Hotel_POS\MSSQL\Table\POS_FNBOutlet;
use App\Models\UCSI_Hotel_POS\MSSQL\Table\TableApps_OrderHeader AS TableOrderHeader;
use App\Models\UCSI_Hotel_POS\MSSQL\StoredProcedure\Menu;

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
    'page'=>'menu',
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
    $this->hyperlink['page']['index'] = $this->route['view'].'index';

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
		$data['title'] = array('Table Information');

    //Set Model
    $model['table']['order']['header'] = new TableOrderHeader();

    $check['exist']['customer'] = $model['table']['order']['header']->checkExist(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id,
          'table_no'=>$request->table_no,
          'order_id'=>$request->order_id,
          // 'status'=>'Created',
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

// dd($data['customer']);
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
    $model['outlet']['menu'] = new Menu();
    $data['outlet']['menu']['category']['main'] = $model['outlet']['menu']->category(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id
        ]
      ]
    );

    $data['outlet']['menu']['category']['sub'] = $model['outlet']['menu']->categorysub(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id
        ]
      ]
    );

    $data['outlet']['menu']['item'] = $model['outlet']['menu']->menuItem(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id
        ]
      ]
    );

    //Return View
    return view($this->route['view'].'.index',compact('data','hyperlink'));

  }

}
