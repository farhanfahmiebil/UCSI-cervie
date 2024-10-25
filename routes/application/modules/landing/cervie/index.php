<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Landing Page - CERVIE
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*  Home
**************************************************************************************/
Route::get('/home',config('routing.application.modules.landing.cervie.controller').'\Home\IndexController@index')->name(config('routing.application.modules.landing.cervie.name').'.home');

/* Researcher
**************************************************************************************/
Route::prefix('researcher')->group(function(){

  //View
  Route::get('/view/{employee_id}',config('routing.application.modules.landing.cervie.controller').'\Researcher\IndexController@view')->name(config('routing.application.modules.landing.cervie.name').'.ressearcher.view');

}); //End Researcher
