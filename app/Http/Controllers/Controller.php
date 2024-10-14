<?php

//Get Controller Path
namespace App\Http\Controllers;

//Get DispatchesJobs
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

//Get View
use View;

//Get Carbon
use Carbon\Carbon;

//Get Helpers
use App\Http\Helpers\Token;

//Get Database
use DB;

//Get Class
class Controller extends BaseController{

  //Use AuthorizesRequests, DispatchesJobs, ValidatesRequests
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  //Set Encrypt Token Form
  protected $encrypt_token_form;

  //Set Encrypter
  protected $encrypter;

  //Set Encrypter
  protected $setting;

  //Set Database Name
  protected $database_name;

  //Set Guard
  protected $guard;

  /**************************************************************************************
    Construct
  **************************************************************************************/
  public function __construct(Request $request){

    //Get Token
    $token = new Token();

    //Set Encrypt Token Form
    $this->encrypt_token_form = $token->encrypt;

    //Set Encrypter
    $this->encrypter = $token->encrypter;

    //Get Navigation
    $this->navigation();

    //Check Session Has authorization Code
    if(session()->has('authorization_code')){

      //Set Guard Encryption
      $this->guard = $this->encrypter->decrypt(session()->get('authorization_token'));

      //Get Guard
      switch($this->guard){

        //Employee Franchise
        case 'ldap_employee':

          //Set Navigation Access By Module

        break;

        default:
          // code...
        break;

      }

    }

  }

  /**************************************************************************************
    Navigation
  **************************************************************************************/
  public function navigation(){

    //Set Navigation
    $this->navigation = [

      //Hyperlink
      'hyperlink'=>[

        'home'=>config('routing.application.modules.landing.name').'.home',

        //Header
        'header'=>[
          'home'=>config('routing.application.modules.landing.name').'.home',
          'login'=>config('routing.application.modules.dashboard.employee.name').'.authorization.login',
          'logout'=>config('routing.application.modules.dashboard.employee.name').'.authorization.logout',
        ],

        //Authorization
        'authorization'=>[

          //Employee
          'employee'=>[
            'login'=>config('routing.application.modules.dashboard.employee.name').'.authorization.login',
            'forgot'=>config('routing.application.modules.dashboard.employee.name').'.authorization.forgot',
            'home'=>config('routing.application.modules.dashboard.employee.name').'.home',
            'header'=>[
              'account'=>[
                'profile'=>config('routing.application.modules.dashboard.employee.name').'.account.profile.view',
                'change_password'=>config('routing.application.modules.dashboard.employee.name').'.account.change_password.index',
                'logout'=>config('routing.application.modules.dashboard.employee.name').'.authorization.logout',
              ]
            ],
            'sidebar'=>[
              'quick_link'=>[
                'account'=>[
                  'profile'=>config('routing.application.modules.dashboard.employee.name').'.account.profile.view'
                ]
              ],
              'home'=>config('routing.application.modules.dashboard.employee.name').'.home',
            ],

          ],

          //Researcher
          'researcher'=>[
            'login'=>config('routing.application.modules.dashboard.researcher.name').'.authorization.login',
            'forgot'=>config('routing.application.modules.dashboard.researcher.name').'.authorization.forgot',
            'home'=>config('routing.application.modules.dashboard.researcher.name').'.home',
            'header'=>[
              'account'=>[
                // 'profile'=>config('routing.application.modules.dashboard.researcher.name').'.account.profile.view',
                // 'change_password'=>config('routing.application.modules.researcher.employee.name').'.account.change_password.index',
                'logout'=>config('routing.application.modules.dashboard.researcher.name').'.authorization.logout',
              ]
            ],
            'sidebar'=>[
              'right'=>[
                'home'=> config('routing.application.modules.dashboard.researcher.name').'.home',
                'general_information'=>config('routing.application.modules.dashboard.researcher.name').'.general.information.home.list',
                'qualification'=>config('routing.application.modules.dashboard.researcher.name').'.qualification.home.list',
                'publication'=>config('routing.application.modules.dashboard.researcher.name').'.publication.list',
<<<<<<< Updated upstream
                'qualification'=>config('routing.application.modules.dashboard.researcher.name').'.qualification.home.list',
                'general_information'=>config('routing.application.modules.dashboard.researcher.name').'.general.information.home.list'
=======
                'award'=>config('routing.application.modules.dashboard.researcher.name').'.award.list',
                'stewardship'=>config('routing.application.modules.dashboard.researcher.name').'.stewardship.list',
                'recognition'=>config('routing.application.modules.dashboard.researcher.name').'.recognition.list',
>>>>>>> Stashed changes
              ],
              'home'=>config('routing.application.modules.dashboard.employee.name').'.home',
            ],

          ],

        ],

        'layout'=>[
          'dashboard'=>[
            'employee'=>[
              'modal'=>[
                'pop_alert'=>config('routing.application.modules.dashboard.employee.layout').'.modal.other.pop_alert'
              ],
              'plugin'=>[
                'tags_input'=>config('routing.application.modules.dashboard.employee.layout').'.plugin.tags_input.index'
              ]
            ],
            'researcher'=>[
              'modal'=>[
                'pop_alert'=>config('routing.application.modules.dashboard.researcher.layout').'.modal.other.pop_alert'
              ],
              'plugin'=>[
                'tags_input'=>config('routing.application.modules.dashboard.researcher.layout').'.plugin.tags_input.index'
              ]
            ]
          ],
        ],

        'ajax'=>[
          'cart'=>[
            'list'=>config('routing.application.modules.landing.name').'.ajax.outlet.table.cart.list',
            'total'=>config('routing.application.modules.landing.name').'.ajax.outlet.table.cart.total',
            'update'=>config('routing.application.modules.landing.name').'.ajax.outlet.table.cart.item.update',
            'delete'=>config('routing.application.modules.landing.name').'.ajax.outlet.table.cart.item.delete'          ]
        ],

        'cart'=>[
          'checkout'=>config('routing.application.modules.landing.name').'.outlet.table.checkout',
        ],

        'social'=>[
          'facebook'=>'#',
          'twitter'=>'#',
          'dribbble'=>'#',
          'behance'=>'#',
        ]

      ]

    ];

  }

