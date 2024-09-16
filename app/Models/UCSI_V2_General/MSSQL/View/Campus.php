<?php

namespace app\Models\UCSI_V2_General\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class Campus extends Model{

  /**
   * The database connection that should be used by the model.
   *
   * @var string
   */
  protected $connection = 'sqlsrv';

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'iis_campus';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'CampusID';

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
    Get List
  **************************************************************************************/
  public function getList(){
// dd($this->connection);
    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)

                ->get();
dd($result);
    //Get Result
    return $result;

  }

}
