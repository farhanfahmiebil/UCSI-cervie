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

    /* Researcher
    **************************************************************************************/
    Route::prefix('researcher')->group(function(){

      /*  New
      **************************************************************************************/
      Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Researcher\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.researcher.new');

      /*  Create
      **************************************************************************************/
      Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Researcher\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.researcher.create');

      /* Synchronize
      **************************************************************************************/
      Route::prefix('synchronize')->group(function(){

        /*  Synchronize
        **************************************************************************************/
        Route::get('/view',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Researcher\SynchronizeController@view')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.researcher.synchronize.view');

        /*  Search
        **************************************************************************************/
        Route::post('/search',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Researcher\SynchronizeController@search')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.researcher.synchronize.search');

        /*  Process
        **************************************************************************************/
        Route::post('/process',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Researcher\SynchronizeController@process')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.researcher.synchronize.process');

      }); //Synchronize

      /*  List
      **************************************************************************************/
      Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Researcher\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.researcher.list');

      /*  Delete
      **************************************************************************************/
      Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Researcher\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.researcher.delete');

      // /*  List
      // **************************************************************************************/
      // Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Users\Student@list')->name(config('routing.application.modules.dashboard.employee.name').'.users.researcher.list');

      /*  View
      **************************************************************************************/
      // Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Users\Student@view')->name(config('routing.application.modules.dashboard.employee.name').'.users.researcher.view');

      /* View
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
                Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Researcher\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.researcher.view');;

              }); //End Tab Sub Category

              /*  Download
              **************************************************************************************/
              Route::get('/download/category/{category}',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Researcher\IndexController@download')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.researcher.download');

              /*  Update
              **************************************************************************************/
              Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Users\Manage\Researcher\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.users.manage.researcher.update');

            }); //End Tab Category

          }); //End Tab

        }); //End ID

      }); //End View

    }); //End Researcher

  }); //End Manage

}); //End Users
