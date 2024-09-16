<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Table;

//Get Database
use DB;

//Get Model
use App\Models\UCSI_V2_General\MSSQL\Table\Setting;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class SemesterGroup extends Model{

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
  protected $table = 'semester_group';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'semester_group_id';

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
    'semester_group_id',
    'name',
    'effective_semester',
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

  //Table Neighbor
  protected $table_neighbor = [
    'general'=>[
      'user'=>'dbo',
      'database'=>'ucsi_v2_general'
    ]
  ];

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
    Get Last ID
  **************************************************************************************/
  public function getLastID(){

    //Get Result
    $result = DB::connection($this->connection)->table($this->table)->select(
                        $this->table.'.semester_group_id AS semester_group_id'
                      )
                     ->orderBy('semester_group_id', 'desc')
                     ->first();

    return $result;
  }

  /**************************************************************************************
    Check Exist
  **************************************************************************************/
  public function checkExist($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.semester_group_id AS semester_group_id',
                                                  $this->table.'.status_id AS status_id',
                                                  'status.name AS status_name',
                                                 )
                                               ->leftJoin('status AS status',
                                                  function($join){
                                                   $join->on('status.status_id',$this->table.'.status_id');
                                                   $join->where('status.table','semester_group');
                                                  }
                                                );

    //Filter Data
    if(isset($data['column']['semester_group_id']) && $data['column']['semester_group_id'] != null){$result = $result->where($this->table.'.semester_group_id',$data['column']['semester_group_id']);}

    //Check Type For Soft and Hard Delete
    if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where('status.name','deleted');}

    //Get Count Result
    $result = $result->count();

    //Return Result
    return $result;

  }


  /**************************************************************************************
    Select Box
  **************************************************************************************/
  public function selectBox(){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result ->select(
                        $this->table.'.semester_group_id AS semester_group_id',
                        $this->table.'.name AS semester_group_name',
                        $this->table.'.status_id AS status_id',
                        'status.name AS status_name'
                      )
                     ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                     ->where('status.table','semester_group')
                     ->where('status.name','active')
                     ->get()
                     ->toarray();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Get List
  **************************************************************************************/
  public function getList($data){
// dd($this->connection);
    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.semester_group_id AS semester_group_id',
                    $this->table.'.name AS semester_group_name',
                    $this->table.'.status_id AS status_id',
                    'status.name AS status_name'
                  )
                ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                ->where('status.table','semester_group');
                // ->where('status.name','active');

      //Check Data Type
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

                //Filter Search
                $query->where($this->table.'.name','LIKE','%'.$search.'%');

              });

            }

            //Filter Query
            if(isset($data['column']['status_id']) && $data['column']['status_id'] != null){$result = $result->where('status.status_id',$data['column']['status_id']);}
            // if(isset($data['column']['campus_id']) && $data['column']['campus_id'] != null){$result = $result->where('campus.campus_id',$data['column']['campus_id']);}

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

      }

      //Check Eloquent if Paginate
      if(isset($data['eloquent']) && $data['eloquent'] == 'pagination'){

        if(isset($data['pagination']['size'])){
          $this->default['pagination']['size'] = $data['pagination']['size'];
        }

        //Get Paginate
        $result = $result->paginate($this->getPagination());

      }

      //Eloquent if Get ALl Data
      else{

        //Get All Data
        $result = $result->get();

      }

    //Get Result
    return $result;

  }

  /**************************************************************************************
    Select Box Ajax
  **************************************************************************************/
  public function selectBoxAjax(){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result ->select(
                        $this->table.'.campus_id AS campus_id',
                        $this->table.'.semester_group_id AS semester_group_id',
                        $this->table.'.name AS semester_group_name',
                        $this->table.'.status_id AS status_id',
                        'status.name AS status_name',
                        'campus.name AS campus_name'

                      )
                     ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                     ->join('campus','campus.campus_id','=',$this->table.'.campus_id')
                     ->where('status.table','campus_id')
                     ->where('status.name','active');

       if(isset($data['column']['campus_id']) && $data['column']['campus_id'] != null){$result = $result->where($this->table.'.campus_id',$data['column']['campus_id']);}


       $result = $result->get()
                        ->toarray();

    //Return Result
    return $result;

  }


}
