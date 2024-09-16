<?php

//Get Model Path
namespace App\Models\UCSI_V2_Main\MSSQL\Table;

//Get Audit
// use OwenIt\Auditing\Contracts\Auditable;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Eloquent
use Illuminate\Database\Eloquent\Model;

//Get Notifiable
use Illuminate\Notifications\Notifiable;

//Get Class
class EmployeeContact extends Model{

  // Use Audit
  // use \OwenIt\Auditing\Auditable;

  //Use Notify
  use Notifiable;

  //Table connection
  protected $connection = 'sqlsrv_ucsi_v2_main';

  //Table Name
  protected $table = 'employee_contact';

  //Set Incrementing
  public $incrementing = false;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'employee_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'contact_category_id',
    'name',
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at',
    'deleted_by',
    'deleted_at',
    'employee_id',
  ];

  /**************************************************************************************
    Select Box
  **************************************************************************************/
  public function selectBox($data=null){

    //Get Query Selection
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                 $this->table.'.employee_id AS employee_id',
                                                 $this->table.'.contact_category_id AS contact_category_id',
                                                 $this->table.'.name AS name'
                                               );

    //Filter Query
    if(isset($data['column']['day_id']) && $data['column']['day_id'] != null){$result = $result->where($this->table.'.day_id', $data['column']['day_id']);}

    //Check Is Admin
    if(!Auth::user()->isAdmin()){$result = $result->where($this->table.'.status','!=','deleted');}

    $result = $result->get()
                     ->toarray();

    //Return Result
    return $result;


  }

  /**************************************************************************************
    Get List
  **************************************************************************************/
  public function getList($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.employee_id AS employee_id',
                                                  $this->table.'.contact_category_id AS contact_category_id',
                                                  $this->table.'.name AS name'
                                                );

    //Filter Query
    if(isset($data['column']['employee_id']) && $data['column']['employee_id'] != null){$result = $result->where($this->table.'.employee_id',$data['column']['employee_id']);}

    //Check Data Type
    if(isset($data['type'])){

      //Get Type
      switch($data['type']){

        //Get Type
        case 'filter':
        case 'search':
        case 'sort':

        // dd($data['column']['order']);

          //Search Query
          if(isset($data['column']['search'])){

            //Set Search
            $search = $data['column']['search'];

            //Get Filter Search
            $result = $result->where(function($query) use ($search){

              //Filter Search
              $query->where($this->table.'.name','LIKE','%'.$search.'%');

            });

          }

          //Filter Query
          if(isset($data['column']['name']) && $data['column']['name'] != null){$result = $result->where($this->table.'.name',$data['column']['name']);}

          //Sort Query
          if((isset($data['column']['order']['ordercolumn']) && $data['column']['order']['ordercolumn'] != null) && (isset($data['column']['order']['orderby']) && $data['column']['order']['orderby'] != null)){
            $result = $result->orderBy($data['column']['order']['ordercolumn'],$data['column']['order']['orderby']);
          }

        break;

        //If Failed
        default:

          //Return Failed
          abort(404);

        break;

      }

    }
// dd((isset($data['pagination']) && $data['pagination'] != null));
    if(isset($data['pagination']) && $data['pagination'] != null){

      //Get Paginate
      $result = $result->paginate($data['pagination']['paging']);

    }else{

      //Get Result
      $result =  $result->get();

    }

    //Return Result
    return $result;

  }

  /**************************************************************************************
    View Selected
  **************************************************************************************/
  public function viewSelected($data){

    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.employee_id AS employee_id',
                    $this->table.'.contact_category_id AS contact_category_id',
                    $this->table.'.name AS name'
                  )
                ->where($this->table.'.employee_id',$data['column']['employee_id'])
                ->where($this->table.'.contact_category_id',$data['column']['contact_category_id'])
                ->first();

    //Get Result
    return $result;

  }

  /**************************************************************************************
    Check Exist
  **************************************************************************************/
  public function checkExist($data){
// dd($this->table.'.employee_id');
    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select($this->table.'.employee_id')
                                               ->where($this->table.'.employee_id',$data['column']['employee_id']);

    //Filter Query
    if(isset($data['column']['contact_category_id']) && $data['column']['contact_category_id'] != null){$result = $result->where($this->table.'.contact_category_id',$data['column']['contact_category_id']);}

    //Check Type For Soft and Hard Delete
    if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where($this->table.'.status','deleted');}


    //Get Count Result
    $result = $result->count();

    //Return Result
    return $result;

  }

}
