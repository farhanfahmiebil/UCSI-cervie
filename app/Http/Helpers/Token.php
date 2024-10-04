<?php // Code within app\Helpers\Helper.php

//Get Helper Path
namespace App\Http\Helpers;

//DispatchesJobs
use Illuminate\Foundation\Bus\DispatchesJobs;

//Routing Controller
use Illuminate\Routing\Controller as BaseController;

//Validate Request
use Illuminate\Foundation\Validation\ValidatesRequests;

//Authorize Request
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

//Get Request
use Illuminate\Http\Request;

//Get Session
use Auth;

//Get Session
use Session;

//Get Carbon
use Carbon\Carbon;

//Class Name
class Token{

  //Set Usage
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  //Set Data Transport
  public $data;

  //Set Encrypt
  public $encrypt;
  public $encrypter;

  public function __construct(){

    //Get Encrypter
    $this->encrypter = app('Illuminate\Contracts\Encryption\Encrypter');

    //Create Token
    $this->encrypt['create'] = $this->encrypter->encrypt('create');
    $this->encrypt['update'] = $this->encrypter->encrypt('update');
    $this->encrypt['revert'] = $this->encrypter->encrypt('revert');
    $this->encrypt['delete'] = $this->encrypter->encrypt('delete');
    $this->encrypt['upload'] = $this->encrypter->encrypt('upload');
    $this->encrypt['synchronize'] = $this->encrypter->encrypt('synchronize');
    $this->encrypt['sort']   = $this->encrypter->encrypt('sort');
    $this->encrypt['filter'] = $this->encrypter->encrypt('filter');
    $this->encrypt['search'] = $this->encrypter->encrypt('search');

  }

}
