<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;
use Response;

class pengunjungOnly
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
        if ( Auth::check() && Auth::user()->is_management == false )
        {
            return $next($request);
        } else {
            return Response::make('Only visitor can access this feature', 401);
        }
    }
}
