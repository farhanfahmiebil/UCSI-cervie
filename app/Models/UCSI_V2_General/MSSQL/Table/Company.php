<?php

namespace app\Models\UCSI_V2_General\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class Company extends Model{

  /**
   * The database connection that should be used by the model.
   *
   * @var string
   */
  protected $connection = 'sqlsrv_ucsi_v2_general';

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'company';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'company_id';

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
    'company_id',
    'name',
    'registration_no',
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'deleted_by',
    'updated_at',
    'deleted_at',
    'status_id',
    'company_name',
    'gst_no',
    'company_no'
  ];

  /**************************************************************************************
    Select Box
  **************************************************************************************/
  public function selectBox(){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result->get()
                     ->toarray();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Get List
  **************************************************************************************/
  public function getList(){
// dd($this->connection);
    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.company_id AS company_id',
                    $this->table.'.company_name AS company_name',
                    $this->table.'.name AS name',
                    $this->table.'.company_no AS company_no',
                    $this->table.'.registration_no AS registration_no',
                    $this->table.'.status_id AS status_id',
                    'status.name AS status_name'
                  )
                ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                ->where('status.table','company')
                ->where('status.name','active')
                ->get();
// dd($result);
    //Get Result
    return $result;

  }

}
