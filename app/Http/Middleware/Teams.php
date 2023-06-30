<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Teams
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->guest() && auth()->user()->team == 1) {
            return $next($request);
        } else {
            return redirect()->route('fo.profile')->with('error', "Vous n'avez pas accès a cette espace.");
        }
    }
}
