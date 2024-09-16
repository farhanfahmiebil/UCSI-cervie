<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Table;

//Get Database
use DB;

//Get Model
use App\Models\UCSI_V2_General\MSSQL\Table\Setting;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Timestamp
use Carbon\Carbon;

//Get Auth
use Auth;


//Get Class
class SemesterTeaching extends Model{

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
  protected $table = 'semester_teaching';

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
    'course_id',
    'employee_id',
    'status_id',
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'deleted_by',
    'updated_at',
    'deleted_at'
  ];

  //Table Neighbor
  protected $table_neighbor = [
    'main'=>[
      'user'=>'dbo',
      'database'=>'ucsi_v2_main'
    ]
  ];

  //Set Default
  public $default = [
    'pagination'=>[
      'size'=>10
    ]
  ];

  /**************************************************************************************
    Boot
  **************************************************************************************/
  protected static function boot()
  {
      parent::boot();

      static::creating(function ($model) {
          $model->created_by = Auth::id(); // Set created_by to the current user ID
          $model->created_at = Carbon::now(); // Set created_by to the current user ID
      });

      static::updating(function ($model) {
          $model->updated_by = Auth::id(); // Set updated_by to the current user ID
          $model->updated_at = Carbon::now(); // Set updated_by to the current user ID
      });
  }

  /**************************************************************************************
    Check Exist
  **************************************************************************************/
  public function checkExist($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.semester_id AS semester_id',
                                                  $this->table.'.course_id AS course_id',
                                                  $this->table.'.employee_id AS employee_id',
                                                  'status.name AS status_name',
                                                 )
                                               ->leftJoin('status AS status',
                                                  function($join){
                                                   $join->on('status.status_id',$this->table.'.status_id');
                                                   $join->where('status.table','semester_teaching');
                                                  }
                                                )
                                                ->where($this->table.'.course_id',$data['column']['course_id'])
                                                ->where($this->table.'.employee_id',$data['column']['employee_id'])
                                                ->where($this->table.'.semester_id',$data['column']['semester_id']);


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
  public function selectBox(){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result ->select(
                        $this->table.'.course_id AS course_id',
                        $this->table.'.semester_id AS semester_id',
                        $this->table.'.employee_id AS employee_id',
                        $this->table.'.status_id AS status_id',
                        'status.name AS status_name',
                        'course.name AS course_name',
                        'course.course_code AS course_code',
                        'employee_profile.full_name AS employee_name',
                        'semester.name AS semester_name'

                      )
                     ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                     ->join('course','course.course_id','=',$this->table.'.course_id')
                     ->join('semester','semester.semester_id','=',$this->table.'.semester_id')
                     ->join($this->table_neighbor['main']['database'].'.'.$this->table_neighbor['main']['user'].'.employee_profile AS employee_profile','employee_profile.employee_id','=',$this->table.'.employee_id')

                     ->where('status.table','semester_teaching')
                     ->where('status.name','active')
                     ->get()
                     ->toarray();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Select Box
  **************************************************************************************/
  public function selectBoxAjax($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result ->select(
                        $this->table.'.course_id AS course_id',
                        $this->table.'.semester_id AS semester_id',
                        $this->table.'.employee_id AS employee_id',
                        $this->table.'.status_id AS status_id',
                        'status.name AS status_name',
                        'course.name AS course_name',
                        'course.course_code AS course_code',
                        'employee_profile.full_name AS employee_name',
                        'semester.name AS semester_name'

                      )
                     ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                     ->join('course','course.course_id','=',$this->table.'.course_id')
                     ->join('semester','semester.semester_id','=',$this->table.'.semester_id')
                     ->join($this->table_neighbor['main']['database'].'.'.$this->table_neighbor['main']['user'].'.employee_profile AS employee_profile','employee_profile.employee_id','=',$this->table.'.employee_id')
                     ->where('status.table','semester_teaching')
                     ->where('status.name','active');

       if(isset($data['column']['semester_id']) && $data['column']['semester_id'] != null){$result = $result->where($this->table.'.semester_id',$data['column']['semester_id']);}


                     $result = $result->get()
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
                    $this->table.'.semester_id AS semester_id',
                    $this->table.'.course_id AS course_id',
                    $this->table.'.employee_id AS employee_id',
                    $this->table.'.status_id AS status_id',
                    'status.name AS status_name',
                    'semester.name AS semester_name',
                    'employee_profile.full_name AS employee_name',
                    'course.name AS course_name'
                  )
                ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                ->join('semester','semester.semester_id','=',$this->table.'.semester_id')
                ->join('course','course.course_id','=',$this->table.'.course_id')
                ->join($this->table_neighbor['main']['database'].'.'.$this->table_neighbor['main']['user'].'.employee_profile AS employee_profile','employee_profile.employee_id','=',$this->table.'.employee_id')
                ->where('status.table','semester_teaching');
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
                $query->orWhere($this->table.'.programme_code','LIKE','%'.$search.'%');

              });

            }

            //Filter Query
            if(isset($data['column']['programme_id']) && $data['column']['programme_id'] != null){$result = $result->where('programme.programme_id',$data['column']['programme_id']);}
            if(isset($data['column']['campus_id']) && $data['column']['campus_id'] != null){$result = $result->where('campus.campus_id',$data['column']['campus_id']);}

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
    View Selected
  **************************************************************************************/
  public function viewSelected($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                              ->select(
                                                 $this->table.'.semester_id AS semester_id',
                                                 $this->table.'.course_id AS course_id',
                                                 $this->table.'.employee_id AS employee_id',
                                                 $this->table.'.status_id AS status_id',
                                                 'semester.name AS semester_name',
                                                 'employee_profile.full_name AS employee_name',
                                                 'course.name AS course_name',
                                                 'course.course_code AS course_code',
                                                 'semester_group.name AS semester_group_name',
                                                 'campus.name AS campus_name'

                                               )
                                               ->join('semester','semester.semester_id','=',$this->table.'.semester_id')
                                               ->join('course','course.course_id','=',$this->table.'.course_id')
                                               ->join($this->table_neighbor['main']['database'].'.'.$this->table_neighbor['main']['user'].'.employee_profile AS employee_profile','employee_profile.employee_id','=',$this->table.'.employee_id')
                                               ->join('semester_group','semester_group.semester_group_id','=','semester.semester_group_id')
                                               ->join('campus','campus.campus_id','=','semester.campus_id')
                                               ->where($this->table.'.employee_id','=',$data['column']['employee_id'])
                                               ->where($this->table.'.course_id','=',$data['column']['course_id'])
                                               ->where($this->table.'.semester_id','=',$data['column']['semester_id']);


    //Get Count Result
    $result = $result->first();

    //Return Result
    return $result;

  }


}
