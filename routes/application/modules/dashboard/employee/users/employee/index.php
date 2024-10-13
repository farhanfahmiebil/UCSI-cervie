<?php


/*
|--------------------------------------------------------------------------
| Web Routes - User
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

    /* Employee
    **************************************************************************************/
    Route::prefix('employee')->group(function(){

      /*  New
      **************************************************************************************/
      Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Employee\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.employee.new');

      /*  Create
      **************************************************************************************/
      Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Employee\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.employee.create');

      /* Synchronize
      **************************************************************************************/
      Route::prefix('synchronize')->group(function(){

        /*  Synchronize
        **************************************************************************************/
        Route::get('/view',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Employee\SynchronizeController@view')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.employee.synchronize.view');

        /*  Search
        **************************************************************************************/
        Route::post('/search',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Employee\SynchronizeController@search')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.employee.synchronize.search');

        /*  Process
        **************************************************************************************/
        Route::post('/process',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Employee\SynchronizeController@process')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.employee.synchronize.process');

      }); //Synchronize

      /*  List
      **************************************************************************************/
      Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Employee\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.employee.list');

      /*  Delete
      **************************************************************************************/
      Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Employee\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.employee.delete');

      // /*  List
      // **************************************************************************************/
      // Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Users\EmployeeController@list')->name(config('routing.application.modules.dashboard.employee.name').'.users.employee.list');

      /*  View
      **************************************************************************************/
      // Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Users\EmployeeController@view')->name(config('routing.application.modules.dashboard.employee.name').'.users.employee.view');

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
                Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Employee\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.employee.view');;

              }); //End Tab Sub Category

              /*  Download
              **************************************************************************************/
              Route::get('/download/category/{category}',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Employee\IndexController@download')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.employee.download');

              /*  Update
              **************************************************************************************/
              Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Employee\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.employee.update');

            }); //End Tab Category

          }); //End Tab

        }); //End ID

      }); //End View

    }); //End Employee

  }); //End Manage

}); //End Users
