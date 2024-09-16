<?php

namespace app\Models\UCSI_V2_General\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class Setting extends Model{

  /**
   * The database connection that should be used by the model.
   *
   * @var string
   */
  protected $connection = 'sqlsrv_ucsi_v2_general';

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'setting';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'setting_id';

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
    'setting_id',
    'name',
    'value',
    'remark_user',
    'remark',
    'created_by',
    'updated_by',
    'deleted_by',
    'created_at',
    'updated_at',
    'deleted_at',
    'status_id'
  ];

  //Set Default
  public $default = [
    'pagination'=>[
      'size'=>10
    ]
  ];

  /*  Select Box
  **************************************************************************************/
  public function getPagination(){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select($this->table.'.value AS value')
                                               ->leftJoin('status','status.status_id','=',$this->table.'.status_id')
                                               ->where($this->table.'.setting_id','PAGINATION')
                                               ->where('status.name','active')
                                               ->first();
    //Return Result
    return (($result)?(int)$result->value:$this->default['pagination']['size']);

  }

  /*  Get List sampai kt bwh blum verified
  **************************************************************************************/
  public function getList($data){

    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.setting_id',
                                                  $this->table.'.value'
                                               );

    //Check if Admin
    if(!Auth::user()->isAdmin()){$result = $result->where($this->table.'.status','!=','deleted');}

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
          if(isset($data['column']['name']) && $data['column']['name'] != null){$result = $result->where($data['column']['name']);}
          if(isset($data['column']['abbreviation']) && $data['column']['abbreviation'] != null){$result = $result->where($data['column']['abbreviation']);}

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


    //Get Paginate
    $result = $result->paginate($data['pagination']);
    // dd($result);

    //Return Result
    return $result;

  }

  /*  Check Exist
  **************************************************************************************/
  public function checkExist($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select($this->table.'.salutation_id')
                                               ->where($this->table.'.salutation_id',$data['column']['id']);

    //Check Type For Soft and Hard Delete
    if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where($this->table.'.status','deleted');}

    //Get Count Result
    $result = $result->count();

    //Return Result
    return $result;

  }

}
