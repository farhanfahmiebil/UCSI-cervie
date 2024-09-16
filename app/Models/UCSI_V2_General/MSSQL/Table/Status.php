<?php

namespace app\Models\UCSI_V2_General\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class Status extends Model{

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
  protected $table = 'status';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'status_id';

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
    'setting_id',
    'name',
    'value',
    'remark_user',
    'remark',
    'created_by',
    'updated_by',
    'deleted_by',
    'created_at',
    'updated_at',
    'deleted_at',
    'status_id'
  ];

  //Set Default
  public $default = [
    'pagination'=>[
      'size'=>10
    ]
  ];

  /**************************************************************************************
    Select Box
  **************************************************************************************/
  public function getPagination(){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select($this->table.'.value AS value')
                                               ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                                               ->where($this->table.'.setting_id','PAGINATION')
                                               ->where('status.name','active')
                                               ->first();
    //Return Result
    return (($result)?(int)$result->value:$this->default['pagination']['size']);

  }

}
