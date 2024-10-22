<?php

/*
|--------------------------------------------------------------------------
// Web Routes - Home
|--------------------------------------------------------------------------
//
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
//
*/

/* Commercialization
**************************************************************************************/
Route::prefix('commercialization')->group(function(){

  /*  New
  **************************************************************************************/
  Route::get('/new/', config('routing.application.modules.dashboard.researcher.controller').'\Commercialization\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.commercialization.new');

  /*  Create
  **************************************************************************************/
  Route::post('/create', config('routing.application.modules.dashboard.researcher.controller').'\Commercialization\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.commercialization.create');

  /*  List
  **************************************************************************************/
  Route::get('/list', config('routing.application.modules.dashboard.researcher.controller').'\Commercialization\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.commercialization.list');

  /*  Delete
  **************************************************************************************/
  Route::get('/delete', config('routing.application.modules.dashboard.researcher.controller').'\Commercialization\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.commercialization.delete');

  /*  Delete Evidence
  **************************************************************************************/
  Route::get('/evidence/delete', config('routing.application.modules.dashboard.researcher.controller').'\Commercialization\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.commercialization.evidence.delete');

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}', config('routing.application.modules.dashboard.researcher.controller').'\Commercialization\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.commercialization.view');

  /*  Update
  **************************************************************************************/
  Route::post('/update', config('routing.application.modules.dashboard.researcher.controller').'\Commercialization\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.commercialization.update');

}); //End Commercialization
