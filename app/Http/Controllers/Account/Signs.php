<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\License;
use App\Models\Type;
use App\Models\Question;
use App\Models\Sign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class Signs extends Controller
{

    public $route = 'account.signs.';

    public function __construct()
    {
        \View::share('route', $this->route);
    }

    public function index()
    {
        $student = auth()->user()->student();
        $signs = Sign::all();
        return view($this->route . 'index', compact('signs', 'student'));
    }

    public function show($id)
    {
        return view($this->route . 'index', compact('data'));
    }

    public function store()
    {
    }

    public function update(UpdatePasswordRequest $request)
    {
        // $request->user()->fill([
        //     'password' => Hash::make($request->password)
        // ])->save();
        // flash()->success(__('saved successfuly'));
        // auth()->logout();
        // return redirect(route('login'));
    }
}
