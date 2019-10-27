<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$guard=null)
    {
        if (auth()->guard($guard)->check()) {
            return $next($request);
        }
            return redirect()->route('get_login');

    }
}
