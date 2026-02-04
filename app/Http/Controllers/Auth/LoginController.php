<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Propaganistas\LaravelPhone\PhoneNumber;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    public function username()
    {
        return 'mobile';
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function credentials(Request $request)
    {
        $login = $request->input($this->username()); // The input field name in your form

        try {
            $mobile = (string) ltrim(phone($request->mobile, config('services.countries'))->formatE164(), '+');
        } catch (\Throwable $th) {
            $mobile = $login;
        }

        // Check if input is numeric (phone) or an email
        $field = is_numeric($login) ? 'mobile' : 'email';
        return [
            $field => $field == 'mobile' ? $mobile : $login,
            'password' => $request->input('password'),
        ];
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
