<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//
// Route::get('/', function () {
//     // return view('welcome');
//     return redirect('/authorization/employee/login');
// });

/**************************************************************************************
  Redirect Command Prompt
**************************************************************************************/
Route::redirect('/','command/prompt');
// Route::get('/',config('routing.application.modules.landing.controller').'\Outlet\Table\Home\RegisterController@register')->name(config('routing.application.modules.landing.name').'.outlet.table.register');
