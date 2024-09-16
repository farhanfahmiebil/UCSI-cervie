<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Model
use App\Models\UCSI_V2_General\MSSQL\Table\Setting;

//Get Class
class Semester extends Model{

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
  protected $table = 'semester';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'semester_id';

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
    'semester_id',
    'campus_id',
    'semester_group_id',
    'name',
    'status_id',
    'start_date',
    'end_date',
    'year',
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
    Profile
  **************************************************************************************/
  public function getLastID(){

    //Get Result
    $result = DB::connection($this->connection)->table($this->table)->select(
                        $this->table.'.semester_id AS semester_id'
                      )
                     ->orderBy('semester_id', 'desc')
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
                                                  $this->table.'.semester_id AS semester_id',
                                                  $this->table.'.status_id AS status_id',
                                                  'status.name AS status_name',
                                                 )
                                               ->leftJoin('status AS status',
                                                  function($join){
                                                   $join->on('status.status_id',$this->table.'.status_id');
                                                   $join->where('status.table','semester');
                                                  }
                                                );

    //Filter Data
    if(isset($data['column']['semester_id']) && $data['column']['semester_id'] != null){$result = $result->where($this->table.'.semester_id',$data['column']['semester_id']);}

    //Check Type For Soft and Hard Delete
    if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where('status.name','deleted');}

    //Get Count Result
    $result = $result->count();

    //Return Result
    return $result;

  }


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
  public function getStudentSemesterAjax($data){

    $student_id = $data['column']['student_id'];

    //Get Query
    $result = DB::connection($this->connection);

    //Get Result
    $result = $result->select(" EXEC GetStudentSemesters '$student_id' ");


    //Return Result
    return $result;

  }

  /**************************************************************************************
    Select Box
  **************************************************************************************/
  public function getSemesterByGroupAjax($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                              ->select(
                                                $this->table.'.semester_id AS semester_id',
                                                $this->table.'.semester_group_id AS semester_group_id',
                                                $this->table.'.name AS semester_name',
                                                )
                                               ->join('semester_group','semester_group.semester_group_id','=',$this->table.'.semester_group_id')
                                               ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                                               ->where('status.table','semester')
                                               ->where('status.name','active')
                                               ->where($this->table.'.semester_group_id',$data['column']['semester_group_id'])
                                               ->where($this->table.'.campus_id',$data['column']['campus_id']);


    //Get Result
    $result = $result->get();


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
                        $this->table.'.semester_id AS semester_id',
                        $this->table.'.name AS semester_name',
                        $this->table.'.status_id AS status_id',
                        'status.name AS status_name'
                      )
                     ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                     ->where('status.table','semester')
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

    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.semester_id AS semester_id',
                    $this->table.'.campus_id AS campus_id',
                    $this->table.'.name AS semester_name',
                    $this->table.'.semester_group_id AS semester_group_id',
                    $this->table.'.start_date AS start_date',
                    $this->table.'.end_date AS end_date',
                    'status.name AS status_name',
                    'campus.name AS campus_name',
                    'semester_group.name AS semester_group_name',


                  )
                ->join('semester_group','semester_group.semester_group_id','=',$this->table.'.semester_group_id')
                ->join('campus','campus.campus_id','=',$this->table.'.campus_id')
                ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                ->orderbY('semester_id','DESC')
                ->where('status.table','semester');
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
}
