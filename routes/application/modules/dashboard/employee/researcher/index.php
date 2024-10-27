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
              Route::redirect('/','{employee_id}/tab/general_information/list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view');

              /* Tab Category
              **************************************************************************************/
              Route::prefix('tab')->group(function(){

                /* General
                **************************************************************************************/
                Route::prefix('general_information')->group(function(){

                  /* Information
                  **************************************************************************************/
                  // Route::prefix('information')->group(function(){

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

                  // }); //End Information

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

                  /*  Delete Team Member
                  **************************************************************************************/
                  Route::get('/team/member/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Grant\IndexController@deleteTeamMember')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.grant.team_member.delete');

                }); //End Grant


                /* Postgraduate Supervision
                **************************************************************************************/
                Route::prefix('postgraduate/supervision')->group(function() {

                    /* New
                    **************************************************************************************/
                    Route::get('/new', config('routing.application.modules.dashboard.employee.controller') . '\Researcher\Portfolio\Organization\User\Postgraduate\Supervision\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name') . '.researcher.portfolio.organization.user.view.postgraduate.supervision.new');

                    /* Create
                    **************************************************************************************/
                    Route::post('/create', config('routing.application.modules.dashboard.employee.controller') . '\Researcher\Portfolio\Organization\User\Postgraduate\Supervision\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name') . '.researcher.portfolio.organization.user.view.postgraduate.supervision.create');

                    /* List
                    **************************************************************************************/
                    Route::get('/list', config('routing.application.modules.dashboard.employee.controller') . '\Researcher\Portfolio\Organization\User\Postgraduate\Supervision\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name') . '.researcher.portfolio.organization.user.view.postgraduate.supervision.list');

                    /* Delete
                    **************************************************************************************/
                    Route::get('/delete', config('routing.application.modules.dashboard.employee.controller') . '\Researcher\Portfolio\Organization\User\Postgraduate\Supervision\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name') . '.researcher.portfolio.organization.user.view.postgraduate.supervision.delete');

                    /* Delete Evidence
                    **************************************************************************************/
                    Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller') . '\Researcher\Portfolio\Organization\User\Postgraduate\Supervision\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name') . '.researcher.portfolio.organization.user.view.postgraduate.supervision.evidence.delete');

                    /* View
                    **************************************************************************************/
                    Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller') . '\Researcher\Portfolio\Organization\User\Postgraduate\Supervision\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name') . '.researcher.portfolio.organization.user.view.postgraduate.supervision.view');

                    /* Update
                    **************************************************************************************/
                    Route::post('/update', config('routing.application.modules.dashboard.employee.controller') . '\Researcher\Portfolio\Organization\User\Postgraduate\Supervision\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name') . '.researcher.portfolio.organization.user.view.postgraduate.supervision.update');

                }); // End Postgraduate Supervision

                /* Award
                **************************************************************************************/
                Route::prefix('award')->group(function(){

                  /*  New
                  **************************************************************************************/
                  Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Award\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.award.new');

                  /*  Create
                  **************************************************************************************/
                  Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Award\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.award.create');

                  /*  List
                  **************************************************************************************/
                  Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Award\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.award.list');

                  /*  Delete
                  **************************************************************************************/
                  Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Award\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.award.delete');

                  /*  Delete Evidence
                  **************************************************************************************/
                  Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Award\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.award.evidence.delete');

                  /*  View
                  **************************************************************************************/
                  Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Award\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.award.view');

                  /*  Update
                  **************************************************************************************/
                  Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Award\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.award.update');

                }); //End Award

                /* Recognition
                **************************************************************************************/
                Route::prefix('recognition')->group(function(){

                  /*  New
                  **************************************************************************************/
                  Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Recognition\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.recognition.new');

                  /*  Create
                  **************************************************************************************/
                  Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Recognition\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.recognition.create');

                  /*  List
                  **************************************************************************************/
                  Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Recognition\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.recognition.list');

                  /*  Delete
                  **************************************************************************************/
                  Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Recognition\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.recognition.delete');

                  /*  Delete Evidence
                  **************************************************************************************/
                  Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Recognition\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.recognition.evidence.delete');

                  /*  View
                  **************************************************************************************/
                  Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Recognition\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.recognition.view');

                  /*  Update
                  **************************************************************************************/
                  Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Recognition\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.recognition.update');

                }); //End Recognition

                /* Stewardship
                **************************************************************************************/
                Route::prefix('stewardship')->group(function(){

                  /*  New
                  **************************************************************************************/
                  Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Stewardship\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.stewardship.new');

                  /*  Create
                  **************************************************************************************/
                  Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Stewardship\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.stewardship.create');

                  /*  List
                  **************************************************************************************/
                  Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Stewardship\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.stewardship.list');

                  /*  Delete
                  **************************************************************************************/
                  Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Stewardship\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.stewardship.delete');

                  /*  Delete Evidence
                  **************************************************************************************/
                  Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Stewardship\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.stewardship.evidence.delete');

                  /*  View
                  **************************************************************************************/
                  Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Stewardship\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.stewardship.view');

                  /*  Update
                  **************************************************************************************/
                  Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Stewardship\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.stewardship.update');

                }); //End Stewardship

                /* Qualification
                **************************************************************************************/
                Route::prefix('qualification')->group(function(){

                  /*  Home
                  **************************************************************************************/
                  Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Home\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.home.list');

                  /* Qualification - Academic
                  **************************************************************************************/
                  Route::prefix('academic')->group(function(){

                    /*  New
                    **************************************************************************************/
                    Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Academic\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.academic.new');

                    /*  Create
                    **************************************************************************************/
                    Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Academic\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.academic.create');

                    /*  List
                    **************************************************************************************/
                    Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Academic\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.academic.list');

                    /*  Delete
                    **************************************************************************************/
                    Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Academic\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.academic.delete');

                    /*  Delete Evidence
                    **************************************************************************************/
                    Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Academic\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.academic.evidence.delete');

                    /*  View
                    **************************************************************************************/
                    Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Academic\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.academic.view');

                    /*  Update
                    **************************************************************************************/
                    Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Academic\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.academic.update');

                  }); //End Qualification - Academic

                  /* Qualification - Professional
                  **************************************************************************************/
                  Route::prefix('professional')->group(function(){

                    /*  New
                    **************************************************************************************/
                    Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Professional\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.professional.new');

                    /*  Create
                    **************************************************************************************/
                    Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Professional\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.professional.create');

                    /*  List
                    **************************************************************************************/
                    Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Professional\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.professional.list');

                    /*  Delete
                    **************************************************************************************/
                    Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Professional\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.professional.delete');

                    /*  Delete Evidence
                    **************************************************************************************/
                    Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Professional\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.professional.evidence.delete');

                    /*  View
                    **************************************************************************************/
                    Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Professional\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.professional.view');

                    /*  Update
                    **************************************************************************************/
                    Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Qualification\Professional\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.qualification.professional.update');

                  }); //End Qualification - Professional


                }); //End Qualification

                /* Consultancies
                **************************************************************************************/
                Route::prefix('consultancies')->group(function(){

                  /*  New
                  **************************************************************************************/
                  Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Consultancies\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.consultancies.new');

                  /*  Create
                  **************************************************************************************/
                  Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Consultancies\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.consultancies.create');

                  /*  List
                  **************************************************************************************/
                  Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Consultancies\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.consultancies.list');

                  /*  Delete
                  **************************************************************************************/
                  Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Consultancies\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.consultancies.delete');

                  /*  Delete Evidence
                  **************************************************************************************/
                  Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Consultancies\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.consultancies.evidence.delete');

                  /*  View
                  **************************************************************************************/
                  Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Consultancies\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.consultancies.view');

                  /*  Update
                  **************************************************************************************/
                  Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Consultancies\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.consultancies.update');

                  /*  Delete Team Member
                  **************************************************************************************/
                  Route::get('/team/member/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Consultancies\IndexController@deleteTeamMember')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.consultancies.team_member.delete');

                }); //End Consultancies

                /* Linkage
                **************************************************************************************/
                Route::prefix('linkage')->group(function(){

                  /*  New
                  **************************************************************************************/
                  Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Linkage\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.linkage.new');

                  /*  Create
                  **************************************************************************************/
                  Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Linkage\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.linkage.create');

                  /*  List
                  **************************************************************************************/
                  Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Linkage\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.linkage.list');

                  /*  Delete
                  **************************************************************************************/
                  Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Linkage\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.linkage.delete');

                  /*  Delete Evidence
                  **************************************************************************************/
                  Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Linkage\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.linkage.evidence.delete');

                  /*  View
                  **************************************************************************************/
                  Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Linkage\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.linkage.view');

                  /*  Update
                  **************************************************************************************/
                  Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Linkage\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.linkage.update');

                  /*  Delete Team Member
                  **************************************************************************************/
                  Route::get('/team/member/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Linkage\IndexController@deleteTeamMember')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.linkage.team_member.delete');

                }); //End Linkage

                /* Commercialization
                **************************************************************************************/
                Route::prefix('commercialization')->group(function(){

                  /*  New
                  **************************************************************************************/
                  Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Commercialization\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.commercialization.new');

                  /*  Create
                  **************************************************************************************/
                  Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Commercialization\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.commercialization.create');

                  /*  List
                  **************************************************************************************/
                  Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Commercialization\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.commercialization.list');

                  /*  Delete
                  **************************************************************************************/
                  Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Commercialization\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.commercialization.delete');

                  /*  Delete Evidence
                  **************************************************************************************/
                  Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Commercialization\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.commercialization.evidence.delete');

                  /*  View
                  **************************************************************************************/
                  Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Commercialization\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.commercialization.view');

                  /*  Update
                  **************************************************************************************/
                  Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Commercialization\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.commercialization.update');

                  /*  Delete Team Member
                  **************************************************************************************/
                  Route::get('/team/member/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Commercialization\IndexController@deleteTeamMember')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.commercialization.team_member.delete');

                }); //End Commercialization

                /* Intellectual
                **************************************************************************************/
                Route::prefix('intellectual_property')->group(function(){

                    /* Property
                    **************************************************************************************/
                    // Route::prefix('property')->group(function(){

                        // /*  List
                        // **************************************************************************************/
                        // Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Home\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.home.list');

                        /* Patent
                        **************************************************************************************/
                        Route::prefix('patent')->group(function(){

                            /*  New
                            **************************************************************************************/
                            Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Patent\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.patent.new');

                            /*  Create
                            **************************************************************************************/
                            Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Patent\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.patent.create');

                            /*  List
                            **************************************************************************************/
                            Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Patent\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.patent.list');

                            /*  Delete
                            **************************************************************************************/
                            Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Patent\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.patent.delete');

                            /*  Delete Evidence
                            **************************************************************************************/
                            Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Patent\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.patent.evidence.delete');

                            /*  View
                            **************************************************************************************/
                            Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Patent\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.patent.view');

                            /*  Update
                            **************************************************************************************/
                            Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Patent\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.patent.update');

                        }); //End Patent

                        /* Licensing
                        **************************************************************************************/
                        Route::prefix('licensing')->group(function(){

                            /*  New
                            **************************************************************************************/
                            Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Licensing\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.licensing.new');

                            /*  Create
                            **************************************************************************************/
                            Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Licensing\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.licensing.create');

                            /*  List
                            **************************************************************************************/
                            Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Licensing\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.licensing.list');

                            /*  Delete
                            **************************************************************************************/
                            Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Licensing\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.licensing.delete');

                            /*  Delete Evidence
                            **************************************************************************************/
                            Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Licensing\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.licensing.evidence.delete');

                            /*  View
                            **************************************************************************************/
                            Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Licensing\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.licensing.view');

                            /*  Update
                            **************************************************************************************/
                            Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Licensing\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.licensing.update');

                        }); //End Licensing

                        /* Copyright
                        **************************************************************************************/
                        Route::prefix('copyright')->group(function(){

                            /*  New
                            **************************************************************************************/
                            Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Copyright\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.copyright.new');

                            /*  Create
                            **************************************************************************************/
                            Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Copyright\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.copyright.create');

                            /*  List
                            **************************************************************************************/
                            Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Copyright\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.copyright.list');

                            /*  Delete
                            **************************************************************************************/
                            Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Copyright\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.copyright.delete');

                            /*  Delete Evidence
                            **************************************************************************************/
                            Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Copyright\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.copyright.evidence.delete');

                            /*  View
                            **************************************************************************************/
                            Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Copyright\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.copyright.view');

                            /*  Update
                            **************************************************************************************/
                            Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Copyright\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.copyright.update');

                        }); //End Copyright

                        /* Trademark
                        **************************************************************************************/
                        Route::prefix('trademark')->group(function(){

                            /*  New
                            **************************************************************************************/
                            Route::get('/new', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Trademark\IndexController@new')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.trademark.new');

                            /*  Create
                            **************************************************************************************/
                            Route::post('/create', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Trademark\IndexController@create')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.trademark.create');

                            /*  List
                            **************************************************************************************/
                            Route::get('/list', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Trademark\IndexController@list')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.trademark.list');

                            /*  Delete
                            **************************************************************************************/
                            Route::get('/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Trademark\IndexController@delete')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.trademark.delete');

                            /*  Delete Evidence
                            **************************************************************************************/
                            Route::get('/evidence/delete', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Trademark\IndexController@deleteEvidence')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.trademark.evidence.delete');

                            /*  View
                            **************************************************************************************/
                            Route::get('/view/{id}', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Trademark\IndexController@view')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.trademark.view');

                            /*  Update
                            **************************************************************************************/
                            Route::post('/update', config('routing.application.modules.dashboard.employee.controller').'\Researcher\Portfolio\Organization\User\Intellectual\Property\Trademark\IndexController@update')->name(config('routing.application.modules.dashboard.employee.name').'.researcher.portfolio.organization.user.view.intellectual.property.trademark.update');

                        }); //End Trademark

                    // }); //End Property

                }); //End Intellectual



              }); //End Tab

            }); //End Employee ID

          }); //End View

        }); //End User

      }); //End Organization ID

    }); // End Organization

  }); // End Portfolio

}); //End Researcher
