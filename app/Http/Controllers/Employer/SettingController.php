<?php

namespace App\Http\Controllers\Employer;

use App\User;
use App\Group;
use App\UserToken;
use Illuminate\Http\Request;
use Facades\App\Helper\Common;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data["clients"] = auth()->user()->getUser()->client()->get();
        $this->data['team_permissions'] = Group::whereType("teammate.role")->get();
        return view('employer.setting.index', $this->data);
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
                return redirect()->route('employer.settings.index');
            }   
            else
            {
                session()->flash("error", "Old Password not match");
                return back();
            }

        }   
        else
        {
            return view('employer.setting.password.reset');
        }
    }
}
