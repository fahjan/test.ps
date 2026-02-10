<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;

class DetectDeviceController extends Controller
{
    public function __invoke()
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

        return ['app' => 'web'];
    }
}
