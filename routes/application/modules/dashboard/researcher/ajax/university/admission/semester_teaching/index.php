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
    Route::prefix('admission')->group(function(){

      /* Registration
      **************************************************************************************/
      Route::prefix('semester_teaching')->group(function(){

        /*  Semester Group
        **************************************************************************************/
        Route::get('/semester/group',config('routing.application.modules.dashboard.employee.controller').'\Ajax\University\Admission\SemesterTeaching\IndexController@getSemester')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.university.admission.semester_teaching.get_semester');

      }); //End User

    }); //End User

  }); //End University


}); //End Ajax
