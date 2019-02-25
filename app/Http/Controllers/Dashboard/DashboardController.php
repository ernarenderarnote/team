<?php

namespace App\Http\Controllers\Dashboard;

use Auth;
use App\Job;
use App\State;
use App\UserAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public $data = [];

    public function index()
    {
    	if(auth()->user()->hasRole('employer') || auth()->user()->hasRole('client'))
    	{
    		return $this->employerDashboard();
    	}
    	else
    	{
            return $this->educatorDashboard();
    		//return view('dashboard.employer');
    	}
    	
    }


    public function employerDashboard()
    {

        $this->data['appliedJobApplicantTotal'] = UserAction::whereReceiverId(Auth::user()->id)->WhereNull('status')->count() ;

        $this->data['pendingLists'] = UserAction::with('sender.details', "job")
                                                    ->whereReceiverId(Auth::user()->id)
                                                    //->offers(Auth::user()->id)
                                                    ->whereNull('status')->get();
        $this->data['states']   = State::all();
        return view('dashboard.employer', $this->data);
    }

    public function educatorDashboard()
    {

        $this->data['jobCount'] =   Job::whereDoesntHave('userActionJob', function ($query) {
                $query->where('action', 'view')->where("user_id", auth()->id());
            })->where(function($q){
            $q->whereNull('deadline')->orWhere("deadline", '>', date('Y-m-d'));
        })->count();


            //auth()->user()->unreadNotifications()->whereType('App\Notifications\Educator\NewJobPost')->count(); //Job::count();
        $this->data['states']   = State::all();
        
        $this->data['approvedCount'] = UserAction::with('receiver.details', "job")
                                                    ->offers(Auth::user()->id)
                                                    ->where("status", "apply")
                                                    ->whereStatus('approved')
                                                    ->count();

        $this->data['rejectedCount'] = UserAction::with('receiver.details', "job")
                                                    ->offers(Auth::user()->id)
                                                    ->where("status", "apply")
                                                    ->whereStatus('rejected')
                                                    ->count();

        $this->data['pendingContactRequests'] = UserAction::with('employer.details')
                                                    ->whereReceiverId(Auth::id())
                                                    //->offers(Auth::user()->id)
                                                    ->WhereNull('status')
                                                    ->get();

        return view('dashboard.educator', $this->data);
    }
}

