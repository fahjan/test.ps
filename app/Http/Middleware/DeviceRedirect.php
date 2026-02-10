<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;
use Symfony\Component\HttpFoundation\Response;

class DeviceRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Agent::isPhone()) {
            if (Agent::is('iOS')) {
                return redirect()->to('https://testflight.apple.com/join/Cf4eUbrY');
            }
            if (Agent::is('Android')) {
                return redirect()->to('https://play.google.com/store/apps/details?id=app.test.ps');
                return redirect()->to('https://play.google.com/apps/testing/app.test.ps');
            }
        }
        // Desktop users or other devices continue to the intended page
        return $next($request);
    }
}
