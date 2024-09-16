<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Landing Outlet Table
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Outlet
**************************************************************************************/
Route::prefix('outlet')->group(function(){

  /* Outlet ID
  **************************************************************************************/
  Route::prefix('{outlet_id}')->group(function(){

    /* Table
    **************************************************************************************/
    Route::prefix('table')->group(function(){

      /* Table No
      **************************************************************************************/
      Route::prefix('{table_no}')->group(function(){

        /* Order
        **************************************************************************************/
        Route::prefix('order')->group(function(){

          /* Order ID
          **************************************************************************************/
          Route::prefix('{order_id}')->group(function(){

            /* Checkout
            **************************************************************************************/
            Route::prefix('checkout')->group(function(){


              //Submit
              Route::get('/submit',config('routing.application.modules.landing.controller').'\Outlet\Table\Checkout\IndexController@submit')->name(config('routing.application.modules.landing.name').'.outlet.table.checkout.submit');

            }); //End Order ID

          }); //End Order ID

        }); //End Order

      }); //End Table No

    }); //End Table

  }); //End Outlet ID

}); //End Outlet
