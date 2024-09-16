<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Candidate - Authorization
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Login
**************************************************************************************/
Route::prefix('login')->group(function(){

  /*  Index
  **************************************************************************************/
  Route::get('/',config('routing.application.modules.dashboard.researcher.controller').'\Authorization\Login\IndexController@index')->name(config('routing.application.modules.dashboard.researcher.name').'.authorization.login');

  /*  Process
  **************************************************************************************/
  Route::post('/process',config('routing.application.modules.dashboard.researcher.controller').'\Authorization\Login\ProcessController@index')->name(config('routing.application.modules.dashboard.researcher.name').'.authorization.login.process');

}); //End Login

/* Logout
**************************************************************************************/
/*  Index
**************************************************************************************/
Route::get('/logout',config('routing.application.modules.dashboard.researcher.controller').'\Authorization\Logout\IndexController@index')->name(config('routing.application.modules.dashboard.researcher.name').'.authorization.logout');

/* Forgot
**************************************************************************************/
Route::prefix('forgot')->group(function(){

  /* Password
  **************************************************************************************/
  Route::prefix('password')->group(function(){

    /*  Index
    **************************************************************************************/
    Route::get('/',config('routing.application.modules.dashboard.researcher.controller').'\Authorization\ForgotPassword\IndexController@index')->name(config('routing.application.modules.dashboard.researcher.name').'.authorization.forgot_password');

    /*  Process
    **************************************************************************************/
    Route::post('/process',config('routing.application.modules.dashboard.researcher.controller').'\Authorization\ForgotPassword\IndexController@index')->name(config('routing.application.modules.dashboard.researcher.name').'.authorization.forgot_password.update');

  }); //End Password

}); //End Forgot
