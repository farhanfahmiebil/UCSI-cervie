<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Configuration\Ajax;

//Controller Helper
use App\Http\Controllers\Controller;

//Get Artisan
Use Artisan;

//Get Request
use Illuminate\Http\Request;

//Get Class
class ConfigurationController extends Controller{

	/**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){
// dd($request);
		//Check Value
		if($request->has('value')){

			//Get Value
			switch($request->value){

				//Config Cache
				case 'config_cache':

					//Route Cache
					Artisan::call('config:cache');

					//Set Message
					$data['message'] = 'Configuration Cached Successfully.';

					//Return Data
			    return response()->json($data['message'],200);

				break;

				//Config Clear
				case 'config_clear':

					//Route Cache
					Artisan::call('config:clear');

					//Set Message
					$data['message'] = 'Configuration Cache Clear Successfully.';

					//Return Data
			    return response()->json($data['message'],200);

				break;

				//Route Cache
				case 'route_cache':

					//Route Cache
					Artisan::call('route:cache');

					//Set Message
					$data['message'] = 'Route Cache Cleared and Cached Successfully.';

					//Return Data
			    return response()->json($data['message'],200);

				break;

				//Route Clear
				case 'route_clear':

					//Route Cache
					Artisan::call('route:clear');

					//Set Message
					$data['message'] = 'Route Cache Cleared Successfully.';

					//Return Data
			    return response()->json($data['message'],200);

				break;

				//Optimize
				case 'optimize':

					//Route Cache
					Artisan::call('optimize');
					Artisan::call('config:clear');

					//Set Message
					$data['message'] = 'Caching the Framework Bootstrap Files Successfully.';

					//Return Data
			    return response()->json($data['message'],200);

				break;

				default:
					// code...
				break;

			}

		}

  }

}
