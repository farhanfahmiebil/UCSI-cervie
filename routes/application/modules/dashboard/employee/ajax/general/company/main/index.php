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

      /*  Index
      **************************************************************************************/
      Route::get('/information',config('routing.application.modules.dashboard.employee.controller').'\Ajax\General\Company\Main\IndexController@information')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.general.company.main.information');

      /*  Office
      **************************************************************************************/
      Route::get('/office',config('routing.application.modules.dashboard.employee.controller').'\Ajax\General\Company\Main\IndexController@office')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.general.company.main.office');

    }); //End Company

  }); //End General

}); //End Ajax
