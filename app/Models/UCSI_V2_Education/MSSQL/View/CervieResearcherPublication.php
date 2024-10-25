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
class CervieResearcherPublication extends Model{

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
    $this->table = 'list_cervie_researcher_publication';

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->where($this->table.'.employee_id',$data['column']['employee_id']);

    //Filter Query
    if(isset($data['column']['publication_type_id']) && $data['column']['publication_type_id'] != null){$result = $result->where($this->table.'.publication_type_id',$data['column']['publication_type_id']);}

    if(isset($data['type'])){

     //Get Type
     switch($data['type']){

       //Get Type
       case 'filter':
       case 'search':
       case 'sort':

       // dd($data['column']['order']);

         //Search Query
         if(isset($data['column']['search'])){

           //Set Search
           $search = $data['column']['search'];

           //Get Filter Search
           $result = $result->where(function($query) use ($search){
// dd(2);
             //Filter Search
             $query->where($this->table.'.name','LIKE','%'.$search.'%');
             $query->orWhere($this->table.'.title','LIKE','%'.$search.'%');
             // $query->orWhere($this->table.'.employee_id','LIKE','%'.$search.'%');

           });

         }

         //Filter Query
         if(isset($data['column']['need_verification']) && $data['column']['need_verification'] != null){$result = $result->where('need_verification',$data['column']['need_verification']);}
         // if(isset($data['column']['employee_status_id']) && $data['column']['employee_status_id'] != null){$result = $result->where('status_employee_id',$data['column']['employee_status_id']);}

         //Sort Query
         if((isset($data['column']['order']['ordercolumn']) && $data['column']['order']['ordercolumn'] != null) && (isset($data['column']['order']['orderby']) && $data['column']['order']['orderby'] != null)){
           $result = $result->orderBy($data['column']['order']['ordercolumn'],$data['column']['order']['orderby']);
         }

       break;

       //If Failed
       default:

         //Return Failed
         abort(404);

       break;

     }
    // dd(32);
    }

    //Check Type For Soft and Hard Delete
    if(isset($data['eloquent']) != null && $data['eloquent'] == 'pagination'){

      //Get Result
      $result = $result->paginate(
        $perPage = $this->getPagination(['manual'=>true]),
        $columns = ['*'],
        $pageName = 'publication'
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
