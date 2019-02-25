<?php

namespace App\Modules\AdminLte\Controllers\Auth;

use Auth;
use Hash;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $defaultRedirectTo = 'admin/dashboard';

    /**
     *  redirect after logout
     */

    protected $redirectAfterLogout = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }



    public function getLoginRules()
    {
        return [
                'email'      => 'required|email',
                'password'   => 'required',
        ];
    }

    public function login()
    {

        $action = $this->request->route()->getAction();

       if($this->request->isMethod('post'))
        {
            $this->validate($this->request, $this->getLoginRules());

            return $this->authenticate();
        }
        else
        {
            return view("AdminLte::auth.login");
        }
        
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {

        $user = User::whereEmail($this->request->email)->first();

        if ($user && Hash::check($this->request->password, $user->password))
        {
            
            //if(!$user->is_verify_email)
            //{
            //    return redirect()->back()->withInput()->with('error',"please verify your email"); 
                
            //}
            //else
            //{
                Auth::login($user, $this->request->remember_to_pc);
                
            //    $user->load('roles');

             //   $roles =  $user->roles->pluck('name')->toArray();

                //if(!in_array('student', $roles)){
             //       return redirect()->intended('dashboard');
                /*}
                else{
                    return redirect()->intended($this->defaultRedirectTo);
                }*/
              return redirect()->intended($this->defaultRedirectTo);
           // }
 
        }
        else{
            return redirect()->back()->withInput()->with('error',"Either email/password is wrong");
        }
    }


    /**
     *  handle an logout
     */

    public function logout(){
        
        Auth::logout();
        session()->flush();
        return redirect()->to($this->redirectAfterLogout);

    }
}
