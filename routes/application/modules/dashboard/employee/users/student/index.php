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

/* Users
**************************************************************************************/
Route::prefix('users')->group(function(){


  /* Manage
  **************************************************************************************/
  Route::prefix('manage')->group(function(){

    /* Student
    **************************************************************************************/
    Route::prefix('student')->group(function(){

      /*  New
      **************************************************************************************/
      Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Student\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.student.new');

      /*  Create
      **************************************************************************************/
      Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Student\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.student.create');

      /* Synchronize
      **************************************************************************************/
      Route::prefix('synchronize')->group(function(){

        /*  Synchronize
        **************************************************************************************/
        Route::get('/view',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Student\SynchronizeController@view')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.student.synchronize.view');

        /*  Search
        **************************************************************************************/
        Route::post('/search',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Student\SynchronizeController@search')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.student.synchronize.search');

        /*  Process
        **************************************************************************************/
        Route::post('/process',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Student\SynchronizeController@process')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.student.synchronize.process');

      }); //Synchronize

      /*  List
      **************************************************************************************/
      Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Student\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.student.list');

      /*  Delete
      **************************************************************************************/
      Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Student\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.student.delete');

      // /*  List
      // **************************************************************************************/
      // Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Users\Student@list')->name(config('routing.application.modules.dashboard.employee.name').'.users.student.list');

      /*  View
      **************************************************************************************/
      // Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Users\Student@view')->name(config('routing.application.modules.dashboard.employee.name').'.users.student.view');

      /* ID
      **************************************************************************************/
      Route::prefix('view')->group(function(){

        /* ID
        **************************************************************************************/
        Route::prefix('{id}')->group(function(){

          /* Tab Category
          **************************************************************************************/
          Route::prefix('{tab?}')->group(function(){

            /* Tab Category
            **************************************************************************************/
            Route::prefix('{tab_category?}')->group(function(){

              /* Tab Sub Category
              **************************************************************************************/
              Route::prefix('{tab_sub_category?}')->group(function(){

                /*  Index
                **************************************************************************************/
                Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Student\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.student.view');;

              }); //End Tab Sub Category

              /*  Download
              **************************************************************************************/
              Route::get('/download/category/{category}',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Student\IndexController@download')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.student.download');

              /*  Update
              **************************************************************************************/
              Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Student\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.student.update');

            }); //End Tab Category

          }); //End Tab

        }); //End ID

      }); //End View

    }); //End Student

  }); //End Manage

}); //End Users
