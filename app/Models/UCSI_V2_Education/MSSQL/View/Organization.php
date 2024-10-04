<?php

namespace App\Models\UCSI_V2_Education\MSSQL\View;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class Organization extends Model{

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
    $this->table = 'selectbox_organization';

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->where($this->table.'.status_name','active')
                                               ->where($this->table.'.company_id',$data['column']['company_id'])
                                               ->where($this->table.'.company_office_id',$data['column']['company_office_id']);

    //Get Result
    $result = $result->get();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    List
  **************************************************************************************/
  public function list($data){

    //Set Table
    $this->table = 'list_organization';

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->where($this->table.'.status_name','active')
                                               ->where($this->table.'.company_id',$data['column']['company_id'])
                                               ->where($this->table.'.company_office_id',$data['column']['company_office_id']);

    //Get Result
    $result = $result->first();

    //Return Result
    return $result;

  }

}
