<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


    public function login(LoginRequest $request)
    {
        $credentials = [
            'mobile' => $request->mobile,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            // Authentication successful...
            $user = Auth::user();
            $user->load(['roles', 'students.school', 'managers.school', 'trainers.school']);

            return new UserResource($user);

        }

        throw ValidationException::withMessages([
            'mobile' => [__('Make sure of your mobile number and password ')],
        ]);



        if (Auth::attempt($data, true)) {
            $token = Str::random(60);
            User::whereId(auth()->id())->update(['api_token' => $token]);

            $token = $request->user()->createToken($request->token_name);

            // return ['token' => $token->plainTextToken];

        } else {
            return response()->json(['message' => __('auth.failed')], 404);
        }


        $updated_user = User::whereId(auth()->id())->with(['roles', 'students.school', 'managers.school', 'trainers.school'])->firstOrFail();
    }

    public function update_password(Request $request)
    {
        // 
    }
}
