<?php

namespace App\Http\Controllers\Educator;

use App\User;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('educator.setting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $setting)
    {

        $setting->load('details');
        $setting->fill($request->toArray());
        if($request->has('day') and $request->has('month') and $request->has('year'))
            $setting->date_of_birth = carbon()->parse("{$request->day}-{$request->month}-{$request->year}");
        $setting->save();

        $setting->details->fill($request->toArray());
        $setting->details()->save($setting->details);

        return $setting;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function questionnaire(Request $request, User $user)
    {
        $user->load('details');
       
        $this->data['details'] = $user->details; 

        if($request->isMethod('POST'))
        {
            $user->details->fill($request->toArray());
            $user->details()->save($user->details);
            return redirect()->route('educator.settings.index');
        }
        else
        {
            $this->data['categories'] = Group::whereType('category')->whereParentId(0)->with('sub')->get();
            $this->data['grades'] = Group::whereType('grade')->whereParentId(0)->with('sub')->get();
            $this->data['positions'] = Group::whereType('position')->whereParentId(0)->with('sub')->get();
            $this->data['degreeAttained'] = Group::whereType('attained')->whereParentId(0)->with('sub')->get();
           
           return view('educator.setting.questionnaire', $this->data);
        }

      

    }

    /**
     * Reset  Password 
     */
    public function resetPassword(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $this->validate($request, [ 
                                        "old_password" => "required",
                                        "password" => "required|confirmed",
                                        "password_confirmation" => "required" 
                                    ]);

            $user = auth()->user();
            if (\Hash::check($request->old_password, $user->password))
            {
                $user->password = bcrypt($request->password);
                $user->save();
                return redirect()->route('educator.settings.index');
            }   
            else
            {
                session()->flash("error", "Old Password not match");
                return back();
            }

        }   
        else
        {
            return view('educator.setting.password.reset');
        }
    }
}
