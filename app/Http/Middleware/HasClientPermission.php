<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class HasClientPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
         //echo \Cookie::get(session()->getId());die;
        if(Auth::check())
        {
            $user = Auth::user();
            if($user->hasRole('client')) // ower
            {
                if(in_array($user->roles, explode("|",$roles))) // client
                    return $next($request);
                abort(403, 'Unauthorized action.');
            }
            else{
                 return $next($request);

            }
        }
       else
            return redirect()->route("auth.educator");
              
    }
}
