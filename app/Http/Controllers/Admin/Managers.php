<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendPassword;
use Illuminate\Support\Facades\View;

class Managers extends Controller
{
    public $route = 'admin.managers.';

    public function __construct()
    {

        View::share('route', $this->route);
    }

    public function index()
    {
        $objects = Manager::with(['user', 'school'])->search()->latest()->paginate()->appends(request()->except('page'));
        return view($this->route . 'index', compact('objects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::orderBy('title')->get();

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

        $user['mobile'] = phone($request->mobile, config('services.countries'));
        $user['id_number'] = $request->id_number;
        $user['name'] = $request->name;

        if ($request->has('password')) {
            $password = $request->password;
        } else {
            $password = mt_rand(1111, 9999);
        }
        $user['password'] = Hash::make($password);



        $created_user = User::firstOrCreate(['mobile' => $user['mobile']], $user);
        $created_user->assignRole(['manager']);
        $photo = $request->hasFile('avatar') ? $request->file('avatar')->store('managers') : $request->photo;

        Manager::updateOrCreate(['school_id' => $request->school_id, 'user_id' => $created_user->id], ['photo' => $photo]);


        $created_user->notify(new SendPassword(['message' => 'اسم المستخدم: ' . $request->mobile . '.' . 'كلمة المرور: ' . $password]));
        // auth()->user()->notify(new SendPassword(['message' => 'اسم المستخدم' . $request->mobile . '.' . 'كلمة المرور: ' . $request->password]));

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
        $schools = School::orderBy('title')->get()->pluck('title', 'id');
        $manager = Manager::with(['user'])->whereId($id)->firstOrFail();

        return view($this->route . 'create', compact('schools', 'manager'));
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
        $user = [];

        $user['mobile'] = phone($request->mobile, config('services.countries'));
        $user['id_number'] = $request->id_number;
        $user['name'] = $request->name;

        if (isset($request->password)) {
            $user['password'] = Hash::make($request->password);
        }

        $created_user = User::updateOrCreate(['mobile' => $user['mobile']], $user);
        $created_user->assignRole(['manager']);
        $photo = $request->hasFile('avatar') ? $request->file('avatar')->store('managers') : $request->photo;

        Manager::updateOrCreate(['school_id' => $request->school_id, 'user_id' => $created_user->id], ['photo' => $photo]);

        if (isset($user['password'])) {
            $created_user->notify(new SendPassword(['message' => 'اسم المستخدم: ' . $request->mobile . '.' . 'كلمة المرور: ' . $request->password]));
        }
        // auth()->user()->notify(new SendPassword(['message' => 'اسم المستخدم' . $request->mobile . '.' . 'كلمة المرور: ' . $request->password]));

        return redirect(route($this->route . 'index'));
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
