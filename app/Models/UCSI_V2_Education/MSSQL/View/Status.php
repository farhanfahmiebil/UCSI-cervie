<?php

//Set Namespace
namespace App\Models\UCSI_V2_Education\MSSQL\View;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class Status extends Model{

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
    Select Box
  **************************************************************************************/
  public function selectBox($data){

    //Set Table
    $this->table = 'selectbox_status';

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->where($this->table.'.status_name','!=','deleted')
                                               ->where($this->table.'.status_table',$data['column']['table']);

    //Get Result
    $result = $result->get();

    //Return Result
    return $result;

  }

}
