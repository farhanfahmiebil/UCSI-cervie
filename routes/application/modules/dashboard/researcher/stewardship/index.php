<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Stewardship
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Stewardship
**************************************************************************************/
Route::prefix('stewardship')->group(function(){

  /*  New
  **************************************************************************************/
  Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\Stewardship\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.stewardship.new');

  /*  Create
  **************************************************************************************/
  Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\Stewardship\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.stewardship.create');

  /*  List
  **************************************************************************************/
  Route::get('/list',config('routing.application.modules.dashboard.researcher.controller').'\Stewardship\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.stewardship.list');

  /*  Delete
  **************************************************************************************/
  Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\Stewardship\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.stewardship.delete');

  /*  Delete Evidence
  **************************************************************************************/
  Route::get('/evidence/delete',config('routing.application.modules.dashboard.researcher.controller').'\Stewardship\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.stewardship.evidence.delete');

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\Stewardship\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.stewardship.view');

  /*  Update
  **************************************************************************************/
  Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\Stewardship\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.stewardship.update');

}); //End Stewardship
