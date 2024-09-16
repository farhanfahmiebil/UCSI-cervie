<?php

namespace app\Models\UCSI_Hotel_POS\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class POS_Items extends Model{

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
  protected $table = 'pos_items';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'itemid';

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
    'itemid',
    'categoryid',
    'subcategoryid',
    'descriptions',
    'img',
    'statuses',
    'sequences',
    'countables',
    'isonline',
    'createdby',
    'createddt',
    'imgdigital',
    'dailyallocation',
    'rowitemid'
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
                    'item_price.istaxable AS item_is_tax',
                    'item_price.prices AS item_price',
                    'item_price.taxpercentages AS item_tax'
                  )
                  ->leftJoin('pos_itemprices AS item_price',
                     function($join){
                       $join->on('item_price.itemid','=',$this->table.'.itemid');
                      }
                  )
                ->where($this->table.'.itemid',$data['column']['item_id'])
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
                                               ->select($this->table.'.itemid AS item id')
                                               ->where($this->table.'.itemid',$data['column']['item_id']);

    //Get Count Result
    $result = $result->count();

    //Return Result
    return $result;

  }

}
