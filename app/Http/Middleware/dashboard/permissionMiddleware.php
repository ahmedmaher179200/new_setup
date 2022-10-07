<?php

namespace App\Http\Middleware\dashboard;

use Closure;
use Illuminate\Http\Request;

class permissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if(auth('user')->user()->super == 1){ //is super
            return $next($request);
        } else if(auth('user')->user()->isAbleTo($permission)){ //has permission
            return $next($request);
        } else {  // dont has permission
            return abort(404);
        }

    }
}
