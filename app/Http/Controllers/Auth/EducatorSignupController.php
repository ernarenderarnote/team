<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Group;
use App\UserToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Facades\App\Helper\Common;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\EducatorWelcomeMail;

class EducatorSignupController extends Controller
{
    
    // @object Illuminate\Http\Request
    public $request;
    public $data = [];

    public function  __construct(Request $request)
    {
        $this->request = $request;
    }

    public function stepOneRules()
    {
        return [
                 "email" => "required|unique:users",
                 "password" => "required|confirmed|min:6",
                 "password_confirmation" => "required"
        ];
    }

    public function stepOneMsg()
    {
        return [
                 "email.required" => 'Email is required.',
                 "password.required" => 'Password is required.',
                 "password.confirmed" => 'Retype password does not match.',
                 "password_confirmation.required" => 'Retype password is required.',
        ];
    }

    public function stepTwoRules()
    {
        return [
                 "first_name"    => "required",
                 "last_name"     => "required",
                 "month"         => "required",
                 "day"           => "required",
                 "year"          => "required",
                 "phone"         => "required|digits_between:4,13",
                 //"date_of_birth" => "required",
                 "address"       => "required",
                 "city"          => "required",
                 "state"         => "required",
                 "zipcode"       => "required",
        ];
    }

    public function stepTwoMsg()
    {
        return [
                 "first_name.required" => 'First name is required.',
                 "last_name.required" => 'Last name is required.',
                 "date_of_birth.required" => 'Date of birth is required.',
                 "address.required" => 'Address is required.',
                 "city.required" => 'City is required.',
                 "state.required" => 'State is required.',
                 "zipcode.required" => 'Zipcode is required.',  
        ];
    }

    /**
     *  Handle Step one request
     */
    public function step()
    {
        if($this->request->isMethod("post"))
        {
            $this->validate($this->request, $this->stepOneRules(), $this->stepOneMsg());
            
            try
            {
                $user = new User;
                $user->fill($this->request->toArray());
                $user->password = bcrypt($this->request->password);

                //step 1
                $user->stepping = 1;

                $user->save();

                $user->roles()->attach(3); //Educator
                $user->details()->create([ "notifications" =>["jobdaily" => "1","jobweekly" => "1","jobapproved"=>"1","jobrejected" => "1"] ]);

                session(['signup' => [ "user" =>  $user ] ]);

                $token = Common::createToken();

                UserToken::create(["user_id" => $user->id, "token" => $token, "type" => 'userConfirmation']);

                //Mail
                //$welcomeMail = [$user->email, 'jackpotsoftware@gmail.com'];

                Mail::to($user->email)->send(new EducatorWelcomeMail($user, $token));

                return redirect()->route("signup.educator.step2");
            }
            catch(\Exception $ex)
            {
                return redirect()->back();
            }
           
        }
        
    	return view('auth.educator.step');
    }

    public function step2()
    {

        if ($this->request->session()->has('signup')) {

            if($this->request->isMethod("post"))
            {

                $this->request->merge(array('phone' => preg_replace('/\D/', '', $this->request->phone)));

                $this->validate($this->request, $this->stepTwoRules(), $this->stepTwoMsg());

                try
                {

                    $signup = $this->request->session()->get('signup');

                    $user = $signup['user'];
                    $user->fill($this->request->toArray());
                    $user->date_of_birth = carbon()->parse("{$this->request->day}-{$this->request->month}-{$this->request->year}");

                    //step 1
                    $user->stepping = 2;
                    $user->save();

                    $details = $user->details;
                    //print_r($this->request->toArray());die;
                    $details->fill($this->request->toArray());
                    $user->details()->save($details);

                    $this->request->session()->put("signup.user", $user);
                    $this->request->session()->put("signup.step2", $this->request->toArray());

                    return redirect()->route("signup.educator.step3");
                }
                catch(\Exception $ex)
                {
                    echo $ex->getMessage();
                }
            }
            else{
                return view('auth.educator.step2');
            }
        
        }
        else
        {
            return redirect()->route("signup.educator.step");
        }

    	
    }

    public function step3()
    {
        if ($this->request->session()->has('signup'))
        {
            return view('auth.educator.step3'); 
        }
        else
        {
          return redirect()->route("signup.educator.step");
        }
    	
    }

    public function questionnaire()
    {
        if ($this->request->session()->has('signup'))
        {
            if($this->request->isMethod("post"))
            {
                 $this->validate($this->request, [
                    'resume' => 'required|mimes:doc,docx',
                ]);
                try
                {
                    $image = $this->request->file('resume'); 
                    $fileExtension = $image->getClientOriginalExtension();
                    $imgName ='resume'.time().'.'.$fileExtension;

                    $signup = $this->request->session()->get('signup');
                    $user = $signup['user'];
                    //step 1
                    $user->stepping = 3;
                    $user->save();
                    $details = $user->details;
                    $details->fill($this->request->toArray());
                    $details->resume = $imgName;
                    $user->details()->save($details);
                    $this->request->file('resume')->move(base_path().'/public/uploads/resume/', $imgName);
                    $this->request->session()->forget('signup');
                    Auth::login($user);
                    session()->flash("redirected", route('dashboard'));
                    return redirect()->route("thanks");
                }
                catch(\Exception $ex)
                {
                    echo $ex->getMessage();
                }
            }
            else
            {
                $this->data['categories'] = Group::whereType('category')->whereParentId(0)->with('sub')->get();
                $this->data['grades'] = Group::whereType('grade')->whereParentId(0)->with('sub')->get();
                $this->data['positions'] = Group::whereType('position')->whereParentId(0)->with('sub')->get();
                $this->data['degreeAttained'] = Group::whereType('attained')->whereParentId(0)->with('sub')->get();
                return view('auth.educator.questionnaire', $this->data);
            }
        }
        else
        {
          return redirect()->route("signup.educator.step");
        }
    	
    }


    public function resendMail()
    {

        $user = auth()->user();

        $token = Common::createToken();
        UserToken::create(["user_id" => $user->id, "token" => $token, "type" => 'userConfirmation']);

        Mail::to($user->email)->send(new EducatorWelcomeMail($user, $token));

        session()->flash("success", "Please check your email verify email confirmation setup.");

        return back();

    }
}
