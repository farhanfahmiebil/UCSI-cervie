<?php

namespace app\Models\UCSI_Hotel\MSSQL\StoredProcedure;

//Get Database
use DB;

//Get Class
class Menu{

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

   /**************************************************************************************
     Category
   **************************************************************************************/
   public function category($data){

    //Get Result
    $result = DB::connection($this->connection)->select('EXEC ordering_menu_category '.$data['column']['outlet_id']);

    //Return Result
    return $result;

   }

   /**************************************************************************************
     Category Sub
   **************************************************************************************/
   public function categorySub($data){

    //Get Result
    $result = DB::connection($this->connection)->select('EXEC ordering_menu_category_sub '.$data['column']['outlet_id']);

    //Return Result
    return $result;

   }

   /**************************************************************************************
     Menu Item
   **************************************************************************************/
   public function menuItem($data){

    //Get Result
    $result = DB::connection($this->connection)->select('EXEC ordering_menu_item '.$data['column']['outlet_id']);

    //Return Result
    return $result;

   }

}
