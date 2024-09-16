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

//Get Model
use App\Models\UCSI_V2_General\MSSQL\Table\Setting;

//Get Notifiable
use Illuminate\Notifications\Notifiable;

//Get Class
class EmployeeProfile extends Model{

  // Use Audit
  // use \OwenIt\Auditing\Auditable;

  //Use Notify
  use Notifiable;

  //Table connection
  protected $connection = 'sqlsrv_ucsi_v2_main';

  //Table Name
  protected $table = 'employee_profile';

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
    'nickname',
    'full_name',
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at',
    'deleted_by',
    'deleted_at',
    'middle_name',
    'last_name',
    'first_name',
    'employee_id',
    'image',
    'status_id'
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

  /**************************************************************************************
    Get Pagination
  **************************************************************************************/
  public function getPagination($data = null){

    $model['setting'] = new Setting();

    if(isset($data['manual']) && $data['manual'] != false){
      return $this->default['pagination']['size'];
    }

    return $model['setting']->getPagination();

  }

  /**************************************************************************************
    Select Box
  **************************************************************************************/
  public function selectBox($data=null){

    //Get Query Selection
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                 $this->table.'.employee_id AS employee_id',
                                                 $this->table.'.full_name AS full_name'
                                               );

    //Filter Query
    if(isset($data['column']['day_id']) && $data['column']['day_id'] != null){$result = $result->where($this->table.'.day_id', $data['column']['day_id']);}

