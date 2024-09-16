<?php

/* AJAX
**************************************************************************************/
Route::prefix('/ajax')->group(function(){

  /**************************************************************************************
    Configuration
  **************************************************************************************/
  Route::prefix('/configuration')->group(function(){

    /**************************************************************************************
      By
    **************************************************************************************/
    Route::prefix('/by')->group(function(){

      /*  Type
      **************************************************************************************/
      Route::any('/type',config('routing.application.modules.configuration.controller').'\Ajax\ConfigurationController@index')->name(config('routing.application.modules.configuration.name').'.ajax.configuration.by.type');

  }); //End By

  }); //End Configuration

}); //End Ajax

?>
