<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Announcement
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Researcher
**************************************************************************************/
Route::prefix('researcher')->group(function(){

  /* Portfolio
  **************************************************************************************/
  Route::prefix('portfolio')->group(function(){

    /* Organization
    **************************************************************************************/
    Route::prefix('organization')->group(function(){

      /*  Home
      **************************************************************************************/
      Route::get('/home',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\Home\IndexController@index')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.home');

      /* Organization ID
      **************************************************************************************/
      Route::prefix('{organization_id}')->group(function(){

        /* User
        **************************************************************************************/
        Route::prefix('user')->group(function(){

          /*  List
          **************************************************************************************/
          Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.list');

          /* View
          **************************************************************************************/
          Route::prefix('view')->group(function(){

            /* Employee ID
            **************************************************************************************/
            Route::prefix('{employee_id}')->group(function(){

              /**************************************************************************************
                Redirect Researcher to Default Page
              **************************************************************************************/
              Route::redirect('/','{employee_id}/tab/general/information/list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view');

              /* Tab Category
              **************************************************************************************/
              Route::prefix('tab')->group(function(){

                /* General
                **************************************************************************************/
                Route::prefix('general')->group(function(){

                  /* Information
                  **************************************************************************************/
                  Route::prefix('information')->group(function(){

                    /*  Home
                    **************************************************************************************/
                    Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Home\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.home.list');

                    /* Position
                    **************************************************************************************/
                    Route::prefix('position')->group(function(){

                      /*  New
                      **************************************************************************************/
                      Route::get('/new',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Position\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.position.new');

                      /*  Create
                      **************************************************************************************/
                      Route::post('/create',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Position\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.position.create');

                      /*  List
                      **************************************************************************************/
                      Route::get('/list',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Position\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.position.list');

                      /*  Delete
                      **************************************************************************************/
                      Route::get('/delete',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Position\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.position.delete');

                      /*  Delete Evidence
                      **************************************************************************************/
                      Route::get('/evidence/delete',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Position\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.position.evidence.delete');

                      /*  View
                      **************************************************************************************/
                      Route::get('/view/{id}',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Position\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.position.view');

                      /*  Update
                      **************************************************************************************/
                      Route::post('/update',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Position\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.position.update');

                    }); //End Position

                    /* Area Interest
                    **************************************************************************************/
                    Route::prefix('area_interest')->group(function(){

                      /*  New
                      **************************************************************************************/
                      Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Area\Interest\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.area.interest.new');

                      /*  Create
                      **************************************************************************************/
                      Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Area\Interest\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.area.interest.create');

                      /*  List
                      **************************************************************************************/
                      Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Area\Interest\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.area.interest.list');

                      /*  Delete
                      **************************************************************************************/
                      Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Area\Interest\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.area.interest.delete');

                      /*  View
                      **************************************************************************************/
                      Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Area\Interest\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.area.interest.view');

                      /*  Update
                      **************************************************************************************/
                      Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Area\Interest\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.area.interest.update');

                    }); //End Area Interest

                    /* Work Experience
                    **************************************************************************************/
                    Route::prefix('work_experience')->group(function(){

                      /*  New
                      **************************************************************************************/
                      Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Work\Experience\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.work.experience.new');

                      /*  Create
                      **************************************************************************************/
                      Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Work\Experience\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.work.experience.create');

                      /*  List
                      **************************************************************************************/
                      Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Work\Experience\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.work.experience.list');

                      /*  Delete
                      **************************************************************************************/
                      Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Work\Experience\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.work.experience.delete');

                      /*  Delete Evidence
                      **************************************************************************************/
                      Route::get('/evidence/delete',config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Work\Experience\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.work.experience.evidence.delete');

                      /*  View
                      **************************************************************************************/
                      Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Work\Experience\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.work.experience.view');

                      /*  Update
                      **************************************************************************************/
                      Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Work\Experience\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.work.experience.update');

                    }); //End Work Experience

                    /* Professional Membership
                    **************************************************************************************/
                    Route::prefix('professional_membership')->group(function(){

                      /*  New
                      **************************************************************************************/
                      Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Professional\Membership\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.professional.membership.new');

                      /*  Create
                      **************************************************************************************/
                      Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Professional\Membership\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.professional.membership.create');

                      /*  List
                      **************************************************************************************/
                      Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Professional\Membership\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.professional.membership.list');

                      /*  Delete
                      **************************************************************************************/
                      Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Professional\Membership\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.professional.membership.delete');

                      /*  Delete Evidence
                      **************************************************************************************/
                      Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Professional\Membership\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.professional.membership.evidence.delete');

                      /*  View
                      **************************************************************************************/
                      Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Professional\Membership\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.professional.membership.view');

                      /*  Update
                      **************************************************************************************/
                      Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\General\Information\Professional\Membership\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.general.information.professional.membership.update');

                    }); //End Professional Membership

                  }); //End Information

                }); //End General

                /* Publication
                **************************************************************************************/
                Route::prefix('publication')->group(function(){

                  /*  New
                  **************************************************************************************/
                  Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Publication\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.publication.new');

                  /*  Create
                  **************************************************************************************/
                  Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Publication\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.publication.create');

                  /*  List
                  **************************************************************************************/
                  Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Publication\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.publication.list');

                  /*  Delete
                  **************************************************************************************/
                  Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Publication\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.publication.delete');

                  /*  View
                  **************************************************************************************/
                  Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Publication\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.publication.view');

                  /*  Update
                  **************************************************************************************/
                  Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Publication\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.publication.update');

                }); //End Publication

                /* Grant
                **************************************************************************************/
                Route::prefix('grant')->group(function(){

                  /*  New
                  **************************************************************************************/
                  Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Grant\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.grant.new');

                  /*  Create
                  **************************************************************************************/
                  Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Grant\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.grant.create');

                  /*  List
                  **************************************************************************************/
                  Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Grant\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.grant.list');

                  /*  Delete
                  **************************************************************************************/
                  Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Grant\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.grant.delete');

                  /*  Delete Evidence
                  **************************************************************************************/
                  Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Grant\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.grant.evidence.delete');

                  /*  View
                  **************************************************************************************/
                  Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Grant\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.grant.view');

                  /*  Update
                  **************************************************************************************/
                  Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Grant\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.grant.update');

                }); //End Grant


              }); //End Tab

            }); //End Employee ID

          }); //End View

        }); //End User

      }); //End Organization ID

    }); // End Organization

  }); // End Portfolio

}); //End Researcher
