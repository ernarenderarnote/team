<?php

namespace App\Http\Controllers\User;

use Auth;
use Hash;
use Session;
use App\User;
use App\Client;
use App\UserToken;
use Illuminate\Http\Request;
use Facades\App\Helper\Common;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    
    public $data = [];

    public function __construct(Request $request)
    {
        $this->request =  $request;
    }

    public function index()
    {
        return view('backend.user.index');
    }

    public function initSetup(UserToken $token)
    {
        if($this->request->isMethod('POST'))
        {

            switch ($token->type) {
                case 'setPassword':
                    return $this->postSetPassword($token, User::find($token->user_id));
                    break;
                case 'resetForgotPassword':
                    return $this->postResetForgotPassword($token, User::find($token->user_id));
                    break;
                case 'client.password.set':
                    return $this->postSetClientPassword($token, Client::find($token->user_id));
                    break;
                default:
                    
                    break;
            }  

        }
        else
        {

            $this->data['userToken'] = $token;
            $this->data['token2'] = $token->token;

            switch ($token->type) {
                case 'setPassword':
                    $this->data['user'] = User::find($token->user_id);
                    return view('backend.user.setPassword', $this->data);
                    break;
                case 'resetForgotPassword':
                case 'client.password.set':
                    $this->data['user'] = User::find($token->user_id);
                    return view('auth.passwords.reset', $this->data);
                    break;
                /*case 'client.password.set':
                    $this->data['user'] = Client::find($token->user_id);
                    return view('auth.passwords.set', $this->data);
                    break;*/
                default:
                    
                    break;
            }         
        }
        
    }


    public function studentAccountSetupRules()
    {
        return [
                "password" => 'required|confirmed|min:6',
                "tnc"      => 'required'
        ];
    }

    public function postSetPassword($token, $user)
    {
        $this->validate($this->request, $this->studentAccountSetupRules());

        $user->password = bcrypt($this->request->password);
        $user->is_verify_email = 1;
        $user->save();
        $token->delete();

        Session::flash('success', "Your password has been updated!!");

        return redirect()->to('/');

    }

    public function forgotPasswordRules()
    {
        return [
                "password" => 'required|confirmed|min:6'
            ];
    }

    public function postResetForgotPassword($token, $user)
    {
        $this->validate($this->request, $this->resetPasswordRules());

        $user->password = bcrypt($this->request->password);
        $user->save();
        $token->delete();

        Session::flash('success', "Your password has been reset successfully!!");

        return redirect()->to('/');

    }

     public function postSetClientPassword($token, $user)
    {
        $this->validate($this->request, ["password" => 'required|confirmed|min:6']);

        $user->password = bcrypt($this->request->password);
        $user->save();
        $token->delete();

        Session::flash('success', "Your password has been reset successfully!!");

        return redirect()->to('/');

    }

    
    public function resetPasswordRules()
    {
        return [
                "old_password" => 'required',
                "new_password" => 'required|confirmed|min:6'    
            ];
    }

    public function resetPassword()
    {
        $this->validate($this->request, $this->resetPasswordRules());

        if(Hash::check($this->request->old_password, Auth::user()->password))
        {   
            $user = Auth::user();
            $user->password = bcrypt($this->request->new_password);
            $user->save();
            return redirect()->back()->with('success','Password successfully updated!!');
        }
        else
           return redirect()->back()->withInput()->with('error',"Old password does not match");
    }


    public function resetUserRules()
    {
        return [
                "first_name" => 'required',
                "last_name" => 'required',
                "email"     => "required|email|unique:users,email,". Auth::user()->id,
                "phone"     => 'required|digits_between:10,10|unique:users,phone,'. Auth::user()->id,
            ];
    }

    public function accountInfoUpdate()
    {

        $this->validate($this->request, $this->resetUserRules());
       

        $user = Auth::user();
        $data = collect($this->resetUserRules())->keys();
        $user->fill($this->request->only($data->all()));
        $user->save();
        return redirect()->back()->with('success','User Info updated');
       
    }


   
}
