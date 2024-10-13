<?php

namespace app\Models\UCSI_V2_General\MSSQL\View;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Model Setting
use App\Models\UCSI_V2_General\MSSQL\View\Setting;

//Get Class
class AcademicIndexingBody extends Model{

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
  protected $table = '';

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
  public function selectBox($data = null){

    //Set Table
    $table = 'selectbox_academic_indexing_body';

    //Get Query
    $result = DB::connection($this->connection)
            ->table($table)
            ->where($table.'.status_name','active');


    $result = $result->get()
                     ->toarray();
// dd($result);
    //Return Result
    return $result;


  }


}
