<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Ajax\General\Company\invoice\Requery;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Get Model
use App\Models\UCSI_V2_Main\MSSQL\View\EInvoiceDocument AS EInvoiceDocumentView;
use App\Models\UCSI_V2_Main\MSSQL\StoredProcedure\EInvoiceDocument AS EInvoiceDocumentStoredProcedure;

//Plugin Einvoice
use App\Http\Plugin\Einvoice\Connection\Document\Verification;

//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'employee';

  //Module
  protected $module = [
    'main'=>'finance',
    'sub'=>'einvoice'
  ];

	//Path Header
	protected $header = [
		'application'=>'Dashboard',
    'category'=>'Finance',
		'module'=>'Einvoice',
		'module_sub'=>'Requery',
    'item'=>'',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.'.$this->module['main'].'.'.$this->module['sub'].'.requery';

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

	}

  /**************************************************************************************
    Requery
  **************************************************************************************/
  public function requery(Request $request){

    //Get Model
    $model['einvoice']['document']['view'] = new EInvoiceDocumentView();

    //Set Model
    $data['einvoice']['document'] = $model['einvoice']['document']['view']->viewSelected(
      [
        'column'=>[
          'uuid'=>$request->uuid
        ]
      ]
    );
// dd($data['einvoice']['document']);
    $plugin['document']['verification'] = new Verification();

// dd(  [
//     'identity'=>[
//       'uuid'=>$request->uuid
//     ]
//   ]);
    $response = $plugin['document']['verification']->documentSubmission(
      [
        'identity'=>[
          'uuid'=>$request->uuid,
          'phase_category_id'=>$data['einvoice']['document']->phase_category_id,
          'company_id'=>$data['einvoice']['document']->company_id,
          'company_office_id'=>$data['einvoice']['document']->company_office_id,
          'table'=>'document_details'
        ]
      ]
    );

    // dd($response->getStatusCode());
    if($response->getStatusCode() == 200){

      $content['raw'] = $response->getBody()->getContents();
      $content['process'] = json_decode($content['raw'], true);
      $content['final'] = json_decode(json_encode($content['process']));

      // dd($response->getStatusCode());

      if(isset($content['final']) && $content['final']->status == 'Valid'){

        //Get Model
        $model['einvoice']['document']['stored_procedure'] = new EInvoiceDocumentStoredProcedure();

        //Document Reupdate
        $data['einvoice']['document'] = $model['einvoice']['document']['stored_procedure']->documentReupdateLongID(
          [
            'column'=>[
              'uuid'=>$request->uuid,
              'long_id'=>$content['final']->longId,
              'status_http_code'=>$response->getStatusCode()
            ]
          ]
        );

        //Return JSON
        return response()->json(
          [
            'status'=>true,
            'status_http_code'=>$response->getStatusCode(),
            'result'=>[
              'data'=>$content['final'],
            ]
          ]
        ,200);

      }
    }

    //Return JSON
    return response()->json(
      [
        'status'=>false,
        'result'=>$content
      ]
    ,200);

  }


}
