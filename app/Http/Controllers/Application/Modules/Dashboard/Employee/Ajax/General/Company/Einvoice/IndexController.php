<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Ajax\General\Company\Einvoice;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_Main\MSSQL\View\Company;
use App\Models\UCSI_V2_Main\MSSQL\View\CompanyEinvoiceApi;
use App\Models\UCSI_V2_Main\MSSQL\View\CompanyEinvoiceApiToken;
// use App\Models\UCSI_V2_General\MSSQL\View\ApiEndpoint;

use App\Http\Plugin\Einvoice\Connection\TaxPayer\Login as PluginEinvoiceLogin;
use App\Http\Plugin\Einvoice\Verification\Company as PluginEinvoiceCompany;
// use App\Http\Plugin\Einvoice\Verification\Company;

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
 		API Information
 	**************************************************************************************/
	public function apiInformation(Request $request){
// dd($request);
// dd(232);
    //Get Company Einvoice Api Information
    $result = $this->getCompanyEinvoiceApiInformation(
      [
        'company_id'=>$request->company_id,
        'phase_category_id'=>$request->phase_category_id,
      ]
    );
// dd($result);
    //Return JSON
    return response()->json(
      [
        'result'=>[
          'data'=>$result,
        ]
      ]
    );

  }

  /**************************************************************************************
 		Get Company Einvoice Api Information
 	**************************************************************************************/
	public function getCompanyEinvoiceApiInformation($data){
// dd($data);
    //Get Model
    $model['company']['einvoice']['api'] = new CompanyEinvoiceApi();

    //Set Data
    $result = $model['company']['einvoice']['api']->viewSelected(
      [
        'column'=>[
          'company_id'=>$data['company_id'],
          'phase_category_id'=>$data['phase_category_id'],
        ]
      ]
    );

    //Return Result
    return $result;

  }

  /**************************************************************************************
 		Login Tax Payer
 	**************************************************************************************/
	public function loginTaxPayer(Request $request){

    //Set Default Status
    $status = false;

    //Get Company Detail
    $data['company'] = $this->getCompanyEinvoiceApiInformation(
      [
        'company_id'=>$request->company_id,
        'phase_category_id'=>$request->phase_category_id,
        'version'=>$request->version,
      ]
    );

    //Get Login API
    $plugin['login'] = new PluginEinvoiceLogin();

    //Get Login
    $result = $plugin['login']->login(
      [
        'company_id'=>$request->company_id,
        'phase_category_id'=>$request->phase_category_id,
        'version'=>$request->version,
      ]
    );

    //If Result Failed
    if(!$result){

      //Return JSON
      return response()->json([
          'result'=>false
        ]
      ,200);

    }

    //Return JSON
    return response()->json([
        'result'=>[
          'status'=>$result->successful(),
          'data'=>$result->getstatusCode(),
        ]
      ]
    ,200);

  }

  /**************************************************************************************
 		Access Token
 	**************************************************************************************/
	public function accessToken(Request $request){

    //Set Default Result
    $result = null;

    //Check Access Token
    $result = $this->checkAccessToken(
      [
        'company_id'=>$request->company_id,
        'phase_category_id'=>$request->phase_category_id,
        'version'=>$request->version,
      ]
    );

    //Return JSON
    return response()->json([
        'result'=>[
          'status'=>true,
          'data'=>['access_token'=>$result],
        ]
      ]
    );

  }

  /**************************************************************************************
 		Check Access Token
 	**************************************************************************************/
	public function checkAccessToken($data){

    //Get Model
    $model['company']['einvoice']['api']['token'] = new CompanyEinvoiceApiToken();

    //Get Access Token
    $item['access_token'] = $model['company']['einvoice']['api']['token']->viewSelected(
      [
        'column'=>[
          'company_id'=>$data['company_id'],
          'phase_category_id'=>$data['phase_category_id'],
        ]
      ]
    );

    //Set Access Token
    $result = $item['access_token'];

    //Check If Access Token Not Null
    if($result == null){

      //Set Data
      $item['company'] = $this->getCompanyEinvoiceApiInformation(
        [
          'company_id'=>$data['company_id'],
          'phase_category_id'=>$data['phase_category_id'],
        ]
      );

      //Get Login API
      $plugin['login'] = new PluginEinvoiceLogin();

      //Get Login
      $item['login'] = $plugin['login']->login(
        [
          'identity'=>[
            'client_domain'=>$data['company']->client_domain,
            'client_id'=>$data['company']->client_id,
            'client_secret_key_1'=>$data['company']->client_secret_key_1,
            'client_secret_key_2'=>$data['company']->client_secret_key_2,
            'company_id'=>$data['company_id'],
            'phase_category_id'=>$data['phase_category_id'],
            'table'=>'company_einvoice_api',
          ]
        ]
      );

      //Get Access Token
      $data['access_token'] = $model['company']['einvoice']['api']['token']->viewSelected(
        [
          'column'=>[
            'company_id'=>$data['company_id'],
            'phase_category_id'=>$data['phase_category_id'],
          ]
        ]
      );

      //Set Access Token
      $result = $data['access_token'];

    }

    //Return Result
    return $result;

  }

  /**************************************************************************************
 		Verification Company TIN
 	**************************************************************************************/
	public function verificationCompanyTIN(Request $request){

    //Set Default Result
    $result = null;

    //Check Access Token
    $data['company'] = $this->getCompanyEinvoiceApiInformation(
      [
        'company_id'=>$request->company_id,
        'phase_category_id'=>$request->phase_category_id,
      ]
    );
  // dd($data['company']);
    //Set Plugin Company
    $plugin['company'] = new PluginEinvoiceCompany();

    //Get Result
    $result = $plugin['company']->validateTIN(
      [
        'identity'=>[
          'company_id'=>$request->company_id,
          'phase_category_id'=>$request->phase_category_id,
          'version'=>$request->version,
        ],
        'parameter'=>[
          'tin_no'=>$data['company']->company_tin,
          'tax_identification_type_id'=>'BRN',
          'tax_identification_type_value'=>$data['company']->company_no
        ]
      ]
    );

    //Return JSON
    return response()->json([
        'result'=>[
          'status'=>$result->successful(),
        ]
      ]
    );

  }

}
