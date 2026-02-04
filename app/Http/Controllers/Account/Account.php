<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

class Account extends Controller
{

    public $route = 'account.';

    public function __construct()
    {
        \View::share('route', $this->route);
    }

    public function index()
    {
        $user = auth()->user();
        return view($this->route . 'index', compact('user'));
    }

    public function profile()
    {
        return view($this->route . 'index');
    }

    public function store()
    {
    }
}
