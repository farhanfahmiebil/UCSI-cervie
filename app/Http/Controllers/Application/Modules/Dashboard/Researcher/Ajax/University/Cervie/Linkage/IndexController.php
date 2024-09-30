<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Ajax\University\Cervie\Linkage;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Education\MSSQL\Table\CervieResearcherLinkage;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'employee';

	//Path Header
	protected $header = [
		'category'=>'Dashboard',
		'module'=>'University',
		'sub'=>'Ajax',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.ajax.university.admission';

	}

	/**************************************************************************************
 		View
 	**************************************************************************************/
	public function view(Request $request){

    //Get Model
    $model['cervie']['researcher']['linkage']  = new CervieResearcherLinkage();

    //Set Data
    $data['main'] = $model['cervie']['researcher']['linkage'] ->getDataAjax(
      [
        'column'=>[
          'id'=>$request->id,
        ]
      ]
    );

    //Return JSON
    return response()->json(array('result'=>$data['main']),200);

  }


}
