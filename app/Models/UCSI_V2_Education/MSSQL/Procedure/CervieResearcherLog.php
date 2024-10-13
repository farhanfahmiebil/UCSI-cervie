<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Procedure;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class CervieResearcherLog extends Model{

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
    $this->table = 'create_cervie_researcher_log';

    //Set Query
    $this->query = 'DECLARE @id INT;
              EXEC '.$this->table.' ?,?,?,?,?,?,?, @id OUTPUT;
              SELECT @id AS id;';

    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['employee_id'],
        $data['column']['table_name'],
        $data['column']['event'],
        $data['column']['auditable_id'],
        $data['column']['old_value'],
        $data['column']['new_value'],
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
    Update
  **************************************************************************************/
  public function updateRecord($data){

    //Set Table
    $this->table = 'read_cervie_researcher_evidence';

    //Set Query
    $this->query = 'EXEC '.$this->table.' ?,?;';
    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['evidence_id'],
        $data['column']['employee_id'],
      ]
    );

    //Get the first result
    $result = $result[0] ?? null;

    // dd($result);

    //Return Result
    return $result;


  }



}
