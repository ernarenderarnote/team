<?php

namespace App\Http\Controllers\Employer;

use App\User;
use App\Group;
use App\Client;
use App\UserToken;
use App\UserClient;
use Illuminate\Http\Request;
use App\Mail\TeamSetPassword;
use Facades\App\Helper\Common;
use App\Http\Controllers\Controller;

class TeamController extends Controller
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
        return view("employer.teammate.index", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $this->data["clients"] = auth()->user()->getUser()->client()->get();
        $this->data['team_permissions'] = Group::whereType("teammate.role")->get();
        return view('employer.teammate.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [ 
                                    "team.*.first_name" => "required",
                                    "team.*.last_name" => "required",
                                    "team.*.email" => "required" 
                                ],
                                [],
                                ["team.*.first_name" => "First Name", "team.*.last_name" => "Last Name", "team.*.email" => "Email"]);

        foreach($request->team  as $team){
            //$user = auth()->user()->getUser()->client()->create($team);

            $client = new User;
            $client->fill($team);
            $client->reference_id = auth()->user()->getUser()->id;
            $client->roles = $team["roles"];
            $client->save();

            $client->details()->create([]);
            $client->roles()->attach(4);

            $token = Common::createToken();
            UserToken::create(["user_id" => $client->id, "token" => $token, "type" => 'client.password.set']);

            \Mail::to($client->email)->send(new TeamSetPassword($client, $token, $request->user()));
        }
        
        return redirect()->route('employer.settings.index');

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
    public function update(Request $request, User $teammate)
    {
        $teammate->roles = $request->roles;
        $teammate->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $teammate)
    {
       $teammate->delete();

       return back();
    }
}
