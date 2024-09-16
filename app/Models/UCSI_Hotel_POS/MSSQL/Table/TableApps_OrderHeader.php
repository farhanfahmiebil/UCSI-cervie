<?php

namespace app\Models\UCSI_Hotel_POS\MSSQL\Table;

//Get Carbon
use Carbon\Carbon;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class TableApps_OrderHeader extends Model{

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
  protected $table = 'tableapps_orderheader';

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
      'orderid',
      'orderdt',
      'customername',
      'mobileno',
      'tableno',
      'numofpax',
      'queueno',
      'total',
      'totaltax',
      'totaldiscounts',
      'totalpayable',
      'statuses',
      'receivedby',
      'receiveddt',
      'fulfilledby',
      'fulfilldt',
      'transferedtoposstatus',
      'transferedtoposdt',
      'fnboutletid'
  ];

  public $timestamps = false;

  /**************************************************************************************
    Get Customer List Cart Total
  **************************************************************************************/
  public function getCustomerListCartTotal($data){
    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.orderid AS order_id',
                    // 'tableorderbodies.orderbodyid AS order_body_id',
                    DB::raw('COUNT(tableorderbodies.orderid) AS total'),
                  )
                  ->leftJoin('TableApps_OrderBodies AS tableorderbodies','tableorderbodies.orderid','=',$this->table.'.orderid')
                  ->where($this->table.'.fnboutletid',$data['column']['outlet_id'])
                  ->where($this->table.'.tableno',$data['column']['table_no'])
                  ->where($this->table.'.orderid',$data['column']['order_id'])
                  ->groupBy($this->table.'.orderid');
                  // ->groupBy('tableorderbodies.orderbodyid');
// dd($data);
    //Get Result
    $result = $result->first();
// dd((($result)?$result->total:0));
    //Get Result
    return (($result)?$result->total:0);

  }

  /**************************************************************************************
    Get List Selected
  **************************************************************************************/
  public function getListSelected($data){
    // dd($data);
    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.orderid AS order_id',
                    $this->table.'.orderdt AS order_date',
                    $this->table.'.fnboutletid AS outlet_id',
                    $this->table.'.tableno AS table_no',
                    $this->table.'.statuses AS status',
                    $this->table.'.customername AS name',
                    $this->table.'.mobileno AS mobile_number',
                  )
                ->where($this->table.'.fnboutletid',$data['column']['outlet_id'])
                ->where($this->table.'.tableno',$data['column']['table_no'])
                ->where($this->table.'.mobileno',$data['column']['mobile_number'])
                ->where($this->table.'.statuses',$data['column']['status']);
    // dd($result->get(),Carbon::today());
    //Filter Query
    if(isset($data['column']['date']) && $data['column']['date'] != null && $data['column']['date'] == 'now'){$result->whereDate($this->table.'.orderdt', Carbon::today());}
    // if(isset($data['column']['date']) && $data['column']['date'] != null && $data['column']['date'] == 'now'){$result->where(DB::raw('CONVERT(DATE, '.$this->table.'.orderdt'),Carbon::today());}
    // dd($result->tosql(),$data['column'],Carbon::now());
    // print_r($result->tosql());
    // exit();
    //Get Result
    $result = $result->get();

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
                    $this->table.'.fnboutletid AS outlet_id',
                    $this->table.'.tableno AS table_no',
                    $this->table.'.orderid AS order_id',
                    $this->table.'.mobileno AS mobile_number',
                    $this->table.'.customername AS name',
                    $this->table.'.numofpax AS pax_no',
                    $this->table.'.statuses AS status'
                  )
                ->where($this->table.'.fnboutletid',$data['column']['outlet_id'])
                ->where($this->table.'.tableno',$data['column']['table_no']);
                // ->where($this->table.'.orderid',$data['column']['order_id'])


    //Filter Query
    if(isset($data['column']['mobile_number']) && $data['column']['mobile_number'] != null){$result->where($this->table.'.mobileno',$data['column']['mobile_number']);}
    if(isset($data['column']['order_id']) && $data['column']['order_id'] != null){$result->where($this->table.'.orderid',$data['column']['order_id']);}
    if(isset($data['column']['status']) && $data['column']['status'] != null){$result->where($this->table.'.statuses',$data['column']['status']);}
    if(isset($data['column']['date']) && $data['column']['date'] != null && $data['column']['date'] == 'now'){$result->whereDate($this->table.'.orderdt',Carbon::today());}
    $result = $result->first();
  // dd($result,$data);
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
                    $this->table.'.fnboutletid AS outlet_id',
                    $this->table.'.tableno AS table_no',
                    $this->table.'.orderid AS order_id'
                  )
                ->where($this->table.'.fnboutletid',$data['column']['outlet_id'])
                ->where($this->table.'.tableno',$data['column']['table_no']);

    //Filter Query
    if(isset($data['column']['mobile_number']) && $data['column']['mobile_number'] != null){$result->where($this->table.'.mobileno',$data['column']['mobile_number']);}
    if(isset($data['column']['status']) && $data['column']['status'] != null){$result->where($this->table.'.statuses',$data['column']['status']);}
    if(isset($data['column']['order_id']) && $data['column']['order_id'] != null){$result->where($this->table.'.orderid',$data['column']['order_id']);}
    if(isset($data['column']['date']) && $data['column']['date'] != null && $data['column']['date'] == 'now'){$result->whereDate($this->table.'.orderdt',Carbon::today());}
// dd($result->tosql(),$data);
    //Get Count Result
    $result = $result->count();

    //Return Result
    return $result;

  }

}
