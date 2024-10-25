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
  Route::get('/new', config('routing.application.modules.dashboard.researcher.controller') . '\Postgraduate\Supervision\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate.supervision.new');

  /*  Create
  **************************************************************************************/
  Route::post('/create', config('routing.application.modules.dashboard.researcher.controller') . '\Postgraduate\Supervision\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate.supervision.create');

  /*  List
  **************************************************************************************/
  Route::get('/list', config('routing.application.modules.dashboard.researcher.controller') . '\Postgraduate\Supervision\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate.supervision.list');

  /*  Delete
  **************************************************************************************/
  Route::get('/delete', config('routing.application.modules.dashboard.researcher.controller') . '\Postgraduate\Supervision\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate.supervision.delete');

  /*  Delete Evidence
  **************************************************************************************/
  Route::get('/evidence/delete', config('routing.application.modules.dashboard.researcher.controller') . '\Postgraduate\Supervision\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate.supervision.evidence.delete');

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}', config('routing.application.modules.dashboard.researcher.controller') . '\Postgraduate\Supervision\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate.supervision.view');

  /*  Update
  **************************************************************************************/
  Route::post('/update', config('routing.application.modules.dashboard.researcher.controller') . '\Postgraduate\Supervision\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name') . '.postgraduate.supervision.update');

}); //End Postgraduate Supervision
