<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Home
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Qualification
**************************************************************************************/
Route::prefix('qualification')->group(function(){

  /*  New
  **************************************************************************************/
  Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\qualification\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.new');

  /*  Create
  **************************************************************************************/
  Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\qualification\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.create');

  /*  List
  **************************************************************************************/
  Route::get('/list',config('routing.application.modules.dashboard.researcher.controller').'\qualification\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.list');

  /*  Delete
  **************************************************************************************/
  Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\qualification\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.delete');

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\qualification\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.view');

  /*  Update
  **************************************************************************************/
  Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\qualification\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.update');

  /*  View File
  **************************************************************************************/
  Route::get('/file/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\qualification\IndexController@viewFile')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.view_file');

}); //End Qualification
