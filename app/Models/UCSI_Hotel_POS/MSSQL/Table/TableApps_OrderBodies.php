<?php

namespace app\Models\UCSI_Hotel_POS\MSSQL\Table;

//Get Carbon
use Carbon\Carbon;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class TableApps_OrderBodies extends Model{

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
  protected $table = 'tableapps_orderbodies';

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'orderid';

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
      'orderbodyid',
      'orderid',
      'linenos',
      'itemid',
      'itemcategoryid',
      'descriptions',
      'unitprice',
      'quantity',
      'discounts',
      'total',
      'taxamt',
      'totalamt',
      'itemorderremarks',
      'fullfilled'
  ];

  public $timestamps = false;



  /**************************************************************************************
    Get Customer List Cart
  **************************************************************************************/
  public function getCustomerListCart($data){
    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.orderbodyid AS order_body_id',
                    $this->table.'.orderid AS order_id',
                    $this->table.'.itemid AS item_id',
                    $this->table.'.linenos AS line_no',
                    $this->table.'.itemcategoryid AS item_category_id',
                    $this->table.'.descriptions AS item_description',
                    $this->table.'.unitprice AS item_price',
                    $this->table.'.quantity AS item_quantity',
                    $this->table.'.discounts AS item_discount',
                    $this->table.'.total AS item_total',
                    $this->table.'.taxamt AS item_tax',
                    $this->table.'.totalamt AS item_total_amount',
                    $this->table.'.itemorderremarks AS item_order_remark',
                    $this->table.'.fullfilled AS item_fulfill',
                    'pos_item.categoryid AS category_id',
                    'pos_item.subcategoryid AS category_sub_id',
                    'pos_item.imgDigital AS item_image',
                    'pos_item_price.istaxable AS item_is_taxable',
                    'pos_item_price.taxpercentages AS item_tax_rate',
                    // DB::raw('CONVERT(pos_items.imgDigital USING utf8) AS item_image')
                  )
                  ->leftJoin('TableApps_OrderHeader AS tableorderheader','tableorderheader.orderid','=',$this->table.'.orderid')
                  ->leftJoin('POS_Items AS pos_item','pos_item.itemid','=',$this->table.'.itemid')
                  ->leftJoin('POS_ItemPrices AS pos_item_price','pos_item_price.itemid','=',$this->table.'.itemid')
                  ->where('tableorderheader.fnboutletid',$data['column']['outlet_id'])
                  ->where('tableorderheader.tableno',$data['column']['table_no'])
                  ->where($this->table.'.orderid',$data['column']['order_id']);
// dd($data);
    //Get Result
    $result = $result->get();
// dd($result);
    //Get Result
    return $result;

  }

  /**************************************************************************************
    View Selected
  **************************************************************************************/
  public function viewSelected($data){
    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.orderbodyid AS order_body_id',
                    $this->table.'.orderid AS order_id',
                    $this->table.'.itemid AS item_id',
                    $this->table.'.linenos AS line_no',
                    $this->table.'.itemcategoryid AS item_category_id',
                    $this->table.'.descriptions AS item_description',
                    $this->table.'.unitprice AS item_price',
                    $this->table.'.quantity AS item_quantity',
                    $this->table.'.discounts AS item_discount',
                    $this->table.'.total AS item_total',
                    $this->table.'.taxamt AS item_tax',
                    $this->table.'.totalamt AS item_total_amount',
                    $this->table.'.itemorderremarks AS item_order_remark',
                    $this->table.'.fullfilled AS item_fulfill',
                  );

    //Filter Query
    if(isset($data['column']['order_id']) && $data['column']['order_id'] != null){$result->where($this->table.'.orderid',$data['column']['order_id']);}
// dd(1);
    //Get Result
    $result = $result->first();

    //Get Result
    return $result;

  }

  /**************************************************************************************
    Check Exist
  **************************************************************************************/
  public function checkExist($data){

    //Get Count
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.orderid AS order_id',
                    $this->table.'.orderbodyid AS order_body_id',
                    $this->table.'.itemid AS itemid',
                  );
// dd(32);
    //Filter Query
    if(isset($data['column']['order_id']) && $data['column']['order_id'] != null){$result->where($this->table.'.orderid',$data['column']['order_id']);}
    if(isset($data['column']['order_body_id']) && $data['column']['order_body_id'] != null){$result->where($this->table.'.orderbodyid',$data['column']['order_body_id']);}
    if(isset($data['column']['item_id']) && $data['column']['item_id'] != null){$result->where($this->table.'.itemid',$data['column']['item_id']);}

    //Get Count Result
    $result = $result->count();

    //Return Result
    return $result;

  }

}
