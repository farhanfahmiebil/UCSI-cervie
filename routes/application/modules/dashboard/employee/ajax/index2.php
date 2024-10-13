<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Ajax
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Ajax
**************************************************************************************/
Route::prefix('ajax')->group(function(){

  /* User
  **************************************************************************************/
  Route::prefix('user')->group(function(){

    /* Access
    **************************************************************************************/
    Route::prefix('access')->group(function(){

      /* Module
      **************************************************************************************/
      Route::prefix('module')->group(function(){

        /* Sub
        **************************************************************************************/
        Route::prefix('sub')->group(function(){
// dd(2);
          /*  Index
          **************************************************************************************/
          Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Ajax\Home\IndexController@index')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.home.navigation_access_module_sub');

        }); //End Sub

      }); //End Module

    }); //End Access

  }); //End User

}); //End Ajax
