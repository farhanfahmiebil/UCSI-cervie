<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Ajax
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Ajax
**************************************************************************************/
Route::prefix('ajax')->group(function(){

  /* Outlet
  **************************************************************************************/
  Route::prefix('outlet')->group(function(){

    /* Outlet ID
    **************************************************************************************/
    Route::prefix('{outlet_id}')->group(function(){

      /* Table
      **************************************************************************************/
      Route::prefix('table')->group(function(){

        /* Table ID
        **************************************************************************************/
        Route::prefix('{table_no}')->group(function(){

          /* Order
          **************************************************************************************/
          Route::prefix('order')->group(function(){

            /* Order ID
            **************************************************************************************/
            Route::prefix('{order_id}')->group(function(){

              /* Cart
              **************************************************************************************/
              Route::prefix('cart')->group(function(){

                /* Cart
                **************************************************************************************/
                Route::prefix('item')->group(function(){

                  //Insert
                  Route::get('/insert',config('routing.application.modules.landing.controller').'\Outlet\Table\Ajax\Cart\ItemController@insert')->name(config('routing.application.modules.landing.name').'.ajax.outlet.table.cart.item.insert');

                  //Delete
                  Route::get('/delete',config('routing.application.modules.landing.controller').'\Outlet\Table\Ajax\Cart\ItemController@delete')->name(config('routing.application.modules.landing.name').'.ajax.outlet.table.cart.item.delete');

                  //Update
                  Route::get('/update',config('routing.application.modules.landing.controller').'\Outlet\Table\Ajax\Cart\ItemController@update')->name(config('routing.application.modules.landing.name').'.ajax.outlet.table.cart.item.update');

                  // /* Update
                  // **************************************************************************************/
                  // Route::prefix('update')->group(function(){
                  //
                  //   //Quantity
                  //   Route::get('/{quantity}',config('routing.application.modules.landing.controller').'\Outlet\Table\Ajax\Cart\ItemController@update')->name(config('routing.application.modules.landing.name').'.ajax.outlet.table.cart.item.update');
                  //
                  //   //Remark
                  //
                  // }); //End Update

                }); //End Item

                //List
                Route::get('/list',config('routing.application.modules.landing.controller').'\Outlet\Table\Ajax\Cart\IndexController@list')->name(config('routing.application.modules.landing.name').'.ajax.outlet.table.cart.list');

                //Total
                Route::get('/list/total',config('routing.application.modules.landing.controller').'\Outlet\Table\Ajax\Cart\IndexController@total')->name(config('routing.application.modules.landing.name').'.ajax.outlet.table.cart.total');

              }); //End Cart

            }); //End Order ID

          }); //End Order

        }); //End Table ID

      }); //End Table

    }); //End Outlet ID

  }); //End Outlet

}); //End Ajax
