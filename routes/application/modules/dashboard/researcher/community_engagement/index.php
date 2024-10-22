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

/* Community Engagement
**************************************************************************************/
Route::prefix('community/engagement')->group(function(){

  /*  New
  **************************************************************************************/
  Route::get('/new/', config('routing.application.modules.dashboard.researcher.controller') . '\CommunityEngagement\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name') . '.community_engagement.new');

  /*  Create
  **************************************************************************************/
  Route::post('/create', config('routing.application.modules.dashboard.researcher.controller') . '\CommunityEngagement\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name') . '.community_engagement.create');

  /*  List
  **************************************************************************************/
  Route::get('/list', config('routing.application.modules.dashboard.researcher.controller') . '\CommunityEngagement\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name') . '.community_engagement.list');

  /*  Delete
  **************************************************************************************/
  Route::get('/delete', config('routing.application.modules.dashboard.researcher.controller') . '\CommunityEngagement\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name') . '.community_engagement.delete');

  /*  Delete Evidence
  **************************************************************************************/
  Route::get('/evidence/delete', config('routing.application.modules.dashboard.researcher.controller') . '\CommunityEngagement\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.researcher.name') . '.community_engagement.evidence.delete');

  /*  Delete Team Member
  **************************************************************************************/
  Route::get('/team/member/delete', config('routing.application.modules.dashboard.researcher.controller').'\CommunityEngagement\IndexController@deleteTeamMember')->name(config('routing.application.modules.dashboard.researcher.name').'.community_engagement.team_member.delete');

  /*  View
  **************************************************************************************/
  Route::get('/view/{id}', config('routing.application.modules.dashboard.researcher.controller') . '\CommunityEngagement\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name') . '.community_engagement.view');

  /*  Update
  **************************************************************************************/
  Route::post('/update', config('routing.application.modules.dashboard.researcher.controller') . '\CommunityEngagement\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name') . '.community_engagement.update');

}); //End Community Engagement
