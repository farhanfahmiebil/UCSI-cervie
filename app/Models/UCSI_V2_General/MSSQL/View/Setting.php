<?php

namespace App\Models\UCSI_V2_General\MSSQL\View;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class Setting extends Model{

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
  protected $table;

  //Set Default
  public $default = [
    'pagination'=>[
      'size'=>10
    ]
  ];

  /*  Get Pagination
  **************************************************************************************/
  public function getPagination(){

    //Set Table
    $this->table = 'view_setting';

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->where($this->table.'.setting_id','PAGINATION')
                                               ->where($this->table.'.status_name','active')
                                               ->first();
    //Return Result
    return (($result)?(int)$result->value:$this->default['pagination']['size']);

  }

}
