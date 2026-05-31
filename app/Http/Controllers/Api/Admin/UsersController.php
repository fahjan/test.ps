<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SimpleUserResource;
use App\Models\User;
use App\Notifications\SendPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        $code = mt_rand(1111, 9999);

        User::where('id_number', $request->id_number)->update(['password' => Hash::make($code), 'code' => $code]);

        $user = User::where('id_number', $request->id_number)->first();

        $sms_provider = [];

        $user->notify(new SendPassword(['message' => 'اسم المستخدم: ' . ltrim($user['mobile'], '97') . ' : ' . 'كلمة المرور: ' . $code . ', ' . url('/app')], $sms_provider));

        return new SimpleUserResource($user);
    }

}
