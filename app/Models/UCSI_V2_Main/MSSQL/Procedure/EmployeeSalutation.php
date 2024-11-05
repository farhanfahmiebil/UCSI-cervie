<?php

namespace app\Models\UCSI_V2_Main\MSSQL\Procedure;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Model Log
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherLog AS CervieResearcherLogProcedure;

//Get Class
class EmployeeSalutation extends Model{

  /**
   * The database connection that should be used by the model.
   *
   * @var string
   */
  protected $connection = 'sqlsrv_ucsi_v2_main';

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'employee_salutation';

  /**************************************************************************************
    Create
  **************************************************************************************/
  public function createRecord($data){

    //Set Table
    $table = 'create_employee_salutation';

    //Set Query
    $this->query = 'EXEC '.$table.' ?,?,?,?,?,?;';

    //Get Result
    $result = DB::connection($this->connection)->statement($this->query,[
        $data['column']['employee_id'],
        $data['column']['salutation_id'],
        $data['column']['ordering'],
        $data['column']['remark'],
        $data['column']['remark_user'],
        $data['column']['created_by']
      ]
    );

    //Get Result
    return $result;

  }

}
