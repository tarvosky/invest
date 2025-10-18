<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureProfileIsCompleted
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
        $user = $request->user();

        // only check if user is authenticated
        if ($user) {
            // allow these routes without redirecting (adjust as needed)
            $allowed = [
                'profile',         // the profile page (GET)
                'profile.store',   // profile submit (POST)
                'logout',
                'password.*',
                'verification.*',
            ];

            // If user has no profile, redirect to profile page unless current route is allowed
            if (!$user->profile && ! $request->routeIs($allowed)) {
                return redirect()->route('profile')
                    ->with('error', 'Please complete your profile before continuing.');
            }
        }

        return $next($request);
    }
}
