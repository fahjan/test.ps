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

    private $allowedUsers = ['970599522449', '970592114831'];

    public function login(LoginRequest $request)
    {
        $credentials = [
            'mobile' => $request->mobile,
            'password' => $request->password,
        ];


        $user = User::where('mobile', $request->mobile)->first();

        if (!in_array($request->mobile, $this->allowedUsers)) {
            if ($user->device_info != null && $user->device_info != $request->device_info) {
                throw ValidationException::withMessages([
                    'message' => [__('Already on anothe device')],
                ]);
            }
        }

        if (Auth::attempt($credentials)) {
            // Authentication successful...
            auth()->user()->update([
                'device_info' => $request->device_info,
            ]);

            $user = Auth::user();
            $user->load(['roles', 'students.school', 'students.license', 'students.exams.answers', 'managers.school', 'trainers.school']);

            // $user->load(['students.exams.answers']);

            return new UserResource($user);

        }

        throw ValidationException::withMessages([
            'message' => [__('Make sure of your mobile number and password are correct')],
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

    public function me(Request $request)
    {

        $user = $request->user();
        $user->load(['roles', 'students.school', 'students.license', 'students.exams.answers', 'managers.school', 'trainers.school']);

        return new UserResource($user);
    }
}
