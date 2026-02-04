<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class Profile extends Controller
{

    public $route = 'account.profile.';

    public function __construct()
    {
        \View::share('route', $this->route);
    }

    public function index()
    {
        $data = 'dsfsdf';
        return view($this->route . 'index', compact('data'));
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
        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();
        flash()->success(__('saved successfuly'));
        auth()->logout();
        return redirect(route('login'));
    }
}
