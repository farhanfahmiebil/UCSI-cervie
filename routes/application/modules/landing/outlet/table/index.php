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

// Route::get('/',config('routing.application.modules.landing.controller').'\VirtualCard\IndexController@test')->name(config('routing.application.modules.landing.name').'.virtual_card.view1');
/**************************************************************************************
  Redirect Command Prompt
**************************************************************************************/
// Route::redirect('/','authorization/employee/login');

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
      Route::prefix('{table_id}')->group(function(){

        /* Index
        **************************************************************************************/
        Route::get('/',config('routing.application.modules.landing.controller').'\Outlet\Table\IndexController@index')->name(config('routing.application.modules.landing.name').'.outlet.table.index');

      }); //End Table ID

    }); //End Table

  }); //End Outlet ID

}); //End Outlet
