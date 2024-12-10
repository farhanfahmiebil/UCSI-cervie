<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Procedure;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Model Log
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherLog AS CervieResearcherLogProcedure;

//Get Class
class CervieResearcherTeamMember extends Model{

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
  protected $table = 'cervie_researcher_team_member';

  /**************************************************************************************
    Create
  **************************************************************************************/
  public function createRecord($data){

    //Set Table
    $table = 'create_cervie_researcher_team_member';

    //Set Query
    $this->query = 'DECLARE @id INT;
              EXEC '.$table.' ?,?,?,?,?,?,?,?,?,?, @id OUTPUT;
              SELECT @id AS id;';
    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['employee_id'],
        $data['column']['name'],
        $data['column']['representation_role_id'],
        $data['column']['role'],
        $data['column']['table_name'],
        $data['column']['table_id'],
        $data['column']['need_verification'],
        $data['column']['remark'],
        $data['column']['remark_user'],
        $data['column']['created_by']
      ]
    );

    //Check Result Success
    if(!empty($result)){

      //Read Record
      $item = $this->readRecord(
        [
          'column'=>[
            'team_member_id'=>$result[0]->id,
            'employee_id'=>$data['column']['employee_id'],
          ]
        ]
      );

      //Create Log
      $this->createLog(
        [
          'employee_id'=>$item->employee_id,
          'table_name'=>$this->table,
          'event'=>'create',
          'auditable_id'=>$item->team_member_id,
          'old_value'=>'[]',
          'new_value'=>json_encode($item),
          'created_by'=>$item->created_by,
        ]
      );

      //Return Data
      return (object)[
        'status'=>true,
        'last_insert_id'=>$result[0]->id ?? 0
      ];

    }

    //If Result Failed
    return (object)[
      'status'=>false
    ];

  }

  /**************************************************************************************
    Read
  **************************************************************************************/
  public function readRecord($data){

    //Set Table
    $table = 'read_cervie_researcher_team_member';

    //Set Query
    $this->query = 'EXEC '.$table.' ?,?;';
    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['team_member_id'],
        $data['column']['employee_id'],
      ]
    );

    //Get the first result
    $result = $result[0] ?? null;

    // dd($result);

    //Return Result
    return $result;


  }

  /**************************************************************************************
    Read
  **************************************************************************************/
  public function readRecordByResearcherTable($data){

    //Set Table
    $table = 'read_cervie_researcher_team_member_by_researcher_table';

    //Set Query
    $this->query = 'EXEC '.$table.' ?,?,?;';

    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['employee_id'],
        $data['column']['table_name'],
        $data['column']['table_id'],
      ]
    );

    //Get the first result
    // $result = $result[0] ?? null;

    // dd($result);

    //Return Result
    return $result;


  }

  /**************************************************************************************
    Delete
  **************************************************************************************/
  public function deleteRecord($data){

    //Set Table
    $table = 'delete_cervie_researcher_team_member';

    //Get Item Record
    $item = $this->readRecord(
      [
        'column'=>[
          'team_member_id'=>$data['column']['team_member_id'],
          'employee_id'=>$data['column']['employee_id'],
        ]
      ]

    );

    //Set Query
    $this->query = 'EXEC '.$table.' ?,?;';

    //Get Result
    $result = DB::connection($this->connection)->statement($this->query,[
        $data['column']['team_member_id'],
        $data['column']['employee_id']
      ]
    );

    //Create Log
    $this->createLog(
      [
        'employee_id'=>$item->employee_id,
        'table_name'=>$this->table,
        'event'=>'delete',
        'auditable_id'=>$data['column']['team_member_id'],
        'old_value'=>json_encode($item),
        'new_value'=>'[]',
        'created_by'=>$item->created_by,
      ]
    );

    //Get Result
    return $result;

  }

  /**************************************************************************************
    Delete Record By Researcher Table
  **************************************************************************************/
  public function deleteRecordByResearcherTable($data){

    //Set Table
    $table = 'delete_cervie_researcher_team_member_by_researcher_table';

    //Get Item Record by Research Table
    $item = $this->readRecordByResearcherTable(
      [
        'column'=>[
          'employee_id'=>$data['column']['employee_id'],
          'table_name'=>$data['column']['table_name'],
          'table_id'=>$data['column']['table_id'],
        ]
      ]

    );

    //Set Query
    $this->query = 'EXEC '.$table.' ?,?,?;';

    //Get Result
    $result = DB::connection($this->connection)->statement($this->query,[
        $data['column']['employee_id'],
        $data['column']['table_name'],
        $data['column']['table_id'],
      ]
    );

    //Get All Item in Loop
    foreach($item as $key=>$value){

      //Create Log
      $this->createLog(
        [
          'employee_id'=>$value->employee_id,
          'table_name'=>$this->table,
          'event'=>'delete',
          'auditable_id'=>$value->team_member_id,
          'old_value'=>json_encode($value),
          'new_value'=>'[]',
          'created_by'=>$value->created_by,
        ]
      );

    }

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

  /**************************************************************************************
    Update
  **************************************************************************************/
  public function updateRecord($data){

    //Set Table
    $table = 'update_cervie_researcher_team_member';

    //Read Record
    $item['old'] = $this->readRecordByResearcherTable(
      [
        'column'=>[
          'employee_id'=>$data['column']['employee_id'],
          'table_name'=>$data['column']['table_name'],
          'table_id'=>$data['column']['table_id']
        ]
      ]
    );

    //Set Query
    $this->query = 'EXEC '.$table.' ?,?,?,?,?,
                                    ?,?;';

    //Get Result
    $result = DB::connection($this->connection)->statement($this->query,[
        $data['column']['employee_id'],
        $data['column']['table_name'],
        $data['column']['table_id'],
        $data['column']['need_verification'],
        $data['column']['remark'],
        $data['column']['remark_user'],
        $data['column']['updated_by']
      ]
    );

    //Read Record
    $item['new'] = $this->readRecordByResearcherTable(
      [
        'column'=>[
          'employee_id'=>$data['column']['employee_id'],
          'table_name'=>$data['column']['table_name'],
          'table_id'=>$data['column']['table_id']
        ]
      ]
    );

    //Create Log
      foreach($item['new'] as $key=>$value){

        $this->createLog(
          [
            'employee_id'=>$data['column']['employee_id'],
            'table_name'=>$this->table,
            'event'=>'update',
            'auditable_id'=>$value->team_member_id,
            'old_value'=>json_encode($item['old'][$key]),
            'new_value'=>json_encode($value),
            'created_by'=>$data['column']['updated_by'],
          ]
        );
    }



    //Get Result
    return $result;

  }

}
