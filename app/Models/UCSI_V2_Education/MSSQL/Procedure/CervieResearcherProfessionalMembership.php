<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Procedure;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Model Log
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherLog AS CervieResearcherLogProcedure;

//Get Class
class CervieResearcherProfessionalMembership extends Model{

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
  protected $table = 'cervie_researcher_professional_membership';

  /**************************************************************************************
    Create
  **************************************************************************************/
  public function createRecord($data){

    //Set Table
    $table = 'create_cervie_researcher_professional_membership';

    //Set Query
    $this->query = 'DECLARE @id INT;
              EXEC '.$table.' ?,?,?,?,?,?,?,?,?,?,?, @id OUTPUT;
              SELECT @id AS id;';

    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['employee_id'],
        $data['column']['name'],
        $data['column']['professional_membership_level_id'],
        $data['column']['professional_membership_role_id'],
        $data['column']['professional_membership_type_id'],
        $data['column']['date_start'],
        $data['column']['date_end'],
        $data['column']['is_lifetime'],
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
            'professional_membership_id'=>$result[0]->id,
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
          'auditable_id'=>$item->professional_membership_id,
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
    $table = 'read_cervie_researcher_professional_membership';

    //Set Query
    $this->query = 'EXEC '.$table.' ?,?;';

    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['professional_membership_id'],
        $data['column']['employee_id'],
      ]
    );
// dd();
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
    $table = 'update_cervie_researcher_professional_membership';

    //Read Record
    $item['old'] = $this->readRecord(
      [
        'column'=>[
          'professional_membership_id'=>$data['column']['professional_membership_id'],
          'employee_id'=>$data['column']['employee_id'],
        ]
      ]
    );
// dd($data);
    //Set Query
    $this->query = 'EXEC '.$table.' ?,?,?,?,?,?,?,?,?,?,?,?;';

    //Get Result
    $result = DB::connection($this->connection)->statement($this->query,[
        $data['column']['professional_membership_id'],
        $data['column']['employee_id'],
        $data['column']['name'],
        $data['column']['professional_membership_level_id'],
        $data['column']['professional_membership_role_id'],
        $data['column']['professional_membership_type_id'],
        $data['column']['date_start'],
        $data['column']['date_end'],
        $data['column']['is_lifetime'],
        $data['column']['remark'],
        $data['column']['remark_user'],
        $data['column']['updated_by']
      ]
    );

    //Read Record
    $item['new'] = $this->readRecord(
      [
        'column'=>[
          'professional_membership_id'=>$data['column']['professional_membership_id'],
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
        'auditable_id'=>$data['column']['professional_membership_id'],
        'old_value'=>json_encode($item['old']),
        'new_value'=>json_encode($item['new']),
        'created_by'=>$data['column']['updated_by'],
      ]
    );

    //Get Result
    return $result;

  }

  /**************************************************************************************
    Delete
  **************************************************************************************/
  public function deleteRecord($data){

    //Set Table
    $table = 'delete_cervie_researcher_professional_membership';

    //Set Query
    $this->query = 'EXEC '.$table.' ?,?;';

    //Get Result
    $result = DB::connection($this->connection)->statement($this->query,[
        $data['column']['professional_membership_id'],
        $data['column']['employee_id']
      ]
    );

    //Get Result
    return $result;

  }

  /**************************************************************************************
    Need Verification
  **************************************************************************************/
  public function needVerification($data){

    //Set Table
    $table = 'update_cervie_researcher_professional_membership_verification';

    //Set Query
    $this->query = 'EXEC '.$table.' ?,?,?;';

    //Get Result
    $result = DB::connection($this->connection)->statement($this->query,[
        $data['column']['professional_membership_id'],
        $data['column']['employee_id'],
        $data['column']['updated_by']
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
