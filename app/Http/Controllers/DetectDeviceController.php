<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetectDeviceController extends Controller
{
    public function __invoke()
    {
        return ['app' => 'web'];
    }
}
