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
      Route::prefix('registration')->group(function(){

        /*  Semester
        **************************************************************************************/
        Route::get('/semester',config('routing.application.modules.dashboard.employee.controller').'\Ajax\University\Admission\Registration\IndexController@getSemester')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.university.admission.registration.getsemester');

        /*  Semester Teaching
        **************************************************************************************/
        Route::get('/semester/teaching',config('routing.application.modules.dashboard.employee.controller').'\Ajax\University\Admission\Registration\IndexController@getSemesterTeaching')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.university.admission.registration.getsemesterteaching');

        /*  Delete
        **************************************************************************************/
        Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Ajax\University\Admission\Registration\IndexController@deleteSubject')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.university.admission.registration.deletesubject');

      }); //End User

    }); //End User

  }); //End University


}); //End Ajax
