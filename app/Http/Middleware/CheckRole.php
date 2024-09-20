<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check if user is logged in and has the required role
        if (Auth::user()->role === $role) {
            return $next($request);
        }

        // If user doesn't have the required role, redirect or return an error response
        return redirect()->route('index')->with('error', 'You do not have access to this page.'); 
    }
}
