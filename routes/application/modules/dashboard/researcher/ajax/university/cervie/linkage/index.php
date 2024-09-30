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

  /* University
  **************************************************************************************/
  Route::prefix('university')->group(function(){

    /* Admission
    **************************************************************************************/
    Route::prefix('cervie')->group(function(){

        /* Qualification
      **************************************************************************************/
      Route::prefix('linkage')->group(function(){

        /*  Semester
        **************************************************************************************/
        Route::get('/view',config('routing.application.modules.dashboard.researcher.controller').'\Ajax\University\Cervie\Linkage\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.ajax.university.cervie.linkage.view');

      }); //End User

    }); //End User

  }); //End University


}); //End Ajax
