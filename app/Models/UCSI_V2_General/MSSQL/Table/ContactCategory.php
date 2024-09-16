<?php

namespace app\Models\UCSI_V2_General\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class ContactCategory extends Model{

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
  protected $table = 'contact_category';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'contact_category_id';

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
    'status_id',
  ];

  /**************************************************************************************
    Get List
  **************************************************************************************/
  public function getList(){
// dd($this->connection);
    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.contact_category_id AS contact_category_id',
                    $this->table.'.name AS name',
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

  /**************************************************************************************
    View Selected
  **************************************************************************************/
  public function viewSelected($data){
// dd($this->connection);
    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.contact_category_id AS contact_category_id',
                    $this->table.'.name AS name',
                    $this->table.'.status_id AS status_id',
                    'status.name AS status_name'
                  )
                ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                ->where($this->table.'.contact_category_id',$data['column']['contact_category_id'])
                ->where('status.name','active')
                ->first();
// dd($result);
    //Get Result
    return (($result)?$result:null);

  }

}
