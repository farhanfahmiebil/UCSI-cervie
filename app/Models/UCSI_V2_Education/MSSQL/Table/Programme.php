<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Table;

//Get Database
use DB;

//Get Model
use App\Models\UCSI_V2_General\MSSQL\Table\Setting;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class Programme extends Model{

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
  protected $table = 'programme';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'programme_id';

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
    'programme_id',
    'programme_code',
    'scheme_id',
    'campus_id',
    'name',
    'programme_fin_code',
    'status_id',
    'is_offered',
    'duration',
    'semester_per_year',
    'total_credit_required',
    'is_short_term',
    'is_ptptn_approved',
    'is_supp_not_allowed',
    'is_allow_backdate_attendance',
    'is_excluded_activeenchk',
    'is_online_transcript',
    'local_tutition',
    'international_tuition',
    'current_initial_lab',
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'deleted_by',
    'updated_at',
    'deleted_at',
    'semester_group_id',
    'grading_scheme_id',
    'nec_code_level1_id',
    'nec_code_level2_id',
    'nec_code_level3_id',
    'programme_major_id',
    'is_a_level'
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
                        $this->table.'.programme_id AS programme_id'
                      )
                     ->orderBy('programme_id', 'desc')
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
                                                  $this->table.'.programme_id AS programme_id',
                                                  $this->table.'.status_id AS status_id',
                                                  'status.name AS status_name',
                                                 )
                                               ->leftJoin('status AS status',
                                                  function($join){
                                                   $join->on('status.status_id',$this->table.'.status_id');
                                                   $join->where('status.table','programme');
                                                  }
                                                );

    //Filter Data
    if(isset($data['column']['programme_id']) && $data['column']['programme_id'] != null){$result = $result->where($this->table.'.programme_id',$data['column']['programme_id']);}

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
                        $this->table.'.programme_id AS programme_id',
                        $this->table.'.programme_code AS programme_code',
                        $this->table.'.name AS programme_name',
                        $this->table.'.status_id AS status_id',
                        'status.name AS status_name',
                      )
                     ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                     ->where('status.table','programme')
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
                    $this->table.'.programme_id AS programme_id',
                    $this->table.'.name AS programme_name',
                    $this->table.'.programme_code AS programme_code',
                    $this->table.'.scheme_id AS scheme_id',
                    $this->table.'.campus_id AS campus_id',
                    $this->table.'.status_id AS status_id',
                    'status.name AS status_name',
                    'campus.name AS campus_name',
                    'scheme.name AS scheme_name'
                  )
                ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                ->join('campus','campus.campus_id','=',$this->table.'.campus_id')
                ->join('scheme','scheme.scheme_id','=',$this->table.'.scheme_id')
                ->where('status.table','programme');
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
  Check Duplicates Ajax
  **************************************************************************************/
  public function getProgrammeMajorAjax($data){

    // return $data;

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                              ->select(
                                                $this->table.'.programme_id AS programme_id',
                                                $this->table.'.programme_major_id AS programme_major_id',
                                                'programme_major.name AS programme_major_name'
                                                )
                                               ->join('programme_major','programme_major.programme_major_id','=',$this->table.'.programme_major_id')
                                               ->where($this->table.'.programme_id',$data['column']['programme_id']);

    //Get Result
    $result = $result->first();



    //Return Result
    return $result;

  }

}
