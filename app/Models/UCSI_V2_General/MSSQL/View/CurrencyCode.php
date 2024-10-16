<?php

namespace app\Models\UCSI_V2_General\MSSQL\View;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Model Setting
use App\Models\UCSI_V2_General\MSSQL\View\Setting;

//Get Class
class CurrencyCode extends Model{

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
    $table = 'selectbox_currency_code';

    //Get Query
    $result = DB::connection($this->connection)
            ->table($table)
            ->where($table.'.status_name','active');


    $result = $result->get()
                     ->toarray();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Check Exist
  **************************************************************************************/
  public function checkExist($data){

    //Set Table
    $this->table = 'check_currency_code';

    //Get Query
    $this->query ='DECLARE @exist BIT;
             EXEC '.$this->table.' ?, @exist OUTPUT;
             SELECT @exist AS exist;';

    // Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['currency_code_id'],
      ]
    );

    //Process Result
    if(!empty($result)){

      //Check Exist
      $exist = $result[0]->exist ?? 0;

      //Return Boolean
      return (bool)$exist;

    }

    //Get False
    return false;

  }

}
