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

/* Account
**************************************************************************************/
Route::prefix('account')->group(function(){

  /* Profile
  **************************************************************************************/
  Route::prefix('profile')->group(function(){

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
        Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Account\ProfileController@index')->name(config('routing.application.modules.dashboard.employee.name').'.account.profile.view');

      }); //End Tab Sub Category

        /*  Download
        **************************************************************************************/
        Route::get('/download/category/{category}',config('routing.application.modules.dashboard.employee.controller').'\Account\ProfileController@download')->name(config('routing.application.modules.dashboard.employee.name').'.account.profile.view.download');

        /*  Update
        **************************************************************************************/
        Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Account\ProfileController@update')->name(config('routing.application.modules.dashboard.employee.name').'.account.profile.update');

      }); //End Tab Category

    }); //End Tab

  }); //End Profile

  /* Change
  **************************************************************************************/
  Route::prefix('change')->group(function(){

    /* Password
    **************************************************************************************/
    Route::prefix('password')->group(function(){

      /*  Index
      **************************************************************************************/
      // Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Account\ChangePasswordController@index')->name(config('routing.application.modules.dashboard.employee.name').'.account.change_password.index');

      /*  Process
      **************************************************************************************/
      // Route::post('/process',config('routing.application.modules.dashboard.employee.controller').'\Account\ChangePasswordController@process')->name(config('routing.application.modules.dashboard.employee.name').'.account.change_password.process');

    }); //End Password

  }); //End Change

}); //End Account
