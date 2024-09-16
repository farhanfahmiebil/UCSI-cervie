<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Configuration\Command\Prompt;

//Controller Helper
use App\Http\Controllers\Controller;

//Get Artisan
Use Artisan;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

	//Path Header
	protected $header = [
		'category'=>'configuration',
		'module'=>'command',
		'sub'=>'prompt',
		'gate'=>''
	];

	//View Path
	protected $route;

	//Hyperlink
  public $hyperlink;

	/**************************************************************************************
		Route Path
	**************************************************************************************/
	public function routePath(){

		//Set View
		$this->route['view'] = config('routing.application.modules.configuration.view').'.command.prompt.';

		//Set Hyperlink
		$this->hyperlink['page']['home'] = config('routing.application.modules.dashboard.employee.name').'.authorization.login';
		$this->hyperlink['page']['route']['list'] = config('routing.application.modules.configuration.name').'.route.list';
		$this->hyperlink['ajax']['configuration'] = config('routing.application.modules.configuration.name').'.ajax.configuration.by.type';
	}

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){

		//Get Route Path
    $this->routePath();

		//Set Hyperlink
    $hyperlink = $this->hyperlink;

		//Return View
		return view($this->route['view'].'index',compact('hyperlink'));

  }

}
