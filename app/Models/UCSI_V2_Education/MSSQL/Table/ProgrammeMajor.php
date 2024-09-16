<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class ProgrammeMajor extends Model{

  /**
   * The database connection that should be used by the model.
   *
   * @var string
   */
  protected $connection = 'sqlsrv_ucsi_v2_education';

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'programme_major';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'programme_id';

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
    'programme_id',
    'programme_major_id',
    'name',
    'status_id',
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'deleted_by',
    'updated_at',
    'deleted_at',
  ];

  /**************************************************************************************
    Select Box
  **************************************************************************************/
  public function selectBox(){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result ->select(
                        $this->table.'.programme_id AS programme_id',
                        $this->table.'.programme_major_id AS programme_major_id',
                        $this->table.'.name AS programme_name',
                        $this->table.'.status_id AS status_id',
                        'status.name AS status_name'
                      )
                     ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                     ->where('status.table','programme_major')
                     ->where('status.name','active')
                     ->get()
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
                    $this->table.'.programme_id AS programme_id',
                    $this->table.'.name AS programme_name',
                    $this->table.'.status_id AS status_id',
                    'status.name AS status_name'
                  )
                ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                ->where('status.table','programme')
                ->where('status.name','active')
                ->get();
// dd($result);
    //Get Result
    return $result;

  }

  /**************************************************************************************
  Check Duplicates Ajax
  **************************************************************************************/
  public function getProgrammeMajorAjax($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                              ->select(
                                                $this->table.'.programme_id AS programme_id',
                                                $this->table.'.programme_major_id AS programme_major_id',
                                                $this->table.'.name AS programme_major_name',
                                                )
                                               ->leftJoin('programme','programme.programme_major_id','=',$this->table.'.programme_major_id')
                                               ->where('programme.programme_id',$data['column']['programme_id']);

    //Get Result
    $result = $result->first();

    //Return Result
    return $result;

  }

}
