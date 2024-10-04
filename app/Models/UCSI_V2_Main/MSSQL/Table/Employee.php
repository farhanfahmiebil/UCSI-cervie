<?php

namespace App\Models\UCSI_V2_Main\MSSQL\Table;

//Get Audit
// use OwenIt\Auditing\Contracts\Auditable;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Eloquent
use Illuminate\Database\Eloquent\Model;

//Get Request
use Illuminate\Http\Request;

//Get Class
class Employee extends Model{

  /**
   * The database connection that should be used by the model.
   *
   * @var string
   */
  protected $connection = 'sqlsrv_ucsi_v2_main';

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'employee';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'employee_id';

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
    'email',
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at',
    'deleted_by',
    'deleted_at',
    'username',
    'password',
    'employee_id',
    'status_id'
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
    Salutation
  **************************************************************************************/
  public function salutation(){
    return $this->hasOne('App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeSalutation','employee_id','employee_id');
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

  /**************************************************************************************
    Is Editable
  **************************************************************************************/
  public function isEditable($employee_id){

    //Get Count
    $data = [41503, 41459, 41460, $employee_id];

    $check = in_array(Auth::id(),$data);

    //Return Result
    return (($check)?true:false);
;

  }

}
