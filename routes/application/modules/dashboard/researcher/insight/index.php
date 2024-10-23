<?php


/*
|--------------------------------------------------------------------------
// Web Routes - Insight
|--------------------------------------------------------------------------
//
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
//
*/

/* Insight
**************************************************************************************/
Route::prefix('insight')->group(function(){

  /*  Home
  **************************************************************************************/
  Route::get('/home', config('routing.application.modules.dashboard.researcher.controller').'\Insight\Home\IndexController@index')->name(config('routing.application.modules.dashboard.researcher.name').'.insight.home');

}); //End Insight
