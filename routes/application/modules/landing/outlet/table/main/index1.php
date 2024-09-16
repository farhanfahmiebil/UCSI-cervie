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

        /* Register
        **************************************************************************************/
        Route::prefix('register')->group(function(){

          /* Index
          **************************************************************************************/
          Route::get('/',config('routing.application.modules.landing.controller').'\Outlet\Table\Register\IndexController@register')->name(config('routing.application.modules.landing.name').'.outlet.table.register');

          //Process
          Route::post('/process',config('routing.application.modules.landing.controller').'\Outlet\Table\Register\IndexController@process')->name(config('routing.application.modules.landing.name').'.outlet.table.register.process');

          //Exist
          Route::get('/exist',config('routing.application.modules.landing.controller').'\Outlet\Table\Register\IndexController@exist')->name(config('routing.application.modules.landing.name').'.outlet.table.register.exist');

          /* Register
          **************************************************************************************/
          Route::prefix('verification')->group(function(){

            //Exist
            Route::get('/',config('routing.application.modules.landing.controller').'\Outlet\Table\Register\VerificationController@index')->name(config('routing.application.modules.landing.name').'.outlet.table.register.verification');

            //Process
            Route::post('/process',config('routing.application.modules.landing.controller').'\Outlet\Table\Register\VerificationController@process')->name(config('routing.application.modules.landing.name').'.outlet.table.register.verification.process');

          }); //Verification

        }); //End Register

        /* Order
        **************************************************************************************/
        Route::middleware(['validation.outlet.table.customer_order'])->prefix('order')->group(function(){

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

              //Submit
              Route::get('/submit',config('routing.application.modules.landing.controller').'\Outlet\Table\Checkout\IndexController@submit')->name(config('routing.application.modules.landing.name').'.outlet.table.checkout.submit');

            }); //End Order ID

          }); //End Order ID

        }); //End Order

      }); //End Table No

    }); //End Table

  }); //End Outlet ID

}); //End Outlet
