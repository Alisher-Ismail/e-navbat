<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
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
        // Check if the authenticated user's type is 'admin'
        if (auth()->user() && auth()->user()->type == 'admin') {
            return $next($request);
        }

        // If not an admin, abort with a 403 Forbidden status
         // Log out the user
         Auth::logout();

         // Redirect to the login page
         return redirect()->back();
            }
}
