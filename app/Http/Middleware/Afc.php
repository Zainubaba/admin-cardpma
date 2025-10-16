<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class Afc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {


        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == 1) {
            return redirect()->route('Udashboard');
        }

        if (Auth::user()->role == 2) {
            return $next($request);
        }



        if (Auth::user()->role == 3) {
            return redirect()->route('Ddashboard');
        }

        if (Auth::user()->role == 4) {
            return redirect()->route('Udashboard');
        }


    }
}
