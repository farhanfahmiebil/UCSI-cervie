<?php

//Get Controller Path
namespace App\Http\Controllers\Application\Modules\Dashboard\Researcher\Insight\home;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Timestamp
use Carbon\Carbon;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Model
use App\Models\UCSI_V2_General\MSSQL\Table\AgreementType;
use App\Models\UCSI_V2_General\MSSQL\Table\AgreementLevel;
use App\Models\UCSI_V2_General\MSSQL\Table\LinkageCategory;
use App\Models\UCSI_V2_General\MSSQL\Table\Country;
use App\Models\UCSI_V2_Education\MSSQL\Table\CervieResearcherLinkage;
use App\Models\UCSI_V2_Education\MSSQL\Table\CervieResearcherEvidence;

//Get View
use App\Models\UCSI_V2_Education\MSSQL\View\Report AS ReportView;
use App\Models\UCSI_V2_Education\MSSQL\View\CervieResearcherPublication AS CervieResearcherPublicationView;

//Get Procedure
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherGrant AS CervieResearcherGrantProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\Report AS ReportProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherPublication AS CervieResearcherPublicationProcedure;


//Get Request
use Illuminate\Http\Request;

//Get Class
class IndexController extends Controller{

	//Application
  protected $application = 'application';

  //User
  protected $user = 'researcher';

  //Path Header
	protected $header = [
		'application'=>'Dashboard',
    'category'=>'Linkage',
		'module'=>'',
		'module_sub'=>'',
    'item'=>'',
		'gate'=>''
	];

	//Route Link
	protected $route;

	//Page
	public $page;

	//Hyperlink
	public $hyperlink;

