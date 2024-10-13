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

  /* General
  **************************************************************************************/
  Route::prefix('general')->group(function(){

    /* Company
    **************************************************************************************/
    Route::prefix('company')->group(function(){

      /* Invoice
      **************************************************************************************/
      Route::prefix('invoice')->group(function(){

        /*  Index
        **************************************************************************************/
        Route::get('/invoice',config('routing.application.modules.dashboard.employee.controller').'\Ajax\General\Company\Invoice\Main\IndexController@index')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.general.company.invoice');

        /*  Requery
        **************************************************************************************/
        Route::get('/requery',config('routing.application.modules.dashboard.employee.controller').'\Ajax\General\Company\Invoice\Requery\IndexController@requery')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.general.company.invoice.requery');

      }); //End Invoice

    }); //End Company

  }); //End General

}); //End Ajax
