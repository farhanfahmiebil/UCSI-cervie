<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Procedure;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class CervieResearcherTableControl extends Model{

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
    Read
  **************************************************************************************/
  public function readRecord($data){

    //Set Table
    $this->table = 'read_cervie_researcher_table_control';

    //Set Query
    $this->query = 'EXEC '.$this->table.' ?;';
    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['table_control_id']
      ]
    );

    //Get the first result
    $result = $result[0] ?? null;

    //dd($result);

    //Return Result
    return $result;


  }

}