	/**************************************************************************************
		Route Path
	**************************************************************************************/
	public function routePath(){

		//Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.view').'.insight.';
    $this->route['name'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.insight.';

    //Set Navigation
		$this->page['sub'] = $this->route['view'];

    //Set Navigation
		$this->hyperlink['navigation'] = $this->navigation['hyperlink'];

    //Set Hyperlink
    $this->hyperlink['page']['home'] = $this->route['name'].'home';

		//Set Hyperlink
    // $this->hyperlink['page']['ajax']['navigation']['access']['module']['company'] = config('routing.application.modules.dashboard.'.$this->user.'.name').'.ajax.authorization.access.module.company';

	}

	/**************************************************************************************
 		Home
 	**************************************************************************************/
	public function index(Request $request){

		//Get Route Path
		$this->routePath();

		//Set Hyperlink
		$hyperlink = $this->hyperlink;

    //Set Page Sub
    $page = $this->page;
    $page['sub'] .= 'home.sub.';

    //Set Breadcrumb Icon
    $data['breadcrumb']['icon'] = '<i class="bi bi-house"></i>';

    //Set Breadcrumb Title
    $data['breadcrumb']['title'] = ['Welcome Back, '.Auth::user()->name];

		//Set Breadcrumb
		$data['title'] = array($this->header['category']);

    //Set Model Report
    $model['report']['view'] = new ReportView();

    //Get Report
    $data['report']['view'] = $model['report']['view']->viewReport(
      [
        'column'=>[
          'code'=>'0000000000001'
        ]
      ]
    );

    //Set Model Report
    $model['report']['procedure'] = new ReportProcedure();

    //Get Report
    $data['report']['by']['grant']['progress'] = $model['report']['procedure']->readReport(
      [
        'code'=>$data['report']['view']->code,
        'column'=>[
          'employee_id'=>Auth::id()
        ]
      ]
    );

    //Set Model Publication
    $model['cervie']['researcher']['grant']['procedure'] = new CervieResearcherGrantProcedure();

    //Get Graph
    $data['cervie']['researcher']['grant']['graph']['type']['by']['year'] = $model['cervie']['researcher']['grant']['procedure']->readGraphTypeByYear(
      [
        'column'=>[
          'employee_id'=>Auth::id()
        ]
      ]
    );

    //Get Graph
    $data['cervie']['researcher']['grant']['graph']['type']['by']['quantum'] = $model['cervie']['researcher']['grant']['procedure']->readGraphTypeByQuantum(
      [
        'column'=>[
          'employee_id'=>Auth::id()
        ]
      ]
    );

    //Set Model Publication
    $model['cervie']['researcher']['publication']['procedure'] = new CervieResearcherPublicationProcedure();

    //Get Graph
    $data['cervie']['researcher']['publication']['graph']['type'] = $model['cervie']['researcher']['publication']['procedure']->readGraphbyType(
      [
        'column'=>[
          'employee_id'=>Auth::id()
        ]
      ]
    );

    //Get Graph
    $data['cervie']['researcher']['publication']['graph']['indexing']['body'] = $model['cervie']['researcher']['publication']['procedure']->readGraphbyIndexingBody(
      [
        'column'=>[
          'employee_id'=>Auth::id()
        ]
      ]
    );

    // Initialize the necessary arrays
    $data['graph']['publication']['type']['year'] = [];
    $data['graph']['publication']['type']['data'] = [];  // This will hold the data grouped by year
    $allPublicationTypes = [];  // This will store all unique publication types across years

    // Collecting data dynamically
    foreach ($data['cervie']['researcher']['publication']['graph']['type'] as $row) {
        // Add year to the 'year' array if it's not already added
        if (!in_array($row->year, $data['graph']['publication']['type']['year'])) {
            $data['graph']['publication']['type']['year'][] = $row->year;
        }

        // Collect all unique publication types
        $allPublicationTypes[$row->publication_type_name] = true;

        // Store data for the year and publication type
        if ($row->total !== null && $row->total !== 0) {
            $data['graph']['publication']['type']['data'][$row->year][$row->publication_type_name] = $row->total;
        } else {
            // Ensure that we add 0 for years where no data exists for this publication type
            if (!isset($data['graph']['publication']['type']['data'][$row->year][$row->publication_type_name])) {
                $data['graph']['publication']['type']['data'][$row->year][$row->publication_type_name] = 0;
            }
        }
    }

    // Now, ensure the 'label' array contains all unique publication types
    $data['graph']['publication']['type']['label'] = array_keys($allPublicationTypes);

    // Ensure each publication type has data for every year
    foreach ($data['graph']['publication']['type']['year'] as $year) {
        foreach ($data['graph']['publication']['type']['label'] as $type) {
            if (!isset($data['graph']['publication']['type']['data'][$year][$type])) {
                // Set missing data for the year-publication type combination to 0
                $data['graph']['publication']['type']['data'][$year][$type] = 0;
            }
        }
    }

    // Initialize the necessary arrays for indexing body
    $data['graph']['indexing']['body']['year'] = [];
    $data['graph']['indexing']['body']['data'] = [];  // This will hold the data grouped by year and indexing body type
    $allIndexingBodies = [];  // This will store all unique indexing body types across years

    // Collecting data dynamically for indexing body
    foreach ($data['cervie']['researcher']['publication']['graph']['indexing']['body'] as $row) {
        // Skip if publication_year is null
        if ($row->publication_year === null || empty($row->publication_year)) {
            continue;
        }

        // Add year to the 'year' array if it's not already added
        if (!in_array($row->publication_year, $data['graph']['indexing']['body']['year'])) {
            $data['graph']['indexing']['body']['year'][] = $row->publication_year;
        }

        // Collect all unique indexing body types
        $allIndexingBodies[$row->indexing_body_type_name] = true;

        // Store data for the year and indexing body type
        if ($row->total !== null && $row->total !== 0) {
            $data['graph']['indexing']['body']['data'][$row->publication_year][$row->indexing_body_type_name] = $row->total;
        } else {
            // Ensure that we add 0 for years where no data exists for this indexing body type
            if (!isset($data['graph']['indexing']['body']['data'][$row->publication_year][$row->indexing_body_type_name])) {
                $data['graph']['indexing']['body']['data'][$row->publication_year][$row->indexing_body_type_name] = 0;
            }
        }
    }

    // Now, ensure the 'label' array contains all unique indexing body types
    $data['graph']['indexing']['body']['label'] = array_keys($allIndexingBodies);

    // Ensure each indexing body type has data for every year
    foreach ($data['graph']['indexing']['body']['year'] as $year) {
        foreach ($data['graph']['indexing']['body']['label'] as $type) {
            if (!isset($data['graph']['indexing']['body']['data'][$year][$type])) {
                // Set missing data for the year-indexing body type combination to 0
                $data['graph']['indexing']['body']['data'][$year][$type] = 0;
            }
        }
    }

		//Return View
		return view($this->route['view'].'home.index',compact('data','page','hyperlink'));

  }


}
