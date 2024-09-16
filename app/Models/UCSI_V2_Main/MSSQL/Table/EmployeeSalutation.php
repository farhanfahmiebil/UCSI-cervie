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

//Get Class
class EmployeeSalutation extends Model{

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
  protected $table = 'employee_salutation';

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
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at',
    'deleted_by',
    'deleted_at',
    'ordering',
    'salutation_id',
    'employee_id'
  ];

  //Table Neighbor
  protected $table_neighbor = [
    'general'=>[
      'user'=>'dbo',
      'table'=>'salutation',
      'database'=>'ucsi_v2_general'
    ]
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
  public function getSalutation($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                 $this->table.'.employee_id',
                                                 $this->table.'.salutation_id',
                                                 $this->table.'.ordering',
                                                 'salutation.name as salutation_name'
                                                )
                                               ->join($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.salutation AS salutation','salutation.salutation_id','=',$this->table.'.salutation_id')
                                               ->where($this->table.'.employee_id',$data['column']['employee_id'])
                                               ->orderBy($this->table.'.ordering','ASC');

    //Check Type For Soft and Hard Delete
    // if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where($this->table.'.status','deleted');}

    //Get Count Result
    $result = $result->get();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Check Exist
  **************************************************************************************/
  public function checkExist($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                 $this->table.'.employee_id',
                                                 $this->table.'.salutation_id'
                                                )
                                               ->where($this->table.'.employee_id',$data['column']['employee_id']);

    //Check Type For Soft and Hard Delete
    if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where($this->table.'.status','deleted');}

    //Get Count Result
    $result = $result->count();

    //Return Result
    return $result;

  }

}