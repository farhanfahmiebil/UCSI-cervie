<?php

namespace app\Models\UCSI_HOTEL\MSSQL\Table;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

//Get Class
class POS_FNBOutlet extends Model{

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
  protected $table = 'pos_fnboutlet';

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
      'fnboutletid',
      'hotelid',
      'outletname',
      'branchcode',
      'outletcode',
      'addressl1',
      'addressl2',
      'city',
      'postcode',
      'states',
      'country',
      'updatedby',
      'updateddt',
      'statuses',
      'billabbrev',
      'billrunningnum',
      'istaxable',
      'taxpercentage',
      'sstno',
      'companyname',
      'promotionals',
      'contactno',
      'daycollection_usefirsttolastshift',
      'entityid'
  ];



  /**************************************************************************************
    View Selected
  **************************************************************************************/
  public function viewSelected($data){

    //Get Query
    $result = DB::connection($this->connection)
                ->table($this->table)
                ->select(
                    $this->table.'.fnboutletid AS outlet_id',
                    $this->table.'.hotelid AS hotel_id',
                    $this->table.'.outletname AS outlet_name'
                  )
                ->where($this->table.'.fnboutletid',$data['column']['outlet_id'])
                ->first();

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
