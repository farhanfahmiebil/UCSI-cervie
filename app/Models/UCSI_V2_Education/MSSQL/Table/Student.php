<?php

namespace App\Models\UCSI_V2_Education\MSSQL\Table;

//Get Audit
// use OwenIt\Auditing\Contracts\Auditable;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Eloquent
use Illuminate\Database\Eloquent\Model;

//Get Class
class Student extends Model{

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
  protected $table = 'student';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'student_id';

  /**
   * Indicates if the model's ID is auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;

  /**
   * Indicates if the model's ID is timestamp.
   *
   * @var bool
   */
  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'student_id',
    'email',
    'password',
    'student_status_id',
    'student_entry_status',
    'online_status',
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at',
    'deleted_by',
    'deleted_at',
    'personal_email',
  ];

  #######################################################################################
  # Foreign Key
  #######################################################################################

  /**************************************************************************************
    Profile
  **************************************************************************************/
  public function profile(){
    return $this->hasOne('App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeProfile','employee_id','employee_id');
  }

  /**************************************************************************************
    Status
  **************************************************************************************/
  public function status(){
    return $this->hasOne('App\Models\UCSI_V2_Main\MSSQL\Table\Status','status_id','status_id');
  }

  #######################################################################################
  # End Foreign Key
  #######################################################################################

  /**************************************************************************************
    Check Exist
  **************************************************************************************/
  public function checkExist($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select($this->table.'.employee_id')
                                               ->where($this->table.'.employee_id',$data['column']['employee_id']);

    //Check Type For Soft and Hard Delete
    if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where($this->table.'.status','deleted');}

    //Get Count Result
    $result = $result->count();

    //Return Result
    return $result;

  }

}
