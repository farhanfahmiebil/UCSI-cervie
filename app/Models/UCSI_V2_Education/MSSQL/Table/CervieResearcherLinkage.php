<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class CervieResearcherLinkage extends Model{

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
  protected $table = 'cervie_researcher_linkage';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'linkage_id';

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
    'linkage_id',
    'employee_id',
    'organization',
    'title',
    'agreement_level_id',
    'agreement_type_id',
    'amount',
    'linkage_category_id',
    'country_id',
    'date_start',
    'date_end',
    'created_by',
    'created_at',
    'updated_by',
    'deleted_by',
    'updated_at',
    'deleted_at',
    'need_verification',
    'qualification_name',
    'institution_name',
    'filename'
  ];

  //Table Neighbor
  protected $table_neighbor = [
    'general'=>[
      'user'=>'dbo',
      'table'=>'salutation',
      'database'=>'ucsi_v2_general'
    ]
  ];

  /**************************************************************************************
    Get Last ID
  **************************************************************************************/
  public function getLastID(){

    //Get Result
    $result = DB::connection($this->connection)->table($this->table)->select(
                        $this->table.'.linkage_id AS linkage_id'
                      )
                     ->orderBy('linkage_id', 'desc')
                     ->first();

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
                    $this->table.'.linkage_id AS linkage_id',
                    $this->table.'.employee_id AS employee_id',
                    $this->table.'.organization AS organization',
                    $this->table.'.title AS title',
                    $this->table.'.agreement_level_id AS agreement_level_id',
                    $this->table.'.agreement_type_id AS agreement_type_id',
                    $this->table.'.amount AS amount',
                    $this->table.'.linkage_category_id AS linkage_category_id',
                    $this->table.'.country_id AS country_id',
                    $this->table.'.date_start AS date_start',
                    $this->table.'.date_end AS date_end'
                  )
                // ->join($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.qualification AS qualification','qualification.qualification_id','=',$this->table.'.qualification_id')
                ->where($this->table.'.employee_id',$data['column']['employee_id'])
                ->get();

    //Get Result
    return $result;

  }

  /**************************************************************************************
    Check Exist
  **************************************************************************************/
  public function checkExist($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.linkage_id AS linkage_id',
                                                );

    //Filter Data
    if(isset($data['column']['id']) && $data['column']['id'] != null){$result = $result->where($this->table.'.linkage_id',$data['column']['id']);}

    //Check Type For Soft and Hard Delete
    // if(isset($data['type']) != null && $data['type'] == 'check_status'){$result = $result->where('status.name','deleted');}

    //Get Count Result
    $result = $result->count();

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
                                                 $this->table.'.linkage_id AS linkage_id',
                                                 $this->table.'.employee_id AS employee_id',
                                                 $this->table.'.organization AS organization',
                                                 $this->table.'.title AS title',
                                                 $this->table.'.agreement_level_id AS agreement_level_id',
                                                 $this->table.'.agreement_type_id AS agreement_type_id',
                                                 $this->table.'.amount AS amount',
                                                 $this->table.'.linkage_category_id AS linkage_category_id',
                                                 $this->table.'.country_id AS country_id',
                                                 $this->table.'.date_start AS date_start',
                                                 $this->table.'.date_end AS date_end'
                                                )
                                                ->join($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.agreement_level AS agreement_level','agreement_level.agreement_level_id','=',$this->table.'.agreement_level_id')
                                                ->join($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.agreement_type AS agreement_type','agreement_type.agreement_type_id','=',$this->table.'.agreement_type_id')
                                                ->join($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.linkage_category AS linkage_category','linkage_category.linkage_category_id','=',$this->table.'.linkage_category_id')
                                                ->join($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.country AS country','country.country_id','=',$this->table.'.country_id')
                                                ->where($this->table.'.linkage_id',$data['column']['id']);

    //Get Count Result
    $result = $result->first();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Get Data Ajax
  **************************************************************************************/
  public function getDataAjax($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                 $this->table.'.linkage_id AS linkage_id',
                                                 $this->table.'.employee_id AS employee_id',
                                                 $this->table.'.organization AS organization',
                                                 $this->table.'.title AS title',
                                                 $this->table.'.agreement_level_id AS agreement_level_id',
                                                 $this->table.'.agreement_type_id AS agreement_type_id',
                                                 $this->table.'.amount AS amount',
                                                 $this->table.'.linkage_category_id AS linkage_category_id',
                                                 $this->table.'.country_id AS country_id',
                                                 $this->table.'.date_start AS date_start',
                                                 $this->table.'.date_end AS date_end',
                                                  'agreement_level.name AS agreement_level_name',
                                                  'agreement_type.name AS agreement_type_name',
                                                  'linkage_category.name AS linkage_category_name',
                                                  'country.name AS country_name'
                                                )
                                                ->join($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.agreement_level AS agreement_level','agreement_level.agreement_level_id','=',$this->table.'.agreement_level_id')
                                                ->join($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.agreement_type AS agreement_type','agreement_type.agreement_type_id','=',$this->table.'.agreement_type_id')
                                                ->join($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.linkage_category AS linkage_category','linkage_category.linkage_category_id','=',$this->table.'.linkage_category_id')
                                                ->join($this->table_neighbor['general']['database'].'.'.$this->table_neighbor['general']['user'].'.country AS country','country.country_id','=',$this->table.'.country_id')
                                                ->where($this->table.'.linkage_id',$data['column']['id']);

    //Get Count Result
    $result = $result->first();

    //Return Result
    return $result;

  }






}
