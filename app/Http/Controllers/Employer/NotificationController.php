<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function readJobNotification()
    {
    	/*$jobs = auth()->user()->unreadNotifications()->whereType('App\Notifications\Employer\NewJobPost')->get();
    	$jobs->each->markAsRead();
    	echo "1";*/
    }

	public function readAlertsNotification()
    {
    	$alerts = auth()->user()->unreadNotifications()
                                ->where('type','App\Notifications\Employer\JobApproved')
								->orWhere('type','App\Notifications\Employer\AppliedForJob')
								->orWhere('type','App\Notifications\Employer\JobRejected')
								->get();

    	$alerts->each->markAsRead();
    	echo "1";
    }
    
}
