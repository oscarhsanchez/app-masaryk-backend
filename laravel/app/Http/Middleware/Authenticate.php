<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
	    
	    if ($user = Sentinel::check()) {
			if ($user->hasAccess(['access.admin'])) {
				return $next($request);
			}
    	} 
    	
		if ($request->ajax()) {
            return response('Unauthorized.', 401);
        } else {
            return redirect()->guest('');
    	}
    	
        return $next($request);
        
    }
}
