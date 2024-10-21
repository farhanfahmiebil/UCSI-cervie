<?php

/*
|--------------------------------------------------------------------------
| Web Routes - Consultancies
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Consultancies
**************************************************************************************/
Route::prefix('consultancies')->group(function(){

  /*  New
  **************************************************************************************/
  Route::get('/new', config('routing.application.modules.dashboard.researcher.controller').'\Consultancies\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.consultancies.new');

  /*  Create
  **************************************************************************************/
  Route::post('/create', config('routing.application.modules.dashboard.researcher.controller').'\Consultancies\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.consultancies.create');

  /*  List
  **************************************************************************************/
  Route::get('/list', config('routing.application.modules.dashboard.researcher.controller').'\Consultancies\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.consultancies.list');

  /*  Delete
  **************************************************************************************/
  Route::get('/delete', config('routing.application.modules.dashboard.researcher.controller').'\Consultancies\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.consultancies.delete');

  /*  Delete Evidence
  **************************************************************************************/
  Route::get('/evidence/delete', config('routing.application.modules.dashboard.researcher.controller').'\Consultancies\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.consultancies.evidence.delete');

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}', config('routing.application.modules.dashboard.researcher.controller').'\Consultancies\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.consultancies.view');

  /*  Update
  **************************************************************************************/
  Route::post('/update', config('routing.application.modules.dashboard.researcher.controller').'\Consultancies\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.consultancies.update');

}); // End Consultancies
