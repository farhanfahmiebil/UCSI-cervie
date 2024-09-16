<?php

namespace app\Models\UCSI_HOTEL\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class POS_Category extends Model{

  /**
   * The database connection that should be used by the model.
   *
   * @var string
   */
  protected $connection = 'sqlsrv_ucsi_hotel';

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'pos_category';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'CampusID';

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
    'categoryid',
    'category',
    'createdby',
    'createddt',
    'statuses',
    'sequences',
    'hotelid'
  ];

  /**************************************************************************************
    Select Box
  **************************************************************************************/
  public function selectBox($data){
// dd($data);
    //Get Query
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select(
                                                  $this->table.'.categoryid AS category_id',
                                                  $this->table.'.category AS category_name'
                                                 )
                                               ->leftJoin('pos_fnboutlet','pos_fnboutlet.hotelid','=',$this->table.'.hotelid')
                                               ->leftJoin('pos_subcategory','pos_subcategory.categoryid','=',$this->table.'.categoryid')
                                               ->leftJoin('pos_items',
                                                  function($join){
                                                    $join->on('pos_items.categoryid','=',$this->table.'.categoryid');
                                                    $join->on('pos_items.subcategoryid','pos_subcategory.subcategoryid');
                                                   }
                                               )
                                               ->leftJoin('pos_outletitem',
                                                  function($join){
                                                    $join->on('pos_items.categoryid','=',$this->table.'.categoryid');
                                                    $join->on('pos_items.subcategoryid','pos_subcategory.subcategoryid');
                                                   }
                                               )
                                               ->where($this->table.'.statuses','1');

    //Filter Query
    if(isset($data['column']['outlet_id']) && $data['column']['outlet_id'] != null){$result = $result->where('pos_fnboutlet.fnboutletid', $data['column']['outlet_id']);}

    //Get Result
    $result = $result->get()
                     ->toarray();

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Check Exist
  **************************************************************************************/
  public function checkExist($data){

    //Get Count
    $result = DB::connection($this->connection)->table($this->table)
                                               ->select($this->table.'.fnboutletid')
                                               ->where($this->table.'.fnboutletid',$data['column']['id']);

    //Get Count Result
    $result = $result->count();

    //Return Result
    return $result;

  }

}
