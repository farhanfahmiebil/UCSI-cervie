<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Landing\Outlet\Table\Ajax;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController1 extends Controller{

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

    //Set Ajax
    $this->hyperlink['page']['ajax']['add_to_cart'] = config('routing.application.modules.landing.name').'.ajax.outlet.table.add_to_cart';
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
	public function addToCart(Request $request){


  $item['new'] = [
      'item_id' => (int)$request->item_id,
      'quantity' => (int)$request->quantity
  ];
//
  // $request->session()->forget('customer.teams');
  //   $request->session()->save();
// dd($request->session()->has('customer.cart'));
  if(!$request->session()->has('customer.cart')){
    $request->session()->put('customer.cart',[$item['new']]);
    $request->session()->save();
  }else{

    foreach($request->session()->get('customer.cart') as $key=>$value) {

      // dd($value['item_id'],$item['new']['item_id']);
        if ($value['item_id'] == $item['new']['item_id']) {

            // Update the quantity of the existing item
            $value['quantity'] += $item['new']['quantity'];
    // dd(  $value['quantity']);
            $request->session()->put('customer.cart.'.$key.'.quantity',$value['quantity']);
            $request->session()->save();

            // $found = true;
            break;
        }
        // else{
        //   $request->session()->push('customer.cart.item_id',(int)$request->item_id);
        //   $request->session()->push('customer.cart.quantity',(int)$request->quantity);
        //   $request->session()->save();
        // }

    }

    $request->session()->put('customer.cart',[$item['new']]);

  }

// dd(32);


// $request->session()->put('customer.table_id',$request->table_id);
  // $user['customer'] = $request->session()->get('customer');
//
    // dd(  $user['customer']);

  dd($request->session()->get('customer'));
// dd(  $item['new']);
  // If the item ID does not exist, add it to the customer data
 //  if(!$found) {
 //     $request->session()->push('customer.cart',[$item['new']]);
 //    // $request->session()->put('customer.cart') = $item['new'];
 //  }
 // // dd($request->session()->get('customer'));
 //  dd($user);
  return response()->json(array('result'=>'success'),200);
    //Set Data
    $data['main'] = $model['module']['sub']->getNavigationAccess(
      [
        'column'=>[
          'employee_id'=>Auth::id(),
          'module_id'=>$request->module_id,
        ]
      ]
    );
    // $msg = "This is a simple message.";
    //Return JSON
    return response()->json(array('result'=>$data['main']),200);

  }

}
