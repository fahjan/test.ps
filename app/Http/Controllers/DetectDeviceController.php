<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class DetectDeviceController extends Controller
{
    public function __invoke(Request $request)
    {

        $app_store = 'https://apps.apple.com/us/app/test-ps-driving-school-gaza/id6758583111';
        // $google_play = 'https://play.google.com/store/apps/details?id=app.test.ps';
        // $google_play = 'https://test.ps/app/app.apk';
        $google_play = 'http://t.haiia.com/apk/app.apk';

        $agent = new Agent();

        if ($agent->isAndroidOS()) {
            return redirect()->to($google_play);
        }

        if ($agent->isiPhone()) {
            return redirect()->to($app_store);
        }
        return view('download-app', compact('app_store', 'google_play'));
    }
}
