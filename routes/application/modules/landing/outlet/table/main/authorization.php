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

          //Taken
          Route::get('/taken',config('routing.application.modules.landing.controller').'\Outlet\Table\Register\IndexController@taken')->name(config('routing.application.modules.landing.name').'.outlet.table.register.taken');

          /* Register
          **************************************************************************************/
          Route::prefix('verification')->group(function(){

            //Exist
            Route::get('/',config('routing.application.modules.landing.controller').'\Outlet\Table\Register\VerificationController@index')->name(config('routing.application.modules.landing.name').'.outlet.table.register.verification');

            //Process
            Route::post('/process',config('routing.application.modules.landing.controller').'\Outlet\Table\Register\VerificationController@process')->name(config('routing.application.modules.landing.name').'.outlet.table.register.verification.process');

          }); //Verification

        }); //End Register

      }); //End Table No

    }); //End Table

  }); //End Outlet ID

}); //End Outlet
