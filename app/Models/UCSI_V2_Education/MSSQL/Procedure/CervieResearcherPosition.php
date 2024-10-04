<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Procedure;

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
    Create
  **************************************************************************************/
  public function createRecord($data){

    //Set Table
    $this->table = 'create_cervie_researcher_position';

    //Set Query
    $this->query = 'DECLARE @@id INT;
              EXEC '.$this->table.' ?,?,?,?,?,?,?,?,?, @id OUTPUT;
              SELECT @id AS id;';
    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['employee_id'],
        $data['column']['name'],
        $data['column']['organization_id'],
        $data['column']['organization_name'],
        $data['column']['is_main'],
        $data['column']['user_position_id'],
        $data['column']['date_start'],
        $data['column']['date_end'],
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
    $this->table = 'update_cervie_researcher_position';
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
    $this->table = 'delete_cervie_researcher_position';
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
