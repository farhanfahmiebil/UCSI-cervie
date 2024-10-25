<?php

namespace App\Models\UCSI_V2_Education\MSSQL\Procedure;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class Report extends Model{

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
  public function readReport($data){

    //Set Table
    $table = 'report_'.$data['code'];

    //Check Data Column Exist
    if(!isset($data['column'])){abort(505,'Missing Report Parameter');}

    $question = '';

    if(count($data['column']) > 0){
        // Generate a comma-separated list of question marks (placeholders)
      $question = implode(',', array_fill(0, count($data['column']), '?'));
    }
    //Set Query
    $this->query = 'EXEC '.$table.' '.$question.';';
// dd($this->query,$data['column']);
    //Get Result
    try {
      $result = DB::connection($this->connection)->select($this->query,array_values($data['column']));
    }catch (\Exception $e) {
        // Handle potential exceptions (e.g., SQL errors, connection issues)
        abort(500, 'Database error: ' . $e->getMessage());
    }

    //Get the first result
    // $result = $result[0] ?? null;

    //dd($result);

    //Return Result
    return $result;


  }

}
