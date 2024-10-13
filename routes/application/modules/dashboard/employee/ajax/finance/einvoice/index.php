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

  /* Finance
  **************************************************************************************/
  Route::prefix('finance')->group(function(){

    /* Access
    **************************************************************************************/
    Route::prefix('einvoice')->group(function(){

      /*  Index
      **************************************************************************************/
      Route::get('/login/tax/payer',config('routing.application.modules.dashboard.employee.controller').'\Ajax\Finance\Einvoice\IndexController@loginTaxPayer')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.finance.einvoice.login.tax_payer');

    }); //End Einvoice

  }); //End Finance

}); //End Ajax
