<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Publication
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Publication
**************************************************************************************/
Route::prefix('publication')->group(function(){

  /*  New
  **************************************************************************************/
  Route::get('/new/{publication_type_id?}',config('routing.application.modules.dashboard.researcher.controller').'\Publication\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.publication.new');

  /*  Create
  **************************************************************************************/
  Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\Publication\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.publication.create');

  /*  List
  **************************************************************************************/
  Route::get('/list',config('routing.application.modules.dashboard.researcher.controller').'\Publication\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.publication.list');

  /*  Delete
  **************************************************************************************/
  Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\Publication\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.publication.delete');

  /*  Delete Evidence
  **************************************************************************************/
  Route::get('/evidence/delete',config('routing.application.modules.dashboard.researcher.controller').'\Publication\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.publication.evidence.delete');

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\Publication\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.publication.view');

  /*  Update
  **************************************************************************************/
  Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\Publication\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.publication.update');

}); //End Publication
