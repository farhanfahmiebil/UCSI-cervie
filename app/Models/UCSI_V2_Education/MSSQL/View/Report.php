<?php

//Set Namespace
namespace App\Models\UCSI_V2_Education\MSSQL\View;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class Report extends Model{

  /**
   * The database connection that should be used by the model.
   *
   * @var string
   */
  protected $connection = 'sqlsrv_ucsi_v2_education';

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table;

  /**************************************************************************************
    View Report
  **************************************************************************************/
  public function viewReport($data){

    //Set Table
    $this->table = 'view_report';

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->where($this->table.'.code',$data['column']['code']);

    //Get Result
    $result = $result->first();

    //Return Result
    return $result;

  }

}
