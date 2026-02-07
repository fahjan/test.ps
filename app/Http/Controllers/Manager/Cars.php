<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Notifications\SendPassword;
use Illuminate\Http\Request;
use App\Models\Car as myObject;
use App\Models\Trainer;
use App\Models\Vehicletype;
use Illuminate\Support\Facades\Hash;


class Cars extends Controller
{

    public $route = 'manager.cars.';

    public function __construct()
    {
        \View::share('route', $this->route);
    }

    public function index()
    {

        // dd(auth()->user()->school->id);
        $objects = myObject::with(['trainer', 'vehicletype'])->school()->search()->latest()->paginate()->appends(request()->except('page'));
        return view($this->route . 'index', compact('objects'));
    }

    public function create()
    {
        $trainers = Trainer::with(['user', 'jobs'])->school()->get();
        $vehicletypes = Vehicletype::all();

        return view($this->route . 'create', compact('trainers', 'vehicletypes'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['school_id'] = auth()->user()->school->id;
        myObject::create($data);
        return redirect(route($this->route . 'index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $trainers = Trainer::with(['user', 'jobs'])->school()->get();
        $vehicletypes = Vehicletype::all();

        $object = myObject::whereId($id)->school()->first();
        return view($this->route . 'create', compact('trainers', 'object', 'vehicletypes'));
    }

    public function update(Request $request, $id)
    {


        $object = myObject::whereId($id)->school()->firstOrFail();
        $object->update($request->all());
        return redirect(route($this->route . 'index'));
    }

    public function destroy($id)
    {
        //
    }
}
