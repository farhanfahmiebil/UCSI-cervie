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

        //Redirect
        Route::redirect('/','/outlet/{outlet_id}/table/{table_no}/register');

        /* Order
        **************************************************************************************/
        Route::prefix('order')->group(function(){

          /* Order ID
          **************************************************************************************/
          Route::prefix('{order_id}')->group(function(){

            //Redirect
            Route::redirect('/','{order_id}/menu');

            //Menu
            Route::get('/menu',config('routing.application.modules.landing.controller').'\Outlet\Table\Menu\IndexController@index')->name(config('routing.application.modules.landing.name').'.outlet.table.menu');

            /* Checkout
            **************************************************************************************/
            Route::prefix('checkout')->group(function(){

              //Index
              Route::get('/',config('routing.application.modules.landing.controller').'\Outlet\Table\Checkout\IndexController@index')->name(config('routing.application.modules.landing.name').'.outlet.table.checkout');

              //Process
              Route::get('/process',config('routing.application.modules.landing.controller').'\Outlet\Table\Checkout\IndexController@process')->name(config('routing.application.modules.landing.name').'.outlet.table.checkout.process');

            }); //End Order ID

          }); //End Order ID

        }); //End Order

      }); //End Table No

    }); //End Table

  }); //End Outlet ID

}); //End Outlet
