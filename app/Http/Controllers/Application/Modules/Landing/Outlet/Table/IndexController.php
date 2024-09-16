<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Landing\Outlet\Table;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_HOTEL\MSSQL\Table\POS_FNBOutlet;
use App\Models\UCSI_HOTEL\MSSQL\StoredProcedure\Menu;

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
		$data['title'] = array($this->header['category']);

    //Set Model
    $model['outlet']['main'] = new POS_FNBOutlet();
    $model['outlet']['menu'] = new Menu();

    //Get Data
    $check['exist']['outlet'] = $model['outlet']['main']->checkExist(
      [
        'column'=>[
          'id'=>$request->outlet_id
        ]
      ]
    );
// abort(555,'error');
    //Check Outlet Exist
    if(!$check['exist']['outlet']){

      //Abort
      abort(404);

    }

    $data['outlet']['store'] = $model['outlet']['main']->viewSelected(
      [
        'column'=>[
          'outlet_id'=>$request->outlet_id
        ]
      ]
    );

    // dd($data['outlet']);

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

// dd($data['outlet']['menu']['item']);
    //Return View
    return view($this->route['view'].'.index',compact('data','hyperlink'));
    return view($this->route['view'].'.index-tem',compact('data','hyperlink'));
    return view($this->route['view'].'.index_list',compact('data','hyperlink'));
    // dd($check['exist']['outlet']);

  }

}
