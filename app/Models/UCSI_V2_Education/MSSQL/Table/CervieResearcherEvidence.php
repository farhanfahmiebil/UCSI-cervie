<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Table;

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
  protected $table = 'cervie_researcher_evidence';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'evidence_id';

  /**
   * Indicates if the model's ID is auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'evidence_id',
    'employee_id',
    'researcher_category_id',
    'file_raw_name',
    'file_name',
    'fikle_extension',
    'description',
    'created_by',
    'created_at',
    'updated_by',
    'deleted_by',
    'updated_at',
    'deleted_at',
    'category',
    'category_other'
  ];

  //Table Neighbor
  protected $table_neighbor = [
    'general'=>[
      'user'=>'dbo',
      'table'=>'salutation',
      'database'=>'ucsi_v2_general'
    ]
  ];

  /**************************************************************************************
    Get Last ID
  **************************************************************************************/
  public function getLastID(){

    //Get Result
    $result = DB::connection($this->connection)->table($this->table)->select(
                        $this->table.'.evidence_id AS evidence_id'
                      )
                     ->orderBy('evidence_id', 'desc')
                     ->first();

    return $result;
  }



  /**************************************************************************************
    Get List
  **************************************************************************************/
  public function getList($data){

    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.evidence_id AS evidence_id',
                    $this->table.'.employee_id AS employee_id',
                    $this->table.'.researcher_category_id AS organization',
                    $this->table.'.file_raw_name AS file_raw_name',
                    $this->table.'.file_name AS file_name',
                    $this->table.'.file_extension AS file_extension',
                    $this->table.'.description AS description',
                    $this->table.'.category AS category',
                    $this->table.'.category_other AS category_other'
                  )
                // ->join($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.qualification AS qualification','qualification.qualification_id','=',$this->table.'.qualification_id')
                ->where($this->table.'.employee_id',$data['column']['employee_id'])
                ->get();

    //Get Result
    return $result;

  }

  /**************************************************************************************
    Check Exist
  **************************************************************************************/
  public function checkExist($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.academic_qualification_id AS academic_qualification_id',
                                                );

    //Filter Data
    if(isset($data['column']['id']) && $data['column']['id'] != null){$result = $result->where($this->table.'.academic_qualification_id',$data['column']['id']);}

    //Check Type For Soft and Hard Delete
    // if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where('status.name','deleted');}

    //Get Count Result
    $result = $result->count();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    View Selected
  **************************************************************************************/
  public function viewSelected($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.evidence_id AS evidence_id',
                                                  $this->table.'.employee_id AS employee_id',
                                                  $this->table.'.researcher_category_id AS researcher_category_id',
                                                  $this->table.'.file_raw_name AS file_raw_name',
                                                  $this->table.'.file_name AS file_name',
                                                  $this->table.'.file_extension AS file_extension',
                                                  $this->table.'.category AS category',
                                                  $this->table.'.description AS description'
                                                )
                                                ->where($this->table.'.researcher_category_id',$data['column']['id'])
                                                ->where($this->table.'.category',$data['column']['category']);

    //Get Count Result
    $result = $result->get();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Get Data Ajax
  **************************************************************************************/
  public function getDataAjax($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.evidence_id AS evidence_id',
                                                  $this->table.'.employee_id AS employee_id',
                                                  $this->table.'.researcher_category_id AS researcher_category_id',
                                                  $this->table.'.file_raw_name AS file_raw_name',
                                                  $this->table.'.file_name AS file_name',
                                                  $this->table.'.file_extension AS file_extension',
                                                  $this->table.'.category AS category',
                                                  $this->table.'.description AS description'
                                                )
                                                ->where($this->table.'.researcher_category_id',$data['column']['id'])
                                                ->where($this->table.'.category',$data['column']['category']);

    //Get Count Result
    $result = $result->get();

    //Return Result
    return $result;

  }






}
