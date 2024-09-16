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
class NavigationCategory extends Model{

  // Use Audit
  // use \OwenIt\Auditing\Auditable;

  //Use Notify
  use Notifiable;

  //Table connection
  protected $connection = 'sqlsrv_ucsi_v2_access';

  //Set Table
  protected $table = null;

  /**************************************************************************************
    Get Employee Access Module
  **************************************************************************************/
  public function getNavigationAccessModule($data){

    //Set Table
    $this->table = 'list_navigation_category';

    //Get Result
    $result = DB::connection($this->connection)->table($this->table)
                                               ->where($this->table.'.domain_url',$data['column']['domain_url']);

   //Filter Query
   // if(isset($data['column']['module_company_id']) && $data['column']['module_company_id'] != null){$result = $result->where($this->table.'.module_company_id', $data['column']['module_company_id']);}
   // if(isset($data['column']['employee_id']) && $data['column']['employee_id'] != null){$result = $result->where($this->table.'.employee_id', $data['column']['employee_id']);}
dd($result);
   //Get Result
   $result = $result->get();
// dd($result);
    //Return Result
    return $result;

  }

}
