<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Carbon\Carbon;
use App\User;
use App\UserToken;
use App\Additional;
use Illuminate\Http\Request;
use App\Mail\EmployerWelcome;
use Facades\App\Helper\Common;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmployerSignupController extends Controller
{
    public $data = [];

	public function signupRules()
    {
        return [
        		 "school_id" => "required",
                 "first_name" => "required",
                 "last_name"  => "required",
                 "email" => "required|unique:users",
                 "password" => "required|confirmed|min:6",
                 "password_confirmation" => "required"
        ];
    }

	public function signup()
	{
		if(request()->isMethod("post"))
		{
			$this->validate(request(), $this->signupRules());

			try
            {
                $user = new User;
                $user->fill(request()->toArray());
                $user->password = bcrypt(request()->password);

                //step 1
                $user->stepping = 3;

                $user->save();


                $user->roles()->attach(2); //Educator

                $defaultDetails = ['notifications' => ["applyforjob" => "1","approvedforjob" => "1","rejectedforjob" => "1"]];

                $user->details()->create( array_merge($defaultDetails, request()->toArray()) );


                $token = Common::createToken();


                UserToken::create(["user_id" => $user->id, "token" => $token, "type" => 'userConfirmation']);

                //Mail
                //$welcomeMail = [$user->email, 'jackpotsoftware@gmail.com'];

                Mail::to($user->email)->send(new EmployerWelcome($user, $token));
                
                Auth::login($user);

                session()->flash("redirected", route('dashboard'));
                
                return redirect()->route("thanks");
            }
            catch(\Exception $ex)
            {
                return redirect()->back();
            }
		}
		else
		{
            $this->data['schools'] = Additional::whereType('school')->get();
			return view('auth.employer.signup', $this->data);
		}
	}


    public function resendMail()
    {

        $user = auth()->user()->getUser();

        $token = Common::createToken();
        UserToken::create(["user_id" => $user->id, "token" => $token, "type" => 'userConfirmation']);

        Mail::to($user->email)->send(new EmployerWelcome($user, $token));

        session()->flash("success", "Please check your email verify email confirmation setup.");

        return back();

    }

}
