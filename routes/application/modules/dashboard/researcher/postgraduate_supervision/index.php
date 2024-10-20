<?php

/*
|--------------------------------------------------------------------------
| Web Routes - Postgraduate Supervision
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Postgraduate Supervision
**************************************************************************************/
Route::prefix('postgraduate/supervision')->group(function(){

  /*  New
  **************************************************************************************/
  Route::get('/new', config('routing.application.modules.dashboard.researcher.controller') . '\PostgraduateSupervision\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate_supervision.new');

  /*  Create
  **************************************************************************************/
  Route::post('/create', config('routing.application.modules.dashboard.researcher.controller') . '\PostgraduateSupervision\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate_supervision.create');

  /*  List
  **************************************************************************************/
  Route::get('/list', config('routing.application.modules.dashboard.researcher.controller') . '\PostgraduateSupervision\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate_supervision.list');

  /*  Delete
  **************************************************************************************/
  Route::get('/delete', config('routing.application.modules.dashboard.researcher.controller') . '\PostgraduateSupervision\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate_supervision.delete');

  /*  Delete Evidence
  **************************************************************************************/
  Route::get('/evidence/delete', config('routing.application.modules.dashboard.researcher.controller') . '\PostgraduateSupervision\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate_supervision.evidence.delete');

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}', config('routing.application.modules.dashboard.researcher.controller') . '\PostgraduateSupervision\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate_supervision.view');

  /*  Update
  **************************************************************************************/
  Route::post('/update', config('routing.application.modules.dashboard.researcher.controller') . '\PostgraduateSupervision\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate_supervision.update');

}); //End Postgraduate Supervision
