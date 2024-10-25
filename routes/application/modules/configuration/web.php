<?php

/*
|--------------------------------------------------------------------------
| Web Routes for Configuration
|--------------------------------------------------------------------------
|
*/

/**************************************************************************************
  Redirect Command Prompt
**************************************************************************************/
Route::redirect('/','home');


/**************************************************************************************
  Maintenance
**************************************************************************************/
Route::get('/maintenance',function(){

  //Return View
  return view('maintenance.index');

})->name('maintenance');

/**************************************************************************************
[PHP-VERSION] - PHP Version
**************************************************************************************/
Route::get('/php/version',function(){

  //Return Result
  return phpinfo();

});

/**************************************************************************************
  Configuration Cache
**************************************************************************************/
Route::get('/configuration/clear',function(){

  //Application Clear
  $clear = Artisan::call('config:clear');

  //Return Result
  return 'Configuration Cache Clear Successfully.';

});

/**************************************************************************************
  Configuration Cache
**************************************************************************************/
Route::get('/configuration/cache',function(){

  //Configuration Cache
  $cache = Artisan::call('config:cache');

  //Application Cache
  $clear = Artisan::call('config:clear');

  //View Cache
  // $view = Artisan::call('view:clear');

  //Return Result
  return 'Configuration Cached Successfully.';

});

/**************************************************************************************
  Route Clear
**************************************************************************************/
Route::get('/route/clear',function(){

  //Application Route Clear
  $clear = Artisan::call('route:clear');

  //Return Result
  return 'Route Cache Cleared Successfully.';

});

/**************************************************************************************
  Route Cache
**************************************************************************************/
Route::get('/route/cache',function(){

  //Route Cache
  $cache = Artisan::call('route:cache');

  //Route Clear
  $clear = Artisan::call('route:clear');

  //Return Result
  return 'Route Cache Cleared and Cached Successfully.';

});

/**************************************************************************************
  Configuration Refresh
**************************************************************************************/
Route::get('/configuration/refresh',function(){

  //Application Route Optimize
  $clear = Artisan::call('optimize');

  //Application Cache Clear
  $clear = Artisan::call('config:clear');

  //Return Result
  return 'Optimize Route, File and Cache Clear!';

});

/**************************************************************************************
  Configuration Cache
**************************************************************************************/
Route::get('/configuration/optimize',function(){

  //Application Cache
  $clear = Artisan::call('optimize');

  //Return Result
  return 'Optimize File Clear!';

});

/**************************************************************************************
  Redirect Command Prompt
**************************************************************************************/
Route::redirect('/cmd','command/prompt');

/**************************************************************************************
  Command Prompt
**************************************************************************************/
Route::get('/command/prompt',config('routing.application.modules.configuration.controller').'\Command\Prompt\IndexController@index')->name(config('routing.application.modules.configuration.name').'.refresh');

/**************************************************************************************
  Route List
**************************************************************************************/
Route::get('/route/list',config('routing.application.modules.configuration.controller').'\Route\ListController@index')->name(config('routing.application.modules.configuration.name').'.route.list');

?>
