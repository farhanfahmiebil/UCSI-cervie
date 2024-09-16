<?php

namespace app\Models\UCSI_Hotel_POS\MSSQL\StoredProcedure;

//Get Database
use DB;

//Get Class
class Order{

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

   public $incrementing = true;

  /**************************************************************************************
    Add To Cart
  **************************************************************************************/
  public function addToCart($data){

    //Execute the Stored Procedure
    $result = DB::connection($this->connection)->statement('EXEC TableApps_InsertOrderBody ?, ?, ?, ?, ?, ?, ?, ?, ?', [
      $data['column']['order_id'],
      $data['column']['item_id'],
      $data['column']['item_price'],
      $data['column']['item_quantity'],
      $data['column']['item_discount'],
      $data['column']['item_total_subtotal'],
      $data['column']['item_tax'],
      $data['column']['item_total'],
      $data['column']['item_remark'],
    ]);

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Update Cart Item Quantity
  **************************************************************************************/
  public function updateCartQuantity($data){

    //Execute the Stored Procedure
    $result = DB::connection($this->connection)->statement('EXEC TableApps_UpdateOrderBodyQuantity ?, ?',[
      $data['column']['order_body_id'],
      $data['column']['item_quantity']
    ]);

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Update Cart Item Remark
  **************************************************************************************/
  public function updateCartRemark($data){

    //Execute the Stored Procedure
    $result = DB::connection($this->connection)->statement('EXEC TableApps_UpdateOrderBodyRemark ?, ?',[
      $data['column']['order_body_id'],
      $data['column']['item_remark']
    ]);

    //Return Result
    return $result;

  }

  /**************************************************************************************
    Checkout Order Header
  **************************************************************************************/
  public function checkoutOrderHeader($data){

    //Execute the Stored Procedure
    $result = DB::connection($this->connection)->statement('EXEC TableApps_UpdateOrderHeader ?, ?, ?, ?, ?, ?, ?',[
      $data['column']['order_id'],
      $data['column']['queue_no'],
      $data['column']['total'],
      $data['column']['total_tax'],
      $data['column']['total_discount'],
      $data['column']['total_amount'],
      $data['column']['status']
    ]);

    //Return Result
    return $result;

  }

}
