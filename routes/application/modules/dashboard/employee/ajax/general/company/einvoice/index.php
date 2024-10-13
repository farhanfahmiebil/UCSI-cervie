<?php


/*
|--------------------------------------------------------------------------
| Web Routes - Ajax
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Ajax
**************************************************************************************/
Route::prefix('ajax')->group(function(){

  /* General
  **************************************************************************************/
  Route::prefix('general')->group(function(){

    /* Company
    **************************************************************************************/
    Route::prefix('company')->group(function(){

      /* Api
      **************************************************************************************/
      Route::prefix('api')->group(function(){

        /*  Index
        **************************************************************************************/
        Route::get('/einvoice',config('routing.application.modules.dashboard.employee.controller').'\Ajax\General\Company\Einvoice\IndexController@apiInformation')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.general.company.api.einvoice');

        /* Login
        **************************************************************************************/
        Route::prefix('login')->group(function(){

          /* Tax
          **************************************************************************************/
          Route::prefix('tax')->group(function(){

            /* Payer
            **************************************************************************************/
            Route::prefix('payer')->group(function(){

              /*  Index
              **************************************************************************************/
              Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Ajax\General\Company\Einvoice\IndexController@loginTaxPayer')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.general.company.api.einvoice.login.tax_payer');

              /* Access
              **************************************************************************************/
              Route::prefix('access')->group(function(){

                /*  Access Token
                **************************************************************************************/
                Route::get('/token',config('routing.application.modules.dashboard.employee.controller').'\Ajax\General\Company\Einvoice\IndexController@accessToken')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.general.company.api.einvoice.login.tax_payer.access_token');

              }); //End Access

            }); //End Payer

          }); //End Tax

        }); //End Login

        /* Verification
        **************************************************************************************/
        Route::prefix('verification')->group(function(){

          /* TIN
          **************************************************************************************/
          Route::prefix('tin')->group(function(){

            /*  Index
            **************************************************************************************/
            Route::get('/',config('routing.application.modules.dashboard.employee.controller').'\Ajax\General\Company\Einvoice\IndexController@verificationCompanyTIN')->name(config('routing.application.modules.dashboard.employee.name').'.ajax.general.company.api.einvoice.verification.company.tin');

          }); //End TIN

        }); //End Verification

      }); //End Api

    }); //End Company

  }); //End General

}); //End Ajax
