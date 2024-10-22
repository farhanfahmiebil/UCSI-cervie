<?php


/*
|--------------------------------------------------------------------------
// Web Routes - Home
|--------------------------------------------------------------------------
//
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
//
*/

/* Grant
**************************************************************************************/
Route::prefix('grant')->group(function(){

  /*  New
  **************************************************************************************/
  Route::get('/new/', config('routing.application.modules.dashboard.researcher.controller').'\Grant\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.grant.new');

  /*  Create
  **************************************************************************************/
  Route::post('/create', config('routing.application.modules.dashboard.researcher.controller').'\Grant\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.grant.create');

  /*  List
  **************************************************************************************/
  Route::get('/list', config('routing.application.modules.dashboard.researcher.controller').'\Grant\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.grant.list');

  /*  Delete
  **************************************************************************************/
  Route::get('/delete', config('routing.application.modules.dashboard.researcher.controller').'\Grant\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.grant.delete');

  /*  Delete Evidence
  **************************************************************************************/
  Route::get('/evidence/delete', config('routing.application.modules.dashboard.researcher.controller').'\Grant\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name').'.grant.evidence.delete');

  /*  Delete Team Member
  **************************************************************************************/
  Route::get('/team/member/delete', config('routing.application.modules.dashboard.researcher.controller').'\Grant\IndexController@deleteTeamMember')->name(config('routing.application.modules.dashboard.researcher.name').'.grant.team_member.delete');

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}', config('routing.application.modules.dashboard.researcher.controller').'\Grant\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.grant.view');

  /*  Update
  **************************************************************************************/
  Route::post('/update', config('routing.application.modules.dashboard.researcher.controller').'\Grant\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.grant.update');

}); //End Grant
