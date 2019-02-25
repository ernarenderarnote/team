<?php

namespace App\Http\Controllers\CronJob;

use DB;
use Mail;
use App\User;
use App\Mail\RememberEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function rememberCompleteSignUp(){

    	$users = User::getUserWithRole('employer')
    					->whereNotIn('stepping', ['3'])
    					->where(DB::raw('date_format(`created_at`,"%Y-%m-%d")') ,'<' ,DB::raw('(CURRENT_DATE - INTERVAL 3 DAY)'))
    					->get();

    	
    	foreach ($users as $user) {
    		Mail::to($user->email)->send(new RememberEmail($user));
    	}

    	return "true";
    }
}
