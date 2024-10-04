<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Procedure;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class CervieResearcherEvidence extends Model{

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
    Create
  **************************************************************************************/
  public function createRecord($data){

    //Set Table
    $this->table = 'create_cervie_researcher_evidence';

    //Set Query
    $this->query = 'DECLARE @id INT;
              EXEC '.$this->table.' ?,?,?,?,?,?,?,?, @id OUTPUT;
              SELECT @id AS id;';

    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['employee_id'],
        $data['column']['file_raw_name'],
        $data['column']['file_name'],
        $data['column']['file_extension'],
        $data['column']['description'],
        $data['column']['table_name'],
        $data['column']['table_id'],
        $data['column']['created_by']
      ]
    );

    //Check Result Success
    if(!empty($result)){

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
    $this->table = 'read_cervie_researcher_evidence';

    //Set Query
    $this->query = 'EXEC '.$this->table.' ?,?,?;';
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
    Update
  **************************************************************************************/
  public function updateRecord($data){

    //Set Table
    $this->table = 'update_cervie_researcher_work_experience';
// dd($data);
    //Set Query
    $this->query = 'EXEC '.$this->table.' ?,?,?,?,?,?,?,?,?,?;';
    //Get Result
    $result = DB::connection($this->connection)->statement($this->query,[
        $data['column']['position_id'],
        $data['column']['employee_id'],
        $data['column']['name'],
        $data['column']['organization_id'],
        $data['column']['organization_name'],
        $data['column']['is_main'],
        $data['column']['user_position_id'],
        $data['column']['date_start'],
        $data['column']['date_end'],
        $data['column']['updated_by']
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
    $this->table = 'delete_cervie_researcher_work_experience';
// dd($data);
    //Set Query
    $this->query = 'EXEC '.$this->table.' ?,?;';

    //Get Result
    $result = DB::connection($this->connection)->statement($this->query,[
        $data['column']['position_id'],
        $data['column']['employee_id']
      ]
    );

    //Get Result
    return $result;

  }

}
