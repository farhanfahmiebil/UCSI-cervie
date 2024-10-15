<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Intellectual
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Intellectual
**************************************************************************************/
Route::prefix('intellectual')->group(function(){

  /*  List
  **************************************************************************************/
  Route::get('/list',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Home\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.home.list');

  /* Property
  **************************************************************************************/
  Route::prefix('property')->group(function(){

    /* Patent
    **************************************************************************************/
    Route::prefix('patent')->group(function(){

      /*  New
      **************************************************************************************/
      Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Patent\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.patent.new');

      /*  Create
      **************************************************************************************/
      Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Patent\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.patent.create');

      /*  Delete
      **************************************************************************************/
      Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Patent\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.patent.delete');

      /*  Delete Evidence
      **************************************************************************************/
      Route::get('/evidence/delete',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Patent\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.patent.evidence.delete');

      /*  View
      **************************************************************************************/
      Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Patent\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.patent.view');

      /*  Update
      **************************************************************************************/
      Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Patent\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.patent.update');

    }); //End Patent

    /* Licensing
    **************************************************************************************/
    Route::prefix('licensing')->group(function(){

      /*  New
      **************************************************************************************/
      Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Licensing\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.licensing.new');

      /*  Create
      **************************************************************************************/
      Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Licensing\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.licensing.create');

      /*  Delete
      **************************************************************************************/
      Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Licensing\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.licensing.delete');

      /*  Delete Evidence
      **************************************************************************************/
      Route::get('/evidence/delete',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Licensing\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.licensing.evidence.delete');

      /*  View
      **************************************************************************************/
      Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Licensing\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.licensing.view');

      /*  Update
      **************************************************************************************/
      Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Licensing\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.licensing.update');

    }); //End Licensing

    /* Copyright
    **************************************************************************************/
    Route::prefix('copyright')->group(function(){

      /*  New
      **************************************************************************************/
      Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Copyright\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.copyright.new');

      /*  Create
      **************************************************************************************/
      Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Copyright\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.copyright.create');

      /*  Delete
      **************************************************************************************/
      Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Copyright\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.copyright.delete');

      /*  Delete Evidence
      **************************************************************************************/
      Route::get('/evidence/delete',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Copyright\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.copyright.evidence.delete');

      /*  View
      **************************************************************************************/
      Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Copyright\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.copyright.view');

      /*  Update
      **************************************************************************************/
      Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Copyright\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.copyright.update');

    }); //End Copyright

    /* Trademark
    **************************************************************************************/
    Route::prefix('trademark')->group(function(){

      /*  New
      **************************************************************************************/
      Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Trademark\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.trademark.new');

      /*  Create
      **************************************************************************************/
      Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Trademark\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.trademark.create');

      /*  Delete
      **************************************************************************************/
      Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Trademark\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.trademark.delete');

      /*  Delete Evidence
      **************************************************************************************/
      Route::get('/evidence/delete',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Trademark\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.trademark.evidence.delete');

      /*  View
      **************************************************************************************/
      Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Trademark\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.trademark.view');

      /*  Update
      **************************************************************************************/
      Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\Intellectual\Property\Trademark\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.intellectual.property.trademark.update');

    }); //End Trademark

  }); //End Property

}); //End Intellectual
