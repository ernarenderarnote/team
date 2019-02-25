<?php

namespace App\Http\Controllers\Employer;

use Auth;
use App\User;
use App\History;
use App\UserAction;
use Illuminate\Http\Request;     
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{

    public $data;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['approvedApplicants'] = UserAction::with('educator.details', "job")
                                                         ->whereStatus('approved')
                                                         ->where(function($q){
                                                                $q->whereReceiverId(Auth::user()->getUser()->id)
                                                                ->orWhere("user_id", Auth::user()->getUser()->id);
                                                         })
                                                         ->get();

        $this->data['rejectedApplicants'] = UserAction::with('sender.details', "job")
                                                        ->where(function($q){
                                                                $q->whereReceiverId(Auth::user()->getUser()->id)
                                                                ->orWhere("user_id", Auth::user()->getUser()->id);
                                                         })
                                                        ->whereStatus('rejected')->get();

        return view('employer.history.index', $this->data);
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
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }

    /**
     * Get contact Details
     *
     * @param \App\User $contact
     */

    public function contactView(User $contact){

        $this->data["educator"] = $contact;
        return view("employer.history.contact-view", $this->data);
    }
}
