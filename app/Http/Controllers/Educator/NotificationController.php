<?php

namespace App\Http\Controllers\Educator;

use App\UserAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function readJobNotification()
    {
    	$jobs = auth()->user()->unreadNotifications()->whereType('App\Notifications\Educator\NewJobPost')->get();
    	$jobs->each->markAsRead();
    	echo "1";
    }

	public function readAlertsNotification()
    {
    	$alerts = auth()->user()->unreadNotifications()
								->whereType('App\Notifications\Educator\JobAccepted')
								->orWhere('type','App\Notifications\Educator\JobApproved')
								->orWhere('type','App\Notifications\Educator\JobRejected')
								->get();

    	$alerts->each->markAsRead();
    	echo "1";
    }

    public function contactRequest(Request $request, $id)
    {

        $this->validate($request, [ "status" => "required" ]);

        $userAction = UserAction::with("employer.details")->find($id);
        
        if(!$userAction) abort(404);

        $userAction->status = $userAction->employer->details->credit > 0 ? $request->status : 'needcredit';
        $userAction->save();

        //$job = $job->load('user');
        //$employer = $job->user;

        if($request->status == "approved")
        {
           if($userAction->employer->details->credit > 0) 
                $userAction->employer->details->forceFill(["credit" => \DB::raw("credit - 1")])->save();
          //$employer->notify(new jobApproved(Auth()->user(), $job));
        }
        else if($request->status == "rejected")
        {
          //$employer->notify(new jobRejected(Auth()->user(), $job));
        }

       
        return $userAction->toJson();
    }
    
}
