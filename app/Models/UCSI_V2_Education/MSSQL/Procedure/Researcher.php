<?php

namespace App\Models\UCSI_V2_Education\MSSQL\Procedure;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Model Log
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherLog AS CervieResearcherLogProcedure;

//Get Class
class Researcher extends Model{

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
  protected $table = 'researcher';

  /**************************************************************************************
    Read
  **************************************************************************************/
  public function readRecord($data){

    //Set Table
    $table = 'read_researcher';

    //Set Query
    $this->query = 'EXEC '.$table.' ?;';
    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['employee_id'],
      ]
    );

    //Get the first result
    $result = $result[0] ?? null;

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Update
  **************************************************************************************/
  public function updateRecord($data){

    //Set Table
    $table = 'update_researcher';

    //Read Record
    $item['old'] = $this->readRecord(
      [
        'column'=>[
          'employee_id'=>$data['column']['employee_id'],
        ]
      ]
    );

    //Set Query
    $this->query = 'EXEC '.$table.' ?,?,?,?,?,?;';

    // //Get Result
    $result = DB::connection($this->connection)->statement($this->query,[
        $data['column']['employee_id'],
        $data['column']['description'],
        $data['column']['need_verification'],
        $data['column']['remark'],
        $data['column']['remark_user'],
        $data['column']['updated_by']
      ]
    );

    //Read Record
    $item['new'] = $this->readRecord(
      [
        'column'=>[
          'employee_id'=>$data['column']['employee_id'],
        ]
      ]
    );

    //Create Log
    $this->createLog(
      [
        'employee_id'=>$data['column']['employee_id'],
        'table_name'=>$this->table,
        'event'=>'update',
        'auditable_id'=>$data['column']['employee_id'],
        'old_value'=>json_encode($item['old']),
        'new_value'=>json_encode($item['new']),
        'created_by'=>$data['column']['updated_by'],
      ]
    );

    //Get Result
    return $result;

  }

  /**************************************************************************************
    Create Log
  **************************************************************************************/
  function createLog($data){

    //Set Model
    $model['cervie']['researcher']['log'] = new CervieResearcherLogProcedure();

    //Create Log
    $data['cervie']['researcher']['log'] = $model['cervie']['researcher']['log']->createRecord(
      [
        'column'=>[
          'employee_id'=>$data['employee_id'],
          'table_name'=>$data['table_name'],
          'event'=>$data['event'],
          'auditable_id'=>$data['auditable_id'],
          'old_value'=>$data['old_value'],
          'new_value'=>(!empty($data['new_value'])?$data['new_value']:'[]'),
          'created_by'=>$data['created_by'],
        ]
      ]
    );

  }


}
