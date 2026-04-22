<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\School;
use Illuminate\Http\Request;


class Schools extends Controller
{

    public $route = 'admin.schools.';

    public function __construct()
    {

        \View::share('route', $this->route);
    }
    public function index()
    {


        $objects = School::with(['city', 'managers'])->withCount(['students'])->search()->orderByDesc('students_count')->paginate()->appends(request()->except('page'));
        return view($this->route . 'index', compact('objects'));
        // return 'bbb';
    }

    public function create()
    {
        $countries = Country::all();
        $cities = City::all();
        return view('admin.schools.create', compact('countries', 'cities'));
    }

    public function store(Request $request)
    {
        School::create($request->all());
        // flash(__('public.added_successfuly'));

        return redirect($this->route, 'index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
