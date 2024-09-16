<?php

//Get Model Path
namespace App\Models\UCSI_V2_Access\MSSQL\Table;

//Get Audit
// use OwenIt\Auditing\Contracts\Auditable;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Eloquent
use Illuminate\Database\Eloquent\Model;

//Get Model
use App\Models\UCSI_V2_General\MSSQL\Table\Setting;

//Get Notifiable
use Illuminate\Notifications\Notifiable;

//Get Class
class EmployeeAccessModuleSub extends Model{

  // Use Audit
  // use \OwenIt\Auditing\Auditable;

  //Use Notify
  use Notifiable;

  //Table connection
  protected $connection = 'sqlsrv_ucsi_v2_main';

  //Table Name
  protected $table = 'employee_access_module_sub';

  //Set Incrementing
  public $incrementing = false;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'module_sub_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'employee_id',
    'remark',
    'created_by',
    'updated_by',
    'deleted_by',
    'status_id',
    'created_at',
    'updated_at',
    'deleted_at',
    'module_id',
    'module_sub_id'
  ];

  //Table Neighbor
  protected $table_neighbor = [
    'general'=>[
      'user'=>'dbo',
      'database'=>'ucsi_v2_general'
    ]
  ];

  //Set Default
  public $default = [
    'pagination'=>[
      'size'=>10
    ]
  ];

// public function test(){return 32;}

/**************************************************************************************
  Get Navigation Access Module
**************************************************************************************/
public function getNavigationAccess($data){

  //Get Query
  $result = DB::connection($this->connection)->table($this->table)
                                             ->select(
                                                $this->table.'.module_id AS module_id',
                                                $this->table.'.module_sub_id AS module_sub_id',
                                                'module.name AS module_name',
                                                'module.path AS module_path',
                                                'status_module.name AS module_status_name',
                                                'module_sub.name AS module_sub_name',
                                                'module_sub.path AS module_sub_path',
                                                'module_sub.hyperlink AS module_sub_hyperlink',
                                                'status_module_sub.name AS module_sub_status_name',
                                                'employee_access_module.status_id AS employee_access_module_status_id',
                                                'status_employee_access_module.name AS employee_access_module_status_name',
                                                'status_'.$this->table.'.name AS '.$this->table.'_status_name',
                                                'employee.employee_id AS employee_id',
                                                'employee.status_id AS employee_status_id',
                                                'status_employee.name AS employee_status_name'
                                                )
                                             ->leftJoin('employee','employee.employee_id','=',$this->table.'.employee_id')
                                             ->leftJoin('module_sub','module_sub.module_sub_id','=',$this->table.'.module_sub_id')
                                             ->leftJoin('module','module.module_id','=','module_sub.module_id')
                                             ->leftJoin('employee_access_module',
                                                function($join){
                                                  $join->on('employee_access_module.module_id',$this->table.'.module_id');
                                                  $join->on('employee_access_module.employee_id',$this->table.'.employee_id');
                                                 }
                                             )
                                             ->leftJoin('status AS status_module',
                                                function($join){
                                                  $join->on('status_module.status_id','module.status_id');
                                                  $join->where('status_module.table','module');
                                                 }
                                             )
                                             ->leftJoin('status AS status_module_sub',
                                                function($join){
                                                  $join->on('status_module_sub.status_id','module_sub.status_id');
                                                  $join->where('status_module_sub.table','module_sub');
                                                 }
                                             )
                                             ->leftJoin('status AS status_employee_access_module',
                                                function($join){
                                                  $join->on('status_employee_access_module.status_id','employee_access_module.status_id');
                                                  $join->where('status_employee_access_module.table','employee_access_module');
                                                 }
                                             )
                                             ->leftJoin('status AS status_'.$this->table,
                                                function($join){
                                                  $join->on('status_'.$this->table.'.status_id',$this->table.'.status_id');
                                                  $join->where('status_'.$this->table.'.table',$this->table);
                                                 }
                                             )
                                             ->leftJoin('status AS status_employee',
                                                function($join){
                                                  $join->on('status_employee.status_id','employee.status_id');
                                                  $join->where('status_employee.table','employee');
                                                 }
                                             )
                                             ->where('status_module.name','active')
                                             ->where('status_module_sub.name','active')
                                             ->where('status_employee_access_module.name','active')
                                             ->where('status_'.$this->table.'.name','active')
                                             ->where('status_employee.name','active')
                                             ->where($this->table.'.employee_id',$data['column']['employee_id']);

  //Filter Query
  if(isset($data['column']['module_id']) && $data['column']['module_id'] != null){$result = $result->where($this->table.'.module_id', $data['column']['module_id']);}

  //Get Result
  // $result = $result->get();
print_r($result->tosql());exit();
// dd($result,$data);
  //Return Result
  return $result;

}


}
