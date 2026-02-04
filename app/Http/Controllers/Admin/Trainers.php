<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendPassword;
// use Illuminate\Support\Facades\Storage;
use DB;

class Trainers extends Controller
{
    public $route = 'admin.trainers.';

    public function __construct()
    {

        \View::share('route', $this->route);
    }
    public function index()
    {
        $objects = Trainer::with(['user', 'school'])->search()->latest()->paginate()->appends(request()->except('page'));
        return view($this->route . 'index', compact('objects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::orderBy('title')->get()->pluck('title', 'id');

        return view($this->route . 'create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = [];

        $user['mobile']     = phone($request->mobile, config('services.countries'));
        $user['id_number']  = $request->id_number;
        $user['name']       = $request->name;
        $user['password']   = Hash::make($request->password);


        DB::transaction(function () {
            $created_user = User::firstOrCreate(['mobile' => $user['mobile']], $user);
            $created_user->assignRole(['manager']);
            $photo = $request->hasFile('avatar') ? $request->file('avatar')->store('managers') : $request->photo;

            Trainer::updateOrCreate(['school_id' => $request->school_id, 'user_id' => $created_user->id], ['photo' => $photo]);

            $created_user->notify(new SendPassword(['message' => 'اسم المستخدم: ' . $request->mobile . '.' . 'كلمة المرور: ' . $request->password]));
            // auth()->user()->notify(new SendPassword(['message' => 'اسم المستخدم' . $request->mobile . '.' . 'كلمة المرور: ' . $request->password]));
        });
        return redirect(route($this->route . 'index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
