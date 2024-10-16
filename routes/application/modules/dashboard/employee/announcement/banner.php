<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Announcement
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Announcement
**************************************************************************************/
Route::prefix('announcement')->group(function(){

  /* Banner
  **************************************************************************************/
  Route::prefix('banner')->group(function(){

    /*  New
    **************************************************************************************/
    Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Announcement\Banner\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.banner.new');

    /*  Create
    **************************************************************************************/
    Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Announcement\Banner\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.banner.create');

    /*  List
    **************************************************************************************/
    Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Announcement\Banner\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.banner.list');

    /*  Delete
    **************************************************************************************/
    Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Announcement\Banner\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.banner.delete');

    /*  Delete File
    **************************************************************************************/
    Route::get('/file/delete',config('routing.application.modules.dashboard.employee.controller').'\Announcement\Banner\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.banner.evidence.delete');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Announcement\Banner\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.banner.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Announcement\Banner\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.banner.update');

  }); //End Banner

}); //End Announcement
