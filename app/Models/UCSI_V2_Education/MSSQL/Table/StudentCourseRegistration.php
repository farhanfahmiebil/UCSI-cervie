<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Model
use App\Models\UCSI_V2_General\MSSQL\Table\Setting;

//Get Timestamp
use Carbon\Carbon;

//Get Auth
use Auth;

//Get Class
class StudentCourseRegistration extends Model{

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
  protected $table = 'student_course_registration';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'student_id';

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
    'student_id',
    'semester_id',
    'employee_id',
    'course_id',
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
                                                  $this->table.'.course_id AS course_id',
                                                  $this->table.'.employee_id AS employee_id',
                                                  $this->table.'.student_id AS student_id',
                                                  $this->table.'.status_id AS status_id',
                                                  'status.name AS status_name',
                                                 )
                                               ->leftJoin('status AS status',
                                                  function($join){
                                                   $join->on('status.status_id',$this->table.'.status_id');
                                                   $join->where('status.table','student_course_registration');
                                                  }
                                                )
                                                ->where($this->table.'.course_id',$data['column']['course_id'])
                                                ->where($this->table.'.semester_id',$data['column']['semester_id'])
                                                ->where($this->table.'.employee_id',$data['column']['employee_id'])
                                                ->where($this->table.'.student_id',$data['column']['student_id']);
;
    //Check Type For Soft and Hard Delete
    if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where('status.name','deleted');}

    //Get Count Result
    // $result = $result->count();

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
                        $this->table.'.campus_id AS campus_id',
                        $this->table.'.name AS campus_name',
                        $this->table.'.status_id AS status_id',
                        'status.name AS status_name'
                      )
                     ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                     ->where('status.table','campus')
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

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                              ->select(
                                                 $this->table.'.course_id AS course_id',
                                                 $this->table.'.employee_id AS employee_id',
                                                 $this->table.'.student_id AS student_id',
                                                 $this->table.'.semester_id AS semester_id',
                                                 $this->table.'.status_id AS status_id',
                                                 'course.name AS course_name',
                                                 'course.course_code AS course_code',
                                                 'status.name AS status_name',
                                                 'employee_profile.full_name AS employee_name',
                                                 'student_profile.full_name AS student_name',
                                                 'jury_major_instrument.name AS jury_major_instrument_name',
                                                 'jury_exam_course.jury_major_instrument_id AS jury_major_instrument_id'

                                               )
                                               ->join('course','course.course_id','=',  $this->table.'.course_id')
                                               ->join('status','status.status_id','=',  $this->table.'.status_id')
                                               ->join('student_profile','student_profile.student_id','=',  $this->table.'.student_id')
                                               ->join($this->table_neighbor['main']['database'].'.'.$this->table_neighbor['main']['user'].'.employee_profile AS employee_profile','employee_profile.employee_id','=',$this->table.'.employee_id')
                                               ->leftJoin('jury_exam_course',
                                                  function($join){
                                                    $join->on('jury_exam_course.semester_id','student_course_registration.semester_id');
                                                    $join->on('jury_exam_course.student_id','student_course_registration.student_id');
                                                    $join->on('jury_exam_course.course_id','student_course_registration.course_id');
                                                    $join->on('jury_exam_course.employee_id','student_course_registration.employee_id');
                                                   }
                                               )
                                               ->leftJoin('jury_major_instrument','jury_major_instrument.jury_major_instrument_id','=', 'jury_exam_course.jury_major_instrument_id')
                                               ->where('status.table','student_course_registration');

     //Filter Data
     if(isset($data['column']['student_id']) && $data['column']['student_id'] != null){$result = $result->where($this->table.'.student_id',$data['column']['student_id']);}
     if(isset($data['column']['semester_id']) && $data['column']['semester_id'] != null){$result = $result->where($this->table.'.semester_id',$data['column']['semester_id']);}
     if(isset($data['column']['course_id']) && $data['column']['course_id'] != null){$result = $result->where($this->table.'.course_id',$data['column']['course_id']);}
     if(isset($data['column']['employee_id']) && $data['column']['employee_id'] != null){$result = $result->where($this->table.'.employee_id',$data['column']['employee_id']);}



    //Get Count Result
    $result = $result->get();

    // dd($result);


    //Return Result
    return $result;

  }

  /**************************************************************************************
    View Selected
  **************************************************************************************/
  public function viewSelected($data){

    //Get Data
    $result = DB::connection($this->connection)->table($this->table)
                                              ->select(
                                                 $this->table.'.student_id AS student_id',
                                                 $this->table.'.semester_id AS semester_id',
                                                 $this->table.'.employee_id AS employee_id',
                                                 $this->table.'.course_id AS course_id',
                                                 $this->table.'.status_id AS status_id',
                                                 'student_profile.full_name AS student_name',
                                                 'employee_profile.full_name AS employee_name',
                                                 'semester.name AS semester_name',
                                                 'course.name AS course_name',
                                                 'course.course_code AS course_code',
                                                 'jury_major_instrument.jury_major_instrument_id AS jury_major_instrument_id',
                                                 'jury_major_instrument.name AS jury_major_instrument_name',
                                                 // 'jury_exam_course.repertoire_file AS repertoire_file',
                                                 'employee.email AS employee_email',
                                                 'jury_exam_course.jury_exam_course_repertoire_id AS jury_exam_course_repertoire_id',
                                                 'jury_exam_course_repertoire.name AS jury_exam_course_repertoire_name',
                                                 'jury_exam_course_repertoire.filename AS jury_exam_course_repertoire_filename'


                                               )
                                               ->join('student_profile','student_profile.student_id','=',  $this->table.'.student_id')
                                               ->join('programme','programme.programme_id','=',  'student_profile.programme_id')
                                               ->join($this->table_neighbor['main']['database'].'.'.$this->table_neighbor['main']['user'].'.employee_profile AS employee_profile','employee_profile.employee_id','=',$this->table.'.employee_id')
                                               ->join($this->table_neighbor['main']['database'].'.'.$this->table_neighbor['main']['user'].'.employee AS employee','employee.employee_id','=',$this->table.'.employee_id')
                                               ->join('course','course.course_id','=',  $this->table.'.course_id')
                                               ->join('semester','semester.semester_id','=',   $this->table.'.semester_id')
                                               ->leftJoin('jury_exam_course',
                                                  function($join){
                                                    $join->on('jury_exam_course.semester_id','student_course_registration.semester_id');
                                                    $join->on('jury_exam_course.student_id','student_course_registration.student_id');
                                                    $join->on('jury_exam_course.course_id','student_course_registration.course_id');
                                                    $join->on('jury_exam_course.employee_id','student_course_registration.employee_id');
                                                   }
                                               )
                                               ->leftJoin('jury_major_instrument','jury_major_instrument.jury_major_instrument_id','=', 'jury_exam_course.jury_major_instrument_id')
                                               ->leftJoin('jury_exam_course_repertoire','jury_exam_course_repertoire.jury_exam_course_repertoire_id','=', 'jury_exam_course.jury_exam_course_repertoire_id')
                                               ->where($this->table.'.student_id','=',$data['column']['student_id'])
                                               ->where($this->table.'.semester_id','=',$data['column']['semester_id'])
                                               ->where($this->table.'.course_id','=',$data['column']['course_id'])
                                               ->where($this->table.'.employee_id','=',$data['column']['employee_id']);

   //Get Result
   $result = $result->first();


    //Return Result
    return $result;

  }

}
