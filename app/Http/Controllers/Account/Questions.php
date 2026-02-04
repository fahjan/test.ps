<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\License;
use App\Models\Type;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class Questions extends Controller
{

    public $route = 'account.questions.';

    public function __construct()
    {
        \View::share('route', $this->route);
    }

    public function index()
    {

        // dd(User::role('student')->get());

        // dd(auth()->user()->roles);
        // auth()->user()->assignRole('student');

        $licenses = License::where('id', '<', 5)->get();
        $types = Type::all();
        $questions = Question::with(['type', 'license'])->filter()->paginate()->appends(request()->except('page'));
        $student = auth()->user()->student();
        return view($this->route . 'index', compact('questions', 'licenses', 'types', 'student'));
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
