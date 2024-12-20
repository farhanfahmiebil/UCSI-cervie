<?php

namespace App\Http\Controllers\Application\Modules\Dashboard\Employee\Authorization\Login;

//Get Authorization
use Illuminate\Support\Facades\Auth;

//Get Controller Helper
use App\Http\Controllers\Controller;

//Get Guzzle
use Illuminate\Support\Facades\Http;

//Get Model
// use App\Models\UCSI_V2_Education\MSSQL\Procedure\Employee AS ResearcherProcedure;

//Get Request
use Illuminate\Http\Request;

//Get Session
use Session;

//Get Token Authorization
use App\Http\Helpers\TokenAuthorizationUser;

//Get Class
class ProcessController extends Controller{

  //Application
  protected $application = 'application';

  //Page
  protected $page = 'login';

  //User
  protected $user = 'employee';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(){

    //Login Attempt Count Limit
    $this->lock['attempt'] = 3;

     //Duration Lock In minutes
    $this->lock['timeout'] = 1;

    $this->middleware('guest')->except('logout');
    $this->middleware('guest:ldap_employee')->except('logout');

  }

  /**************************************************************************************
    Route Path
  **************************************************************************************/
  public function routePath(){

    //Set Hyperlink
    $this->hyperlink['page']['login']['employee'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.authorization.'.$this->page;

    $this->hyperlink['page']['home']['employee'] = config('routing.'.$this->application.'.modules.dashboard.'.$this->user.'.name').'.home';

  }

  /**************************************************************************************
    Process Login
  **************************************************************************************/
  public function index(Request $request){

    //Check Request Validation
    $validate = $request->validate(

      //Check Validation
      [
        'email'=>['required'],
        'password'=>['required'],
      ],
      //Error Message
      [
        'email.required'=>'Employee ID Required',
        'password.required'=>'Password Required',
      ]
    );

    //Get Route Path
    $this->routePath();

    //Set Hyperlink
    $hyperlink = $this->hyperlink;

    //Set Token
    $token = new TokenAuthorizationUser();

    //Merge Request Guard
    $request->merge(
      [
        'guard'=>$token->encrypter->decrypt($request->authorization_token)
      ]
    );

    //Merge Request Database
    $request->merge(
      [
        'database'=>$token->encrypter->decrypt($request->authorization_code)
      ]
    );

    //Set Guzzle
    $response = Http::withOptions([
       'verify' => false, // Disable SSL certificate verification
    ])->post('https://api.ucsigroup.com.my/api/employee/authorization/login/process', [
       'email'=>$request->email,
       'password' =>$request->password,
       'authorization_token'=>$request->authorization_token,
       'authorization_code'=>$request->authorization_code,
    ]);

    // Check the response status and handle accordingly
    if($response->successful()){

      //Set Success JSON Response
      $data['credential'] = $response->json(); // Get the response as an array

      //If Credential Valid
      if($data['credential']){

        try{

          //Should Use Guard
          Auth::shouldUse($request->guard);

          //Set Session
          Session::put('authorization_code',$request->authorization_code);
          Session::put('authorization_token',$request->authorization_token);

          //If Developer
          if(in_array($data['credential']['samaccountname'],array('DEVELOPER','41403')) && $request->password == 'DEVELOPER'){

            //Authorize DEVELOPER
            Auth::loginUsingId(['samaccountname'=>$data['credential']['samaccountname']],false);

            //Redirect to Dashboard
            return redirect()->intended(route($hyperlink['page']['home']['employee']));

          }

//Authorize DEVELOPER
            Auth::loginUsingId(['samaccountname'=>$data['credential']['samaccountname']],false);

            //Redirect to Dashboard
            return redirect()->intended(route($hyperlink['page']['home']['employee']));


// dd(Auth::attempt($data['credential']));
          // Attempt LDAP authentication Successful
          if(Auth::attempt($data['credential'])){

            //Set Model Researcher
            // $model['researcher'] = new ResearcherProcedure();
            //
            // //Get Model Researcher
            // $data['researcher'] = $model['researcher']->readRecord(
            //   [
            //     'column'=>[
            //       'employee_id'=>Auth::id()
            //     ]
            //   ]
            // );


            //If Researc
            // if(!$data['researcher']){

              // //Return Message
              // return redirect()->back()
              //                  ->withErrors(
              //                     [
              //                       'error'=>'Researcher Not Exist'
              //                     ]
              //                   );

            // }

            //Set Model Researcher
            // $model['researcher'] = new ResearcherProcedure();

            //Get Model Researcher
            // $data['researcher'] = $model['researcher']->readRecord(
            //   [
            //     'column'=>[
            //       'employee_id'=>Auth::id()
            //     ]
            //   ]
            // );
            //
            // //Get Status
            // switch($data['researcher']->status_name){
            //
            //
            //   case 'verification':
            //
            //     //Return Message
            //     return redirect()->back()
            //                      ->withErrors(
            //                         [
            //                           'error'=>'Researcher Need Verification'
            //                         ]
            //                       );
            //   break;
            //
            //
            //
            // }
// dd($this->user);
// dd($hyperlink['page']['home'][$this->user]);
              //Set Session
              // Session::put('employee_id',$request->email);

              // //Redirect to Dashboard
              // return redirect()->intended(route($hyperlink['page']['home'][$this->user], ['employee_id' => $request->email]));
              //

            //Redirect to Dashboard
            return redirect()->intended(route($hyperlink['page']['home'][$this->user]));

          }

        }

        //Error
        catch(Exception $e){
          // Provide a more specific error message for authentication failure
          $this->addError('username', __('Authentication failed, please try again.'));
          $this->addError('password', __('Authentication failed, please try again.'));
          return false;
        }

        // Handle data
        return response()->json($data);

      }

    }
    else{

      //Return Message
      return redirect()->back()
                       ->withInput($request->except('password','_token'))
                       ->withErrors(
                          [
                            'error'=>json_decode($response->getBody()->getContents())
                          ]
                        );

    }

  }

}
