<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class Campus extends Model{

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
  protected $table = 'campus';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'campus_id';

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
    'campus_id',
    'name',
    'location',
    'short_name',
    'religion_name',
    'university',
    'id_number',
    'address',
    'university',
    'telephone_number',
    'fax_number',
    'is_offered',
    'status_id',
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'deleted_by',
    'updated_at',
    'deleted_at',
  ];

  /**************************************************************************************
    Select Box
  **************************************************************************************/
  public function selectBox(){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->select(
                    $this->table . '.campus_id AS campus_id',
                    $this->table . '.name AS campus_name',
                    $this->table . '.status_id AS status_id',
                    'status.name AS status_name'
                )
                ->leftJoin('status', 'status.status_id', '=', $this->table . '.status_id')
                ->where('status.table', '=', 'campus')
                ->where('status.name', '=', 'active')
                ->orderByRaw("CASE WHEN ".$this->table.".name LIKE 'Kuala Lumpur%' THEN 0 ELSE 1 END, ".$this->table.".name ASC")
                ->get()
                ->toArray();





    //Return Result
    return $result;

  }

  /**************************************************************************************
    Get List
  **************************************************************************************/
  public function getList(){

    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                  $this->table.'.campus_id AS campus_id',
                  $this->table.'.name AS campus_name',
                  $this->table.'.status_id AS status_id',
                  'status.name AS status_name'
                  )
                ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                ->where('status.table','campus')
                ->where('status.name','active')
                ->get();
// dd($result);
    //Get Result
    return $result;

  }

  /**************************************************************************************
  Check Duplicates Ajax
  **************************************************************************************/
  public function getCampusSemester($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                              ->select(
                                                $this->table.'.campus_id AS campus_id',
                                                'semester.semester_id AS semester_id',
                                                'semester.name AS semester_name'
                                                )
                                               ->leftJoin('semester','semester.campus_id','=',$this->table.'.campus_id')
                                               ->leftJoin('status','status.status_id','=','semester.status_id')
                                               ->where('status.table','semester')
                                               ->where('status.name','active')
                                               ->where($this->table.'.campus_id',$data['column']['campus_id']);

    //Get Result
    $result = $result->get();

    //Return Result
    return $result;

  }


}
