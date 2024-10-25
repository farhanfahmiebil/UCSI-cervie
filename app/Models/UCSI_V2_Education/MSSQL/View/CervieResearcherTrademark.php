<?php

//Set Namespace
namespace app\Models\UCSI_V2_Education\MSSQL\View;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Model Setting
use App\Models\UCSI_V2_General\MSSQL\View\Setting;

//Get Class
class CervieResearcherTrademark extends Model{

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
  protected $table = '';

  //Set Default
  public $default = [
    'pagination'=>[
      'size'=>5
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
    Get List
  **************************************************************************************/
  public function getList($data){

    //Set Table
    $table = 'list_cervie_researcher_trademark';

    //Get Query
    $result = DB::connection($this->connection)->table($table)
                                               ->where($table.'.employee_id',$data['column']['employee_id']);

    //Check Type For Soft and Hard Delete
    if(isset($data['eloquent']) != null && $data['eloquent'] == 'pagination'){

      //Get Result
      $result = $result->paginate(
        $perPage = $this->getPagination(['manual'=>true]),
        $columns = ['*'],
        $pageName = 'copyright'
      );
// dd($result);
    }else{

      //Get Result
      $result = $result->get();

    }

    //Return Result
    return $result;

  }

}