  /**************************************************************************************
    Check Browser
  **************************************************************************************/
  public function checkBrowser(){

    //Set Browser
    $browser = [];

    //Set Browser Application
    $browser['application'] = ['Opera','Edg','Chrome','Safari','Firefox','MSIE','Trident'];

    //Set Agent
    $agent = $_SERVER['HTTP_USER_AGENT'];

    //Loop Browser Application
    foreach($browser['application'] as $web_browser){

      //Check Agent and Browser is True
      if(strpos($agent, $web_browser) !== false){

        //Set Web Browser
        $browser['user']['application'] = $web_browser;

        break;

      }

    }

    //Get Browser User Application
    switch ($browser['user']['application']){

      //Internet Explorer
      case 'MSIE':
        $browser['user']['application_name'] = 'Internet Explorer';
      break;

      //Trident
      case 'Trident':
        $browser['user']['application_name'] = 'Internet Explorer';
      break;

      //Edge
      case 'Edg':
        $browser['user']['application_name'] = 'Microsoft Edge';
      break;

    }

    //Return Browser
    return $browser;

    //For Debugging
    echo "You are using ".$browser['user']['application_name']." browser";

  }

  /**************************************************************************************
    Encryption Data
  **************************************************************************************/
  public function encryptionData($data){

		//Password Encrypt Key
		$encrypt['key'] = 'U5c1H073L';

    //Set Algorithm
		$encrypt['algorithm'] = 'AES-128-ECB';

		/*********************************************************************************
			Student Encryption
		*********************************************************************************/
		//String to Encrypt
		$encrypt['data'] = $data['encrypt'];

		//Encrypt Level One
		$encrypt['level_one'] = openssl_encrypt($encrypt['data'],$encrypt['algorithm'],$encrypt['key']);

		//Encrypt Level Two
		$encrypt['level_two'] = base64_encode($encrypt['level_one']);

		//Get Result
		$result = $encrypt['level_two'];

		//Return Result
		return $result;

	}

}
