<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

//Get Class
class RouteServiceProvider extends ServiceProvider{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    // public const HOME = '/home';

    //Path Controller
    protected $namespace = 'App\Http\Controllers';

    //Path Base
    protected $path;

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    // public function boot(): void{
    //     RateLimiter::for('api', function (Request $request) {
    //         return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
    //     });
    //
    //     $this->routes(function () {
    //         Route::middleware('api')
    //             ->prefix('api')
    //             ->group(base_path('routes/api.php'));
    //
    //         Route::middleware('web')
    //             ->group(base_path('routes/web.php'));
    //     });
    // }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void{

      //Set Path
      $this->setPath();

      //Map Web Routes
      $this->mapWebRoutes();

      //Map Api Routes
      //$this->mapApiRoutes();

    }

    /**
     * Define the path for the route application.
     *
     * @return void
     */
    public function setPath(){

      //Configuration
      $this->path['main'] = 'routes/';

      //Configuration
      $this->path['configuration'] = 'routes/application/modules/configuration/';

      //Authorization - Employee
      $this->path['authorization']['employee'] = 'routes/application/modules/dashboard/employee/authorization/';

      //Authorization - Researcher
      $this->path['authorization']['researcher'] = 'routes/application/modules/dashboard/researcher/authorization/';

      //Dashboard
      $this->path['ajax']['dashboard']['employee'] = 'routes/application/modules/dashboard/employee/ajax/';

      //Dashboard
      $this->path['ajax']['dashboard']['researcher'] = 'routes/application/modules/dashboard/researcher/ajax/';


      //Dashboard - Employee
      $this->path['dashboard']['employee'] = 'routes/application/modules/dashboard/employee/';

      //Dashboard - Researcher
      $this->path['dashboard']['researcher'] = 'routes/application/modules/dashboard/researcher/';

      //Landing
      $this->path['landing'] = 'routes/application/modules/landing/';

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes(){

      //Middleware Web
      Route::middleware(['web'])->namespace($this->namespace)
                                ->group(function($router){

          //Main
          require base_path($this->path['main'].'web.php');

          //Configuration
          require base_path($this->path['configuration'].'web.php');
          require base_path($this->path['configuration'].'ajax.php');

          require base_path($this->path['landing'].'cervie/index.php');

          /* Authorization
          **************************************************************************************/
          Route::prefix('authorization')->group(function(){

            /* Employee
            **************************************************************************************/
            Route::prefix('employee')->group(function(){

              // Authorization - Employee
              require base_path($this->path['authorization']['employee'].'index.php');

            }); //End Employee

            /* Researcher
            **************************************************************************************/
            Route::prefix('researcher')->group(function(){

              // Authorization - Researcher
              require base_path($this->path['authorization']['researcher'].'index.php');

              // Ajax - Researcher - Academic Qualification
              require base_path($this->path['ajax']['dashboard']['researcher'].'university/cervie/qualification/index.php');

              // Ajax - Researcher - Academic Qualification
              require base_path($this->path['ajax']['dashboard']['researcher'].'university/cervie/linkage/index.php');

              // Ajax - Researcher - Academic Qualification
              require base_path($this->path['ajax']['dashboard']['researcher'].'university/cervie/evidence/index.php');

            }); //End Employee

          }); //End Authorization

        });

        /**************************************************************************************
          Middleware - LDAP Employee
        **************************************************************************************/
        Route::middleware(['auth:ldap_employee','navigation_access:employee'])->namespace($this->namespace)
        // Route::middleware(['auth:ldap_employee'])->namespace($this->namespace)
                                                 ->group(function($router){

           /* Employee
           **************************************************************************************/
           Route::prefix('employee')->group(function(){

             /* Dashboard
             **************************************************************************************/
             Route::prefix('dashboard')->group(function(){

               //Home
               require base_path($this->path['dashboard']['employee'].'home/index.php');

               //Account
               require base_path($this->path['dashboard']['employee'].'account/index.php');

               //Researcher
               require base_path($this->path['dashboard']['employee'].'researcher/index.php');

               //Ajax
               require base_path($this->path['dashboard']['employee'].'ajax/authorization/access/index.php');



             }); //End Dashboard

           }); //End Employee

        }); //End Middleware - LDAP Employee

        /**************************************************************************************
          Middleware - LDAP Researcher
        **************************************************************************************/
        Route::middleware(['auth:ldap_employee','navigation_access_researcher'])->namespace($this->namespace)
        // Route::middleware(['auth:ldap_employee','navigation_access_researcher'])->namespace($this->namespace)
        // Route::middleware(['auth:ldap_employee'])->namespace($this->namespace)
                                                 ->group(function($router){

           /* Employee
           **************************************************************************************/
           // Route::prefix('researcher/{employee_id?}')->group(function(){
           Route::prefix('researcher')->group(function(){

             /* Dashboard
             **************************************************************************************/
             Route::prefix('dashboard')->group(function(){

                //Home
                require base_path($this->path['dashboard']['researcher'].'home/index.php');

                //Insight
                require base_path($this->path['dashboard']['researcher'].'insight/index.php');

                //General Information
                require base_path($this->path['dashboard']['researcher'].'general/information/index.php');

                //Qualification
                require base_path($this->path['dashboard']['researcher'].'qualification/index.php');

                //Publication
                require base_path($this->path['dashboard']['researcher'].'publication/index.php');

                //Award
                require base_path($this->path['dashboard']['researcher'].'award/index.php');

                //Grant
                require base_path($this->path['dashboard']['researcher'].'grant/index.php');

                //Stewardship
                require base_path($this->path['dashboard']['researcher'].'stewardship/index.php');

                //Recognition
                require base_path($this->path['dashboard']['researcher'].'recognition/index.php');

                //Intellectual Property
                require base_path($this->path['dashboard']['researcher'].'intellectual/property/index.php');

                //Linkage
                require base_path($this->path['dashboard']['researcher'].'linkage/index.php');

                //Postgraduate Supervision
                require base_path($this->path['dashboard']['researcher'].'postgraduate_supervision/index.php');

                //Community Engagement
                require base_path($this->path['dashboard']['researcher'].'community_engagement/index.php');

                //Consultancies
                require base_path($this->path['dashboard']['researcher'].'consultancies/index.php');

                //Commercialization
                require base_path($this->path['dashboard']['researcher'].'commercialization/index.php');

             }); //End Dashboard

           }); //End Employee

        }); //End Middleware - LDAP Employee

    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes(){

        // echo 'RouteServiceProvider mapApiRoutes';
        Route::prefix('api')
            // ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path($this->path['api'].'employee/index.php'));
    }

}
