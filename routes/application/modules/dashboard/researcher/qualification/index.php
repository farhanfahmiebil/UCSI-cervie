<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Qualification
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

  /*  List
  **************************************************************************************/
  Route::get('/list',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Home\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.home.list');

  /* Academic
  **************************************************************************************/
  Route::prefix('academic')->group(function(){

    /*  New
    **************************************************************************************/
    Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Academic\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.academic.new');

    /*  Create
    **************************************************************************************/
    Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Academic\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.academic.create');

    /*  Delete
    **************************************************************************************/
    Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Academic\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.academic.delete');

    /*  Delete Evidence
    **************************************************************************************/
    Route::get('/evidence/delete',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Academic\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.academic.evidence.delete');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Academic\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.academic.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Academic\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.academic.update');

  }); //End Academic

  /* Professional
  **************************************************************************************/
  Route::prefix('professional')->group(function(){

    /*  New
    **************************************************************************************/
    Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Professional\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.professional.new');

    /*  Create
    **************************************************************************************/
    Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Professional\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.professional.create');

    /*  Delete
    **************************************************************************************/
    Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Professional\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.professional.delete');

    /*  Delete Evidence
    **************************************************************************************/
    Route::get('/evidence/delete',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Professional\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.professional.evidence.delete');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Professional\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.professional.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\Qualification\Professional\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.qualification.professional.update');

  }); //End Professional

}); //End Qualification
