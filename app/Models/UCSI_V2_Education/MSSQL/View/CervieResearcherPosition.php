<?php

namespace app\Models\UCSI_V2_Education\MSSQL\View;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class CervieResearcherPosition extends Model{

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
  protected $table = '';

  /**************************************************************************************
    Get List
  **************************************************************************************/
  public function getList($data){

    //Set Table
    $this->table = 'list_cervie_researcher_position';

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->where($this->table.'.employee_id',$data['column']['employee_id']);

    //Get Result
    $result = $result->get();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    View Selected
  **************************************************************************************/
  public function viewSelected($data){

    //Set Table
    $this->table = 'view_cervie_researcher_position';

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->where($this->table.'.employee_id',$data['column']['employee_id'])
                                               ->where($this->table.'.position_id',$data['column']['position_id']);

    //Get Result
    $result = $result->first();

    //Return Result
    return $result;

  }

}
