<?php

namespace App\Http\Controllers\Educator;

use Auth;
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

         $where = [];

         $where[] = [function($query){
            $query->where('user_id', Auth::user()->id)
                    ->orwhere('receiver_id', Auth::user()->id)->get();
         }];

        $this->data['approvedApplicants'] = UserAction::with( "job.state", "job.city")
                                                        ->where($where)
                                                        ->whereStatus("apply")
                                                        ->whereStatus('approved')->get();

        $this->data['rejectedApplicants'] = UserAction::with('sender.details', "job")
                                                            ->where($where)
                                                            ->whereStatus("apply")
                                                            ->whereStatus('rejected')->get();

        return view('educator.history.index', $this->data);
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
}
