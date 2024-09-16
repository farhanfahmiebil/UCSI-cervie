<?php

//Get Helper Path
namespace App\Http\Helpers;

//Class Name
class Encryption{

  //Set Data Transport
  public $data;

  //Set Encrypt
  public $encrypt;
  public $encrypter;

  /**************************************************************************************
    Construct
  **************************************************************************************/
  public function __construct(){

    //Get Encrypter
    $this->encrypter = app('Illuminate\Contracts\Encryption\Encrypter');

  }

  /**************************************************************************************
    Set Encryption
  **************************************************************************************/
  public static function setEncrytion($data){

    //Return Encryption
    return $this->encrypter->encrypt($data);

  }

}
