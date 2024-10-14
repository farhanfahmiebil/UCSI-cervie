<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Award
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Award
**************************************************************************************/
Route::prefix('award')->group(function(){

  /*  New
  **************************************************************************************/
  Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\Award\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.award.new');

  /*  Create
  **************************************************************************************/
  Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\Award\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.award.create');

  /*  List
  **************************************************************************************/
  Route::get('/list',config('routing.application.modules.dashboard.researcher.controller').'\Award\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.award.list');

  /*  Delete
  **************************************************************************************/
  Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\Award\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.award.delete');

  /*  Delete Evidence
  **************************************************************************************/
  Route::get('/evidence/delete',config('routing.application.modules.dashboard.researcher.controller').'\Award\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.award.evidence.delete');

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\Award\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.award.view');

  /*  Update
  **************************************************************************************/
  Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\Award\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.award.update');

}); //End Award
