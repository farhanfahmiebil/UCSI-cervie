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

/* General
**************************************************************************************/
Route::prefix('general')->group(function(){

  /* Information
  **************************************************************************************/
  Route::prefix('information')->group(function(){

    /*  List
    **************************************************************************************/
    Route::get('/list',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Home\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.home.list');

    /* Position
    **************************************************************************************/
    Route::prefix('position')->group(function(){

      /*  New
      **************************************************************************************/
      Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Position\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.position.new');

      /*  Create
      **************************************************************************************/
      Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Position\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.position.create');

      /*  Delete
      **************************************************************************************/
      Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Position\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.position.delete');

      /*  View
      **************************************************************************************/
      Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Position\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.position.view');

      /*  Update
      **************************************************************************************/
      Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Position\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.position.update');

    }); //End Position

    /* Area
    **************************************************************************************/
    Route::prefix('area')->group(function(){

      /* Interest
      **************************************************************************************/
      Route::prefix('interest')->group(function(){

        /*  New
        **************************************************************************************/
        Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Area\Interest\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.area.interest.new');

        /*  Create
        **************************************************************************************/
        Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Area\Interest\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.area.interest.create');

        /*  Delete
        **************************************************************************************/
        Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Area\Interest\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.area.interest.delete');

        /*  View
        **************************************************************************************/
        Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Area\Interest\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.area.interest.view');

        /*  Update
        **************************************************************************************/
        Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Area\Interest\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.area.interest.update');

      }); //End Interest

    }); //End Area

    /* Work
    **************************************************************************************/
    Route::prefix('work')->group(function(){

      /* Experience
      **************************************************************************************/
      Route::prefix('experience')->group(function(){

        /*  New
        **************************************************************************************/
        Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Work\Experience\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.work.experience.new');

        /*  Create
        **************************************************************************************/
        Route::post('/create',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Work\Experience\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.work.experience.create');

        /*  Delete
        **************************************************************************************/
        Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Work\Experience\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.work.experience.delete');

        /*  View
        **************************************************************************************/
        Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Work\Experience\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.work.experience.view');

        /*  Update
        **************************************************************************************/
        Route::post('/update',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Work\Experience\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.work.experience.update');

        /*  Reupload
        **************************************************************************************/
        Route::post('/reupload',config('routing.application.modules.dashboard.researcher.controller').'\General\Information\Work\Experience\IndexController@reupload')->name(config('routing.application.modules.dashboard.researcher.name').'.general.information.work.experience.reupload');

      }); //End Experience

    }); //End Work

  }); //End Information

}); //End General
