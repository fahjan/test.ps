<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Trainer;
use App\Models\User;
use App\Notifications\SendPassword;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;


class Trainers extends Controller
{

    public $route = 'manager.trainers.';

    public function __construct()
    {

        \View::share('route', $this->route);
    }
    public function index()
    {

        // dd(auth()->user()->school->id);
        $objects = Trainer::with(['user', 'jobs'])->school()->search()->latest()->paginate()->appends(request()->except('page'));
        return view($this->route . 'index', compact('objects'));
    }

    public function create()
    {
        $jobs = Job::all();
        return view($this->route . 'create', compact('jobs'));
    }

    public function store(Request $request)
    {
        $user = [];

        $user['mobile'] = ltrim((string) phone($request->mobile, config('services.countries')), '+');
        $user['id_number'] = $request->id_number;
        $user['name'] = $request->name;
        $user['password'] = Hash::make($request->password);


        $created_user = User::firstOrCreate(['mobile' => $user['mobile']], $user);
        $created_user->assignRole(['trainer']);
        $photo = $request->hasFile('avatar') ? $request->file('avatar')->store('trainers') : $request->photo;

        $trainer = Trainer::updateOrCreate(
            ['school_id' => auth()->user()->school->id, 'user_id' => $created_user->id],
            ['photo' => $photo]
        );
        $trainer->jobs()->sync($request->jobs);
        $created_user->notify(new SendPassword(['message' => 'اسم المستخدم: ' . $request->mobile . '.' . 'كلمة المرور: ' . $request->password]));

        return redirect(route($this->route . 'index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $jobs = Job::all();
        $object = Trainer::whereId($id)->school()->with(['user', 'jobs'])->first();
        return view($this->route . 'create', compact('jobs', 'object'));
    }

    public function update(Request $request, $id)
    {
        $photo = $request->hasFile('avatar') ? $request->file('avatar')->store('trainers') : $request->photo;

        $trainer = Trainer::whereId($id)->school()->update([
            'photo' => $photo,
        ]);
        $trainer = Trainer::whereId($id)->first();
        $trainer->jobs()->sync($request->jobs);
        return redirect(route($this->route . 'index'));
    }

    public function destroy($id)
    {
        //
    }
}
