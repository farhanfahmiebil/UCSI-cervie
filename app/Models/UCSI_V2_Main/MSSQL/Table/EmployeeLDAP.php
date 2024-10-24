<?php

namespace App\Models\UCSI_V2_Main\MSSQL\Table;

//Get Authorization
use Auth;

//Get DB
use DB;

//Get Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;

//Get LDAP Record
// use LdapRecord\Models\Entry;
// use LdapRecord\Laravel\Auth\LdapAuthenticatable;
// use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
// use LdapRecord\Laravel\Auth\HasLdapUser;
// use LdapRecord\Models\Concerns\CanAuthenticate;
// use LdapRecord\Models\Model;

//Get Model
use App\Models\UCSI_V2_Education\MSSQL\Procedure\Researcher AS ResearcherProcedure;

//Get Storage
use Storage;

//Get Class
// class EmployeeLDAP extends Authenticatable implements LdapAuthenticatable{
class EmployeeLDAP extends Authenticatable{

  //Use AuthenticatesWithLdap
  // use  AuthenticatesWithLdap, HasLdapUser;

  /**
   * The database connection that should be used by the model.
   *
   * @var string
   */
  protected $connection = 'sqlsrv_ucsi_v2_main';

  /**
   * The database guid.
   *
   * @var string
   */
  // protected string $guidKey = 'uuid';

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'employee_ldap';

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
  public $timestamps = true;

  /**
   * The object class associated with the model.
   *
   * @var string
   */
  // public static $objectClasses = [
  //     'top',
  //     'domain',
  //     'domainDNS',
  //     'person',
  //     'organizationalperson',
  //     'user',
  // ];

  /**
   * The LDAP Domain Column
   *
   * @var string
   */
  // public function getLdapDomainColumn(): string{
  //   return 'domain';
  // }

  /**
   * The LDAP Guid Column
   *
   * @var string
   */
  // public function getLdapGuidColumn(): string{
  //   return 'guid';
  // }

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'employee_id',
    'email',
    'cn',
    'sn',
    'givenname',
    'displayname',
    'distinguishedname',
    'name',
    'samaccountname',
    'userprincipalname',
    'department',
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at',
    'deleted_by',
    'deleted_at',
    'guid',
    'domain',
    'title',
    'status_id'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
      'password',
  ];

  #######################################################################################
  # Foreign Key
  #######################################################################################


  /**************************************************************************************
    Relationship Wit Employee
  **************************************************************************************/
  public function employee(){
    return $this->hasOne('App\Models\UCSI_V2_Main\MSSQL\Table\Employee','employee_id','employee_id');
  }

  /**************************************************************************************
    Relationship With Employee User Access Module
  **************************************************************************************/
  public function employeeUserAccessModulePage(){
    return $this->hasMany('App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeUserAccessModulePage','employee_id','employee_id');
  }

  /**************************************************************************************
    Relationship With Employee Access Module
  **************************************************************************************/
  // public function accessModule(){
    // return $this->hasOne('App\Models\UCSI_V2_Main\MSSQL\Table\EmployeeAccessModuleUser','employee_id','employee_id');
  // }

  #######################################################################################
  # End Foreign Key
  #######################################################################################

  /**************************************************************************************
    Get Researcher
  **************************************************************************************/
  public static function getResearcher($id){

    //Set Model Researcher
    $model['researcher'] = new ResearcherProcedure();

    //Get Researcher
    $result = $model['researcher']->readRecord(
      [
        'column'=>[
          'employee_id'=>$id
        ]
      ]
    );

// dd($data);
    //Return Avatar Default URL
    return $result;

  }


  /**************************************************************************************
    Get Avatar
  **************************************************************************************/
  public static function getAvatar($data = null){

    //Set Path
    $path = [];

    //Set Avatar
    $avatar = 'images/avatar/anonymous.png';

    //Set ID
    $id = trim(Auth::id());

    //Set Path to File
    $path['file'] = 'public/resources/employee/'.$id.'/avatar/index.png';

    //Check Exist Storage File
    $check['exist']['storage'] = Storage::disk()->exists($path['file']);

    //If Exist
    if($check['exist']['storage']){

      //Get Avatar Storage URL
      $avatar = Storage::url($path['file']);

    }

    //Return Avatar Default URL
    return $avatar;

  }

  /**************************************************************************************
    Get Email
  **************************************************************************************/
  public function getEmail($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select($this->table.'.mail')
                                               ->where($this->table.'.employee_id',$data['column']['employee_id'])
                                               ->first();
// dd($result->mail);
    //Return Result
    return $result->mail;


  }

  /**************************************************************************************
    Check Exist
  **************************************************************************************/
  public function checkExist($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.employee_id AS employee_id',
                                                  $this->table.'.status_id AS status_id',
                                                  'status.name AS status_name',
                                                 )
                                               ->leftJoin('status AS status',
                                                  function($join){
                                                   $join->on('status.status_id',$this->table.'.status_id');
                                                   $join->where('status.table','employee_ldap');
                                                  }
                                                );

    //Filter Data
    if(isset($data['column']['employee_id']) && $data['column']['employee_id'] != null){$result = $result->where($this->table.'.employee_id',$data['column']['employee_id']);}
    if(isset($data['column']['username']) && $data['column']['username'] != null){$result = $result->where($this->table.'.username',$data['column']['username']);}

    //Check Type For Soft and Hard Delete
    if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where('status.name','deleted');}
    // echo '<pre>';
    // print_r($data);
    // echo '<pre>';
    // print_r($result->tosql());exit();
// dd($result->tosql());
    //Get Count Result
    $result = $result->count();
// dd($result);
    //Return Result
    return $result;

  }

}
