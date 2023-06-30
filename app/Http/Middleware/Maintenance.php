<?php

namespace App\Http\Middleware;

use App\Models\GeneralSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Maintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $setting = GeneralSetting::where('id', 1)->first();
        if($setting->site_active === 1) {
            return $next($request);
        } else {
            if(!auth()->guest() && auth()->user()->team == 1) {
                return $next($request);
            } else {
                return redirect()->route('maintenance');
            }
        }

    }
}
