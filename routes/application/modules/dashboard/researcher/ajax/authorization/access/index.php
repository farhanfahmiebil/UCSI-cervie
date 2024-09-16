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

    /* User
    **************************************************************************************/
    Route::prefix('user')->group(function(){

      /* Student
      **************************************************************************************/
      Route::prefix('student')->group(function(){

          /*  Index
          **************************************************************************************/
          Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Ajax\University\Users\IndexController@checkStudent')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.university.users.getstudent');

      }); //End Student

      /* Sub
      **************************************************************************************/
      Route::prefix('sub')->group(function(){
    // dd(2);
        /*  Index
        **************************************************************************************/
        Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Ajax\Authorization\Access\IndexController@moduleSub')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.authorization.access.module_sub');

      }); //End Sub

    }); //End User

    /* Setup
    **************************************************************************************/
    Route::prefix('setup')->group(function(){

      /* Programme
      **************************************************************************************/
      Route::prefix('programme')->group(function(){

          /*  Major
          **************************************************************************************/
          Route::get('/major',config('routing.application.modules.dashboard.employee.controller').'\Ajax\University\Setup\Programme\IndexController@getProgrammeMajor')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.university.setup.programme.getprogrammemajor');

      }); //End Student

      /* Campus
      **************************************************************************************/
      Route::prefix('campus')->group(function(){

          /*  Index
          **************************************************************************************/
          Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Ajax\University\Setup\Campus\IndexController@getCampusSemester')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.university.setup.campus.getcampussemester');

      }); //End Student

    }); //End User

  }); //End University

  /* User
  **************************************************************************************/
  Route::prefix('user')->group(function(){

    /* Access
    **************************************************************************************/
    Route::prefix('access')->group(function(){

      /* Module
      **************************************************************************************/
      Route::prefix('module')->group(function(){

        /*  Index
        **************************************************************************************/
        Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Ajax\Authorization\Access\Module\Main\IndexController@index')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.authorization.access.module');

        /* Sub
        **************************************************************************************/
        Route::prefix('sub')->group(function(){
// dd(2);
          /*  Index
          **************************************************************************************/
          Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Ajax\Authorization\Access\Module\Sub\IndexController@index')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.authorization.access.module.sub');

        }); //End Sub

        /* Module
        **************************************************************************************/
        Route::prefix('company')->group(function(){

          /*  Company
          **************************************************************************************/
          Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Ajax\Authorization\Access\Module\Company\IndexController@index')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.authorization.access.module.company');

        }); //End Sub



      }); //End Module

    }); //End Access

  }); //End User

}); //End Ajax
