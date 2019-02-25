<?php

namespace App\Modules\AdminLte\Controllers\Auth;

use Session;
use Mail;
use App\User;
use App\UserToken;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use Facades\App\Helper\Common;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function rules()
    {
        return [
                'email' => 'exists:users,email'
            ];
    }

    public function forgot()
    {
        if($this->request->isMethod('post'))
        {
            $this->validate($this->request, $this->rules());

            $user = User::whereEmail($this->request->email)->first();

            $token = Common::createToken();

            UserToken::create(['user_id' => $user->id, "token" => $token, "type" => "resetForgotPassword"]);

            Mail::to($user->email)->send(new ForgotPassword($user, $token));

            Session::flash('success',"please check your email for reset password");
            
            return redirect()->to('/');
        }
        
        return view('auth.passwords.email');
    }

}
