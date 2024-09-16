<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Configuration\Route;

//Controller Helper
use App\Http\Controllers\Controller;

//Get Route
Use Route;

//Get Request
use Illuminate\Http\Request;

//Get Class
class ListController extends Controller{

	//Path Header
	protected $header = [
		'category'=>'configuration',
		'module'=>'route',
		'sub'=>'',
		'gate'=>''
	];

	//View Path
	protected $view;

	//Hyperlink
  public $hyperlink;

	/**************************************************************************************
		Route Path
	**************************************************************************************/
	public function routePath(){

		//Set View
		$this->view = config('routing.application.modules.configuration.view').'.route.';

	}

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){
		// dd(session()->all());
// dd(32);
		//Get Route Path
    $this->routePath();

		//Set Hyperlink
    $hyperlink = $this->hyperlink;

		//Get Route
	  $data['main'] = (array) Route::getRoutes()->getRoutes();

		// dd($routes);


		return view($this->view.'list.index',compact('data','hyperlink'));

  }

}
