<?php

//Get Model Path
namespace App\Models\UCSI_V2_Education\MSSQL\Table;

//Get Audit
// use OwenIt\Auditing\Contracts\Auditable;

//Get Authorization
use Auth;

//Get Database
use DB;

//Get Eloquent
use Illuminate\Database\Eloquent\Model;

//Get Model
use App\Models\UCSI_V2_General\MSSQL\Table\Setting;

//Get Notifiable
use Illuminate\Notifications\Notifiable;

//Get Class
class StudentProfile extends Model{

  // Use Audit
  // use \OwenIt\Auditing\Auditable;

  //Use Notify
  use Notifiable;

  //Table connection
  protected $connection = 'sqlsrv_ucsi_v2_education';

  //Table Name
  protected $table = 'student_profile';

  //Set Incrementing
  public $incrementing = false;

  //Set Timestamp
  public $timestamps = false;

  //Primary Key
  protected $primaryKey = 'student_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  //Column
  protected $fillable = [
    'student_id',
    'full_name',
    'first_name',
    'last_name',
    'nickname',
    'middle_name',
    'gender_id',
    'date_of_birth',
    'country_id',
    'nationality_id',
    'religion_id',
    'passport_no',
    'nric',
    'contact_no',
    'intake_id',
    'programme_id',
    'cgpa',
    'campus_id',
    'status_id',
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at',
    'deleted_by',
    'deleted_at',
    'country_of_birth'
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
    Select Box
  **************************************************************************************/
  public function selectBox($data=null){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result ->select(
                        $this->table.'.student_id AS student_id',
                        $this->table.'.full_name AS student_name'
                      )
                     ->get()
                     ->toarray();

    //Return Result
    return $result;

  }

  /**************************************************************************************
  Check Duplicates Ajax
  **************************************************************************************/
  public function getStudentAjax($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                              ->select(
                                                $this->table.'.student_id as student_id',
                                                $this->table.'.full_name as student_full_name',
                                                'programme.programme_code AS programme_code',
                                                'programme.name AS programme_name',
                                                'programme_major.name AS programme_major_name',
                                                'semester.name AS semester_name',
                                                'semester_group.name AS semester_group_name'

                                                )
                                               ->join('programme','programme.programme_id','=',  $this->table.'.programme_id')
                                               ->leftJoin('programme_major','programme_major.programme_major_id','=', 'programme.programme_id')
                                               ->leftJoin('semester','semester.semester_id','=', $this->table.'.semester_id')
                                               ->leftJoin('semester_group','semester_group.semester_group_id','=', 'semester.semester_group_id')
                                               ->where($this->table.'.student_id',$data['column']['student_id']);

    //Get Result
    $result = $result->first();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Get List
  **************************************************************************************/
  public function getList($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->distinct()
                                               ->select(
                                                  $this->table.'.first_name AS student_first_name',
                                                  $this->table.'.last_name AS student_last_name',
                                                  $this->table.'.full_name AS student_full_name',
                                                  $this->table.'.contact_no AS student_contact_no',
                                                  $this->table.'.student_id AS student_id',
                                                  $this->table.'.programme_id AS programme_id',
                                                  $this->table.'.semester_id AS semester_id',
                                                  'student.student_id AS student_id',
                                                  'student.email AS student_email',
                                                  'student.personal_email AS student_personal_email',
                                                  'programme.name AS programme_name',
                                                  'semester.name AS semester_name',
                                                  'status_student.name AS status_student_name'

                                                  )
                                               ->join('student','student.student_id','=',$this->table.'.student_id')
                                               ->join('programme','programme.programme_id','=',$this->table.'.programme_id')
                                               ->join('semester','semester.semester_id','=',$this->table.'.semester_id')
                                               ->join('status as status_student','status_student.status_id','=',$this->table.'.status_id');

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
              $query->where($this->table.'.full_name','LIKE','%'.$search.'%');
              $query->orWhere($this->table.'.student_id','LIKE','%'.$search.'%');

            });

          }

          //Filter Query
          if(isset($data['column']['student_status_id']) && $data['column']['student_status_id'] != null){$result = $result->where('status_student.status_id',$data['column']['student_status_id']);}

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

    //Return Result
    return $result;

   }

   /**************************************************************************************
     View Selected
   **************************************************************************************/
   public function viewSelected($data){

     //Get Count
     $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.student_id AS student_id',
                                                  $this->table.'.first_name AS first_name',
                                                  $this->table.'.last_name AS last_name',
                                                  $this->table.'.full_name AS full_name',
                                                  $this->table.'.middle_name AS middle_name',
                                                  $this->table.'.nickname AS nickname',
                                                  $this->table.'.campus_id AS campus_id',
                                                  $this->table.'.programme_id AS programme_id',
                                                  $this->table.'.semester_id AS semester_id',
                                                  $this->table.'.date_of_birth AS date_of_birth',
                                                  $this->table.'.religion_id AS religion_id',
                                                  $this->table.'.gender_id AS gender_id',
                                                  $this->table.'.nationality_id AS nationality_id',
                                                  $this->table.'.remark_user AS remark_user',
                                                  $this->table.'.nric_type AS nric_type',
                                                  $this->table.'.nric AS nric',
                                                  $this->table.'.contact_no AS contact_no',
                                                  $this->table.'.status_id AS status_id',
                                                  'student.email AS email',
                                                  'student.personal_email AS personal_email',

                                                )
                                                ->join('student','student.student_id','=',  $this->table.'.student_id')
                                                // ->join('status','status.status_id','=',  $this->table.'.status_id')
                                                // ->join('employee_position','employee_position.employee_id','=',  $this->table.'.employee_id')
                                                ->where('student_profile.student_id','=',$data['column']['student_id']);

     //Get Count Result
     $result = $result->first();

     //Return Result
     return $result;

   }


}
