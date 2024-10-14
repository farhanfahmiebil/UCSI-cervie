<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Recognition
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Recognition
**************************************************************************************/
Route::prefix('recognition')->group(function(){

  /*  New
  **************************************************************************************/
  Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\Recognition\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.recognition.new');

  /*  Create
  **************************************************************************************/
  Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\Recognition\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.recognition.create');

  /*  List
  **************************************************************************************/
  Route::get('/list',config('routing.application.modules.dashboard.researcher.controller').'\Recognition\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.recognition.list');

  /*  Delete
  **************************************************************************************/
  Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\Recognition\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.recognition.delete');

  /*  Delete Evidence
  **************************************************************************************/
  Route::get('/evidence/delete',config('routing.application.modules.dashboard.researcher.controller').'\Recognition\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.recognition.evidence.delete');

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\Recognition\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.recognition.view');

  /*  Update
  **************************************************************************************/
  Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\Recognition\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.recognition.update');

}); //End Recognition