    //Check Is Admin
    // if(!Auth::user()->isAdmin()){$result = $result->where($this->table.'.status','!=','deleted');}

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
                                               ->distinct()
                                               ->select(
                                                  $this->table.'.first_name AS first_name',
                                                  $this->table.'.last_name AS last_name',
                                                  $this->table.'.full_name AS full_name',
                                                  $this->table.'.employee_id AS employee_id',

                                                  // 'employee.email AS email',
                                                  // 'employee_contact.name AS contact_no',
                                                  // 'employee_position.position AS position',
                                                  // DB::raw("
                                                  //     (
                                                  //         SELECT
                                                  //             STUFF((
                                                  //                 SELECT ';' + employee_position.position
                                                  //                 FROM employee_position
                                                  //                 WHERE employee_position.employee_id = employee_profile.employee_id
                                                  //                 FOR XML PATH(''), TYPE
                                                  //             ).value('.', 'NVARCHAR(MAX)'), 1, 1, '')
                                                  //     ) AS position
                                                  // "),
                                                  DB::raw('
                                                    (
                                                        SELECT
                                                            STUFF((
                                                                SELECT \';\' + employee_position.position
                                                                FROM employee_position
                                                                WHERE employee_position.employee_id = employee_profile.employee_id
                                                                FOR XML PATH(\'\'), TYPE
                                                            ).value(\'.\', \'NVARCHAR(MAX)\'), 1, 1, \'\')
                                                    ) AS position
                                                 '),
                                                  'employee_position.department AS department',

                                                  'employee_contact_office_telephone_number.name AS office_telephone_number',
                                                  'employee_contact_office_telephone_extension_number.name AS office_telephone_extension_number',
                                                  'employee_contact_office_internal_email.name AS office_internal_email',
                                                  'employee_contact_office_external_email.name AS office_external_email',

                                                  'status_employee.status_id AS status_employee_id',
                                                  'status_employee.name AS status_employee_name',

                                                  'status_employee_ldap.status_id AS status_employee_ldap_id',
                                                  'status_employee_ldap.name AS status_employee_ldap_name'

                                                  )
                                                // ->leftJoin($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.status AS status','status.status_id','=',$this->table.'.remark')
                                               // ->leftJoin('status','status.status_id','=','status.status_id')

                                               ->leftJoin('employee_ldap','employee_ldap.employee_id','=',$this->table.'.employee_id')
                                               ->leftJoin('employee','employee.employee_id','=',$this->table.'.employee_id')

                                               ->leftJoin('status AS status_employee',
                                                  function($join){
                                                    $join->on('status_employee.status_id','=','employee.status_id');
                                                    $join->where('status_employee.table','employee');
                                                   }
                                               )

                                               ->leftJoin('status AS status_employee_ldap',
                                                  function($join){
                                                    $join->on('status_employee_ldap.status_id','=','employee_ldap.status_id');
                                                    $join->where('status_employee_ldap.table','employee_ldap');
                                                   }
                                               )

                                               // ->leftJoin('employee_contact_office_internal_email','employee_contact.employee_id','=',$this->table.'.employee_id')
                                               ->leftJoin('employee_contact AS employee_contact_office_telephone_number',
                                                  function($join){
                                                    $join->on('employee_contact_office_telephone_number.employee_id',$this->table.'.employee_id');
                                                    $join->where('employee_contact_office_telephone_number.contact_category_id',2);
                                                   }
                                               )

                                               ->leftJoin('employee_contact AS employee_contact_office_telephone_extension_number',
                                                  function($join){
                                                   $join->on('employee_contact_office_telephone_extension_number.employee_id',$this->table.'.employee_id');
                                                   $join->where('employee_contact_office_telephone_extension_number.contact_category_id',3);
                                                  }
                                                )

                                               ->leftJoin('employee_contact AS employee_contact_office_internal_email',
                                                  function($join){
                                                   $join->on('employee_contact_office_internal_email.employee_id',$this->table.'.employee_id');
                                                   $join->where('employee_contact_office_internal_email.contact_category_id',12);
                                                  }
                                                )

                                                ->leftJoin('employee_contact AS employee_contact_office_external_email',
                                                   function($join){
                                                    $join->on('employee_contact_office_external_email.employee_id',$this->table.'.employee_id');
                                                    $join->where('employee_contact_office_external_email.contact_category_id',13);
                                                   }
                                                 )

                                                ->leftJoin('employee_position','employee_position.employee_id','=',$this->table.'.employee_id')
                                                ->whereNot('employee_ldap.employee_id','DEVELOPER');
                                                // ->whereNot('employee_ldap.employee_id',Auth::id());



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
              $query->where($this->table.'.full_name','LIKE','%'.$search.'%');
              $query->orWhere($this->table.'.employee_id','LIKE','%'.$search.'%');

            });

          }

          //Filter Query
          if(isset($data['column']['employee_ldap_status_id']) && $data['column']['employee_ldap_status_id'] != null){$result = $result->where('status_employee_ldap.status_id',$data['column']['employee_ldap_status_id']);}
          if(isset($data['column']['employee_status_id']) && $data['column']['employee_status_id'] != null){$result = $result->where('status_employee.status_id',$data['column']['employee_status_id']);}

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
     // dd($result->get());
     // print_r($result->tosql());exit();
    // dd($result->tosql());
// dd($data['pagination']['size']);
    //Check Eloquent if Paginate
    if(isset($data['eloquent']) && $data['eloquent'] == 'pagination'){

      if(isset($data['pagination']['size'])){
        $this->default['pagination']['size'] = $data['pagination']['size'];
      }
// dd($this->getPagination(['manual'=>true]));
      //Get Paginate
      // $result = $result->paginate($this->getPagination(['manual'=>true]));
      $result = $result->paginate($this->getPagination());

    }

    //Eloquent if Get ALl Data
    else{
// dd(1);
      //Get All Data
      $result = $result->get();

    }

// dd();
    // dd($result);

    //Return Result
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

    //Check Type For Soft and Hard Delete
    if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where($this->table.'.status','deleted');}

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
                                                 $this->table.'.first_name AS first_name',
                                                 $this->table.'.last_name AS last_name',
                                                 $this->table.'.full_name AS full_name',
                                                 $this->table.'.employee_id AS employee_id',
                                                 $this->table.'.nickname AS nickname',

                                                 'employee.email AS email',
                                                 'employee_contact.name AS contact_no',
                                                 'employee_position.name AS job_title',
                                                 'employee_position.department AS department',

                                               )
                                               ->join('employee','employee.employee_id','=',  $this->table.'.employee_id')
                                               ->leftJoin('employee_contact','employee_contact.employee_id','=',  $this->table.'.employee_id')
                                               ->join('employee_position','employee_position.employee_id','=',  $this->table.'.employee_id')
                                               ->where('employee.employee_id','=','41503');

    //Get Count Result
    $result = $result->first();

    //Return Result
    return $result;

  }

}
