<?php

//Get Namespace
namespace App\Exceptions;

//Get Exception Handler
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

//Get Http Exception
use Symfony\Component\HttpKernel\Exception\HttpException;

//Get Throwable
use Throwable;

//Get Class
class Handler extends ExceptionHandler{

  //Set Hyperlink
  public $hyperlink;

  //Application
  protected $application = 'application';

  //User
  protected $user = 'error';

  /**
   * The list of the inputs that are never flashed to the session on validation exceptions.
   *
   * @var array<int, string>
   */
  protected $dontFlash = [
      'current_password',
      'password',
      'password_confirmation',
  ];

  /**************************************************************************************
    Route Path
  **************************************************************************************/
  public function routePath(){

    //Set Route View
		$this->route['view'] = config('routing.'.$this->application.'.modules.'.$this->user.'.view').'.';

  }

  /**
   * Register the exception handling callbacks for the application.
   */
  public function register(): void{

    $this->reportable(function (Throwable $e){
        //
    });

  }

  /**************************************************************************************
    Render
  **************************************************************************************/
  function render($request, Throwable $exception){

    //Get Route Path
    $this->routePath();

    if($this->isHttpException($exception)){

      switch($exception->getStatusCode()){

        //401
        case 401:
          return response()->view($this->route['view'].'401', [], 401);
        break;

        //403
        case 403:
          return response()->view($this->route['view'].'403', [], 403);
        break;

        //404
        case 404:
          return response()->view($this->route['view'].'404', [], 404);
        break;

        //428
        case 428:
          return response()->view($this->route['view'].'428', [], 428);
        break;

        //500
        case 500:
          return response()->view($this->route['view'].'500', [], 500);
        break;

        //501
        case 501:
          return response()->view($this->route['view'].'501', [], 501);
        break;

        //555
        case 555:
          return response()->view($this->route['view'].'555', compact('exception'), 555);
        break;

        //Default
        default:
          // Handle other status codes if needed
        break;

      }

    }

    return parent::render($request, $exception);

  }

}
