<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsEducatorSetupCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->stepping == 1)
            {
                session(['signup' => [ "user" => Auth::user() ] ]);
                return redirect()->route('signup.educator.step2');
            }
            else if( Auth::user()->stepping == 2)
            {
                session(['signup' => [ "user" =>  Auth::user() ] ]);
                return redirect()->route('signup.educator.step3');
            }
            else
                return $next($request);
        }

        return redirect()->route("auth.educator");
                
    }
}
