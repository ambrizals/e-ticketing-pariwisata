<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Pengunjung;

class userPengunjung
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
        $pengunjung = Pengunjung::where('user',Auth::user()->id)->first();
        if ($pengunjung == null){
            return redirect()->route('front.profile.panel');
        } else {
            return $next($request);
        }
    }
}
