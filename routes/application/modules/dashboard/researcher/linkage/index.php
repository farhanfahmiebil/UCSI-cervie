<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Linkage
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Linkage
**************************************************************************************/
Route::prefix('linkage')->group(function(){

  /*  New
  **************************************************************************************/
  Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\Linkage\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.linkage.new');

  /*  Create
  **************************************************************************************/
  Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\Linkage\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.linkage.create');

  /*  List
  **************************************************************************************/
  Route::get('/list',config('routing.application.modules.dashboard.researcher.controller').'\Linkage\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.linkage.list');

  /*  Delete
  **************************************************************************************/
  Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\Linkage\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.linkage.delete');

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\Linkage\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.linkage.view');

  /*  Update
  **************************************************************************************/
  Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\Linkage\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.linkage.update');

  /*  View File
  **************************************************************************************/
  Route::get('/file/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\Linkage\IndexController@viewFile')->name(config('routing.application.modules.dashboard.researcher.name').'.linkage.view_file');

}); //End Linkage
