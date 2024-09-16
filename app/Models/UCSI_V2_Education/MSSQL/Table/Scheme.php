<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Table;

//Get Database
use DB;

//Get Model
use App\Models\UCSI_V2_General\MSSQL\Table\Setting;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class Scheme extends Model{

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
  protected $table = 'scheme';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'scheme_id';

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
    'scheme_id',
    'name',
    'status',
    'is_postgraduate',
    'is_preuniversity',
    'qualification_rank',
    'isidp',
    'remark_user',
    'remark',
    'created_by',
    'created_at',
    'updated_by',
    'updated_at',
    'deleted_by',
    'deleted_at',
    'scheme_object_id'
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
  public function selectBox(){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table);

    //Get Result
    $result = $result ->select(
                        $this->table.'.scheme_id AS scheme_id',
                        $this->table.'.name AS scheme_name',
                        $this->table.'.status_id AS status_id',
                        'status.name AS status_name'
                      )
                     ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                     ->where('status.table','scheme')
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
                ->where('status.table','programme')
                ->where('status.name','active');

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
