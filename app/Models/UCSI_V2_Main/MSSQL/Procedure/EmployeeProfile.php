<?php

namespace app\Models\UCSI_V2_Main\MSSQL\Procedure;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Model Log
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherLog AS CervieResearcherLogProcedure;

//Get Class
class EmployeeProfile extends Model{

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
  protected $table = 'employee_profile';



  /**************************************************************************************
    Read
  **************************************************************************************/
  public function readRecord($data){

    //Set Table
    $table = 'read_employee_profile';

    //Set Query
    $this->query = 'EXEC '.$table.' ?;';

    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['employee_id'],
      ]
    );

    //Get the first result
    $result = $result[0] ?? null;

    //dd($result);

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Update
  **************************************************************************************/
  public function updateRecord($data){

    //Set Table
    $table = 'update_employee_profile';

    //Set Query
    $this->query = 'EXEC '.$table.' ?,?,?,?,?,?,?,?,?,?;';

    //Get Result
    $result = DB::connection($this->connection)->statement($this->query,[
        $data['column']['employee_id'],
        $data['column']['first_name'],
        $data['column']['last_name'],
        $data['column']['full_name'],
        $data['column']['middle_name'],
        $data['column']['dob'],
        $data['column']['nickname'],
        $data['column']['remark'],
        $data['column']['remark_user'],
        $data['column']['updated_by']
      ]
    );

    //Get Result
    return $result;

  }

}
