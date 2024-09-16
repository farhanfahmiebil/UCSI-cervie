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

/* General Information
**************************************************************************************/
Route::prefix('general_information')->group(function(){

  /*  List
  **************************************************************************************/
  Route::get('/list',config('routing.application.modules.dashboard.researcher.controller').'\GeneralInformation\Home\IndexController@list')->name(config('routing.application.modules.dashboard.researcher.name').'.general_information.home.list');

  /* Work Experience
  **************************************************************************************/
  Route::prefix('general_information')->group(function(){

    /*  New
    **************************************************************************************/
    Route::get('/new',config('routing.application.modules.dashboard.researcher.controller').'\GeneralInformation\WorkExperience\IndexController@new')->name(config('routing.application.modules.dashboard.researcher.name').'.general_information.work_experience.new');

    /*  Create
    **************************************************************************************/
    Route::get('/create',config('routing.application.modules.dashboard.researcher.controller').'\GeneralInformation\WorkExperience\IndexController@create')->name(config('routing.application.modules.dashboard.researcher.name').'.general_information.work_experience.create');

    /*  Delete
    **************************************************************************************/
    Route::get('/delete',config('routing.application.modules.dashboard.researcher.controller').'\GeneralInformation\WorkExperience\IndexController@delete')->name(config('routing.application.modules.dashboard.researcher.name').'.general_information.work_experience.delete');

    /*  View
    **************************************************************************************/
    Route::get('/view/{id}',config('routing.application.modules.dashboard.researcher.controller').'\GeneralInformation\WorkExperience\IndexController@view')->name(config('routing.application.modules.dashboard.researcher.name').'.general_information.work_experience.view');

    /*  Update
    **************************************************************************************/
    Route::get('/update',config('routing.application.modules.dashboard.researcher.controller').'\GeneralInformation\WorkExperience\IndexController@update')->name(config('routing.application.modules.dashboard.researcher.name').'.general_information.work_experience.update');

  }); //End Work Experience

}); //End General Information
