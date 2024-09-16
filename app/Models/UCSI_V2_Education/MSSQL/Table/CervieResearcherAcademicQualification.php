<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class CervieResearcherAcademicQualification extends Model{

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
  protected $table = 'cervie_researcher_academic_qualification';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'academic_qualification_id';

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
    'academic_qualification_id',
    'employee_id',
    'qualification_other',
    'qualification_id',
    'date_start',
    'date_end',
    'created_by',
    'created_at',
    'updated_by',
    'deleted_by',
    'updated_at',
    'deleted_at',
    'need_verification',
    'qualification_name',
    'institution_name',
    'filename'
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
                        $this->table.'.academic_qualification_id AS academic_qualification_id'
                      )
                     ->orderBy('academic_qualification_id', 'desc')
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
                    $this->table.'.academic_qualification_id AS academic_qualification_id',
                    $this->table.'.employee_id AS employee_id',
                    $this->table.'.qualification_other AS qualification_other',
                    $this->table.'.qualification_id AS qualification_id',
                    $this->table.'.date_start AS date_start',
                    $this->table.'.date_end AS date_end',
                    $this->table.'.qualification_name AS qualification_name',
                    $this->table.'.institution_name AS institution_name',
                    $this->table.'.filename AS filename',
                    'qualification.name AS qualification_type_name',

                  )
                ->join($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.qualification AS qualification','qualification.qualification_id','=',$this->table.'.qualification_id')
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




}
