<?php

namespace app\Models\UCSI_Hotel_POS\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class POS_ItemPrices extends Model{

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
  protected $table = 'pos_itemprices';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'itempriceid';

  /**
   * Indicates if the model's ID is auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = true;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */

  protected $fillable = [
    'itempriceid',
    'itemid',
    'startdt',
    'enddt',
    'istaxable',
    'prices',
    'taxpercentages',
    'glcode'
  ];



  /**************************************************************************************
    View Selected
  **************************************************************************************/
  public function viewSelected($data){

    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.itemid AS item id',
                    $this->table.'.categoryid AS category_id',
                    $this->table.'.subcategoryid AS category_sub_id',
                    $this->table.'.descriptions AS item_description'
                  )
                ->where($this->table.'.fnboutletid',$data['column']['outlet_id'])
                ->first();
// dd($result);
    //Get Result
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
