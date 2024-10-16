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

/* Researcher
**************************************************************************************/
Route::prefix('researcher')->group(function(){

  /* Portfolio
  **************************************************************************************/
  Route::prefix('portfolio')->group(function(){

    /* Organization
    **************************************************************************************/
    Route::prefix('organization')->group(function(){

      /*  Home
      **************************************************************************************/
      Route::get('/home',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\Home\IndexController@index')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.home');

      /* Organization ID
      **************************************************************************************/
      Route::prefix('{organization_id}')->group(function(){

        /* User
        **************************************************************************************/
        Route::prefix('user')->group(function(){

          /*  List
          **************************************************************************************/
          Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.list');

        }); //End User

      }); //End Organization ID

    }); // End Organization

  }); // End Portfolio
  // /*  New
  // **************************************************************************************/
  // Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Announcement\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.new');
  //
  // /*  Create
  // **************************************************************************************/
  // Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Announcement\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.create');
  //
  // /*  List
  // **************************************************************************************/
  // Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Announcement\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.list');
  //
  // /*  Delete
  // **************************************************************************************/
  // Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Announcement\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.delete');
  //
  // /*  Delete File
  // **************************************************************************************/
  // Route::get('/file/delete',config('routing.application.modules.dashboard.employee.controller').'\Announcement\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.evidence.delete');
  //
  // /*  View
  // **************************************************************************************/
  // Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Announcement\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.view');
  //
  // /*  Update
  // **************************************************************************************/
  // Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Announcement\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.announcement.update');

}); //End Researcher
