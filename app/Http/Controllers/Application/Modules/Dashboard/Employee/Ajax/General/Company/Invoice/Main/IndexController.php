<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Ajax\General\Company\invoice\Main;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model Main
use App\Models\UCSI_V2_Main\MSSQL\StoredProcedure\Company;
use App\Models\UCSI_V2_Main\MSSQL\View\EInvoiceDocument;

//Model UCSI Academy
//Sri UCSI - Springhill
use App\Models\UCSI_Academy\MSSQL\SRI_UCSI\View\Springhill\Receipt AS UCSI_ACADEMY_SRI_UCSI_SPRINGHILL_RECEIPT;

//Model UCSI Education
use App\Models\UCSI_EDUCATION\MSSQL\IIS\V1\StoredProcedure\Receipt AS UCSI_EDUCATION_IIS_V1_RECEIPT;

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
		'module'=>'General',
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
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.ajax.general.company';

	}


  /**************************************************************************************
 		Index
 	**************************************************************************************/
	public function index(Request $request){

    //Set Model
    $model['company'] = new Company();

    //Check Exist
    $check['company'] = $model['company']->checkExist(
      [
        'column'=>[
          'company_id'=>$request->company_id
        ]
      ]
    );
// dd(    $check['company']);
    if(!$check['company']){

      //Return JSON
      return response()->json(
        [
          'result'=>[
            'status'=>false,
            'data'=>null,
          ]
        ]
      );

    }
// dd($request);
    //Get Result
    $result = $this->getCompanyInvoice($request);

    if(!$result){

      //Return JSON
      return response()->json(
        [
          'result'=>[
            'status'=>false,
            'data'=>null,
          ]
        ]
      );

    }

    //Return JSON
    return response()->json(
      [
        'result'=>[
          'status'=>true,
          'data'=>$result,
        ]
      ]
    );

  }

  public function getCompanyInvoice(Request $request){

    //Set Model
    $model = null;

    //Set Result
    $result = null;

    //Get Data
    switch($request->company_id){

      //Springhill
      case 'UCSI_EDUCATION':

        //Main Campus
        switch($request->company_office_id){

          //Springhill
          case 'MAIN_CAMPUS':

          //Set Model Invoice
            //$model['invoice'] = new UCSI_ACADEMY_SRI_UCSI_SPRINGHILL_RECEIPT();

            //Set Model Invoice
            $model['invoice'] = new UCSI_ACADEMY_SRI_UCSI_SPRINGHILL_RECEIPT();

            //Get Model
            $data['invoice']['document']  = $model['invoice']->getList(
              [
                'column'=>[
                  'company_id'=>$request->company_id,
                  'company_office_id'=>$request->company_office_id,
                  'year_start'=>$request->year_start,
                  'month_start'=>$request->month_start,
                  'day_week_start'=>$request->day_week_start,
                  'daily'=>[
                    'date_start'=>$request->daily['date_start'],
                    'date_end'=>$request->daily['date_end'],
                  ],
                  'search'=>$request->search,
                  'sort'=>$request->sort,
                ]
              ]
            );

            //Set Model Invoice
            $model['einvoice']['document'] = new EInvoiceDocument();

            //Set Data - Einvoice Document
            $data['einvoice']['document'] = $model['einvoice']['document']->getList(
              [
                'column'=>[
                  'phase_category_id'=>$request->phase_category_id,
                  'company_id'=>$request->company_id,
                  'company_office_id'=>$request->company_office_id,
                ]
              ]
            );

  // dd($data['invoice']['document'],$data['einvoice']['document']);
            $result = $this->matchDocument($data['invoice']['document'],$data['einvoice']['document']);

          break;
        }

      break;

      //If UCSI Academy
      case 'UCSI_ACADEMY':

        //Get Data
        switch($request->company_office_id){

          //Springhill
          case 'SRI_UCSI_2':

            //Set Model Invoice
            $model['invoice'] = new UCSI_ACADEMY_SRI_UCSI_SPRINGHILL_RECEIPT();

            //Get Model
            $data['invoice']['document']  = $model['invoice']->getList(
              [
                'column'=>[
                  'company_id'=>$request->company_id,
                  'company_office_id'=>$request->company_office_id,
                  'year_start'=>$request->year_start,
                  'month_start'=>$request->month_start,
                  'day_week_start'=>$request->day_week_start,
                  'daily'=>[
                    'date_start'=>$request->daily['date_start'],
                    'date_end'=>$request->daily['date_end'],
                  ],
                  'search'=>$request->search,
                  'sort'=>$request->sort,
                ]
              ]
            );

            //Set Model Invoice
            $model['einvoice']['document'] = new EInvoiceDocument();

            //Set Data - Einvoice Document
            $data['einvoice']['document'] = $model['einvoice']['document']->getList(
              [
                'column'=>[
                  'phase_category_id'=>$request->phase_category_id,
                  'company_id'=>$request->company_id,
                  'company_office_id'=>$request->company_office_id,
                ]
              ]
            );

  // dd($data['invoice']['document'],$data['einvoice']['document']);
            $result = $this->matchDocument($data['invoice']['document'],$data['einvoice']['document']);
// dd($result);
          break;

          //Default
          default:
            $result = null;
          break;

        }
// dd($data);
      break;

    }

    return $result;


  }

  public function matchDocument($invoice,$einvoice){

    // dd($invoice,$einvoice);
    $result = $invoice->map(function ($item) use ($einvoice) {
    // Assume the code is generated based on some logic
    // $item->code = 32;

// dd($item->einvoice_status);
    if($einvoice){

      // $item['einvoice_status'] = null;
      // $item['einvoice_uuid'] = null;

      $item->einvoice_status = null;
      $item->einvoice_uuid = null;
      $match['item'] = $einvoice->firstWhere('receipt_id', $item->receipt_no);
// dd($match['item']);
       if($match['item']){
           $item->einvoice_http_status_code = $match['item']->status_http_code;
           $item->einvoice_status = $match['item']->status;
           $item->einvoice_uuid = $match['item']->uuid;
           $item->einvoice_long_id = $match['item']->long_id;
           // $item['domain'] = $match['item']->domain;
           $item->domain_client = $match['item']->domain_client;
           // $item['uuid'] = 32;
       }else{
           // $item['einvoice_status'] = ''; // Or any default status if no match is found
       }

      }

      return $item;

    });
// dd($result);
    return $result;

  }


}
