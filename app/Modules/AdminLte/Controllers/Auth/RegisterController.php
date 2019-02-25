<?php

namespace App\Modules\AdminLte\Controllers\Auth;

use Session;
use App\User;
use App\UserToken;
use App\Mail\EmailVerify;
use Illuminate\Http\Request;
use Facades\App\Helper\Common;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;



class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator()
    {

        $this->validate($this->request, [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => 'required|email|max:255|unique:users',
            "phone"      => 'required',
            'password'   => 'required|min:6|confirmed',
            'type'       => 'required|in:2,3,4',
            "tnc"        => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create($token)
    {

        $data = $this->request->except("password");
        $user = new User($data);
        $user->password = bcrypt($this->request->password);
        $user->save();

        UserToken::create(["user_id" => $user->id, "token" => $token, "type" => 'emailVerify']);
        
        $user->attachRole($this->request->type);

        return $user;
    }

    public function registration()
    {

        $this->validator();
        $token = Common::createToken();
        $user = $this->create($token);
        $this->sendEmailToVerifyEmailAddress($user, $token);

        return redirect()->to($this->redirectTo);
    }


    /**
     *  Email verify code 
     */
    
    public function sendEmailToVerifyEmailAddress($user, $token)
    {

       Mail::to($this->request->email)->send(new EmailVerify($user, $token));

    }


    /**
     *  Email verify 
     */

    public function confirmation(UserToken $token)
    {

        if($token->type == 'userConfirmation')
        {
            $user = $token->user;
            $user->is_verify_email = 1;
            $user->save();
            $token->delete();
            
            Session::flash('success',"Your email has verified successfully!!");     
        }
        else{
             Session::flash('error',"Your email  not verified !!");    
        }
        
        return redirect()->to('/');
    }
}
