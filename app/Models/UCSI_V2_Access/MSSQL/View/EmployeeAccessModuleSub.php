<?php

//Get Model Path
namespace App\Models\UCSI_V2_Access\MSSQL\View;

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
  protected $connection = 'sqlsrv_ucsi_v2_access';

  //Set Table
  protected $table = null;

  /**************************************************************************************
    Get Employee Access Module Sub
  **************************************************************************************/
  public function getEmployeeAccessModuleSub($data){
// dd($data);
    //Set Table
    $this->table = 'get_employee_access_module_sub';

    //Get Result
    $result = DB::connection($this->connection)->table($this->table)
                                               ->where($this->table.'.employee_id',$data['column']['employee_id']);
                                               // ->whereNot($this->table.'.employee_id','Home');

    //Filter Query
    // if(isset($data['column']['module_id']) && $data['column']['module_id'] != null){$result = $result->where($this->table.'.module_id', $data['column']['module_id']);}
    if(isset($data['column']['domain_url']) && $data['column']['domain_url'] != null){$result = $result->where($this->table.'.domain_url', $data['column']['domain_url']);}
    if(isset($data['column']['module_sub_path']) && $data['column']['module_sub_path'] != null){$result = $result->where($this->table.'.module_sub_path', $data['column']['module_sub_path']);}
    if(isset($data['column']['except']) && $data['column']['except'] != null){$result = $result->whereNot($this->table.'.module_sub_name', $data['column']['except']);}

    //Sort Order
    $result = $result->orderBy($this->table.'.module_sub_ordering','ASC');

    //Get Result
    $result = $result->get();

    //Return Result
    return $result;

  }

}
