<?php

/*
|--------------------------------------------------------------------------
// Web Routes - Community Engagement
|--------------------------------------------------------------------------
//
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
//
//
*/

/* Community
**************************************************************************************/
Route::prefix('community')->group(function(){

  /* Engagement
  **************************************************************************************/
  Route::prefix('engagement')->group(function(){

    /*  New
    **************************************************************************************/
    Route::get('/new/', config('routing.application.modules.dashboard.researcher.controller') . '\Community\Engagement\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name') . '.community.engagement.new');

    /*  Create
    **************************************************************************************/
    Route::post('/create', config('routing.application.modules.dashboard.researcher.controller') . '\Community\Engagement\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name') . '.community.engagement.create');

    /*  List
    **************************************************************************************/
    Route::get('/list', config('routing.application.modules.dashboard.researcher.controller') . '\Community\Engagement\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name') . '.community.engagement.list');

    /*  Delete
    **************************************************************************************/
    Route::get('/delete', config('routing.application.modules.dashboard.researcher.controller') . '\Community\Engagement\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name') . '.community.engagement.delete');

    /*  Delete Evidence
    **************************************************************************************/
    Route::get('/evidence/delete', config('routing.application.modules.dashboard.researcher.controller') . '\Community\Engagement\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name') . '.community.engagement.evidence.delete');

    /*  Delete Team Member
    **************************************************************************************/
    Route::get('/team/member/delete', config('routing.application.modules.dashboard.researcher.controller').'\Community\Engagement\IndexController@deleteTeamMember')->name(config('routing.application.modules.dashboard.researcher.name').'.community.engagement.team_member.delete');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}', config('routing.application.modules.dashboard.researcher.controller') . '\Community\Engagement\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name') . '.community.engagement.view');

    /*  Update
    **************************************************************************************/
    Route::post('/update', config('routing.application.modules.dashboard.researcher.controller') . '\Community\Engagement\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name') . '.community.engagement.update');

  }); //End Engagement

}); //End Community
