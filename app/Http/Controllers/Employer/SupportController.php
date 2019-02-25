<?php

namespace App\Http\Controllers\Employer;

use Auth;
use Session;
use App\Support;
use App\Additional;
use App\Mail\Support as SupportMail;
use App\SupportSubject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{

    public $data = [];

    public function storeRules()
    {
        return [
                "email" => 'required',
                "phone" => 'required',
                "subject_id" => "required",
                "message" => "required"
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data["subjects"] =  SupportSubject::whereType('employer')->get();
        $this->data["supports"] = Additional::whereType('employer.support.contact')->first();
        return view('employer.support.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, $this->storeRules());

        $support = new Support;
        $support->fill($request->toArray());
        $support->user_id = auth()->user()->getUser()->id;
        $support->type = "employer";
        $support->save();

        $supports = Additional::whereType('employer.support.contact')->first();

        $data = $request->toArray();

        $data["subject"] =  SupportSubject::find($request->subject_id)->subject;

        \Mail::to($supports->values->email)->send(new SupportMail($data));

        Session::flash("success", "Thank you for the message. We will contact you shortly.");

        return redirect()->route('employer.support.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function show(Support $support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function edit(Support $support)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Support $support)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function destroy(Support $support)
    {
        //
    }
}
