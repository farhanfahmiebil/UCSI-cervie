<?php

namespace app\Models\UCSI_V2_Education\MSSQL\View;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Model Setting
use App\Models\UCSI_V2_General\MSSQL\View\Setting;

//Get Class
class CervieResearcherAward extends Model{

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
    $this->table = 'list_cervie_researcher_award';

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->where($this->table.'.employee_id',$data['column']['employee_id']);
// dd($this->table);
    //Filter Query
    if(isset($data['column']['representation_category_id']) && $data['column']['representation_category_id'] != null){$result = $result->where($this->table.'.representation_category_id',$data['column']['representation_category_id']);}


    //Check Type For Soft and Hard Delete
    if(isset($data['eloquent']) != null && $data['eloquent'] == 'pagination'){

      //Get Result
      $result = $result->paginate(
        $perPage = $this->getPagination(),
        $columns = ['*'],
        $pageName = 'award'
      );


    }else{

      //Get Result
      $result = $result->get();

    }

    //Return Result
    return $result;

  }

}
