<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Examiner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Examiners extends Controller
{
    public $route = 'admin.examiners.';

    public function __construct()
    {
        \View::share('route', $this->route);
    }
    public function index()
    {
        $examiners = Examiner::with(['city'])->search()->latest('id')->paginate()->appends(request()->except('page'));
        return view($this->route . 'index', compact('examiners'));
        // return 'bbb';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::where('country_id', 275)->get();
        return view($this->route . 'create', compact(('cities')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Examiner::updateOrCreate(['name' => $request->name], $request->all());
        return redirect()->back();
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

        $object = Examiner::findOrFail($id);
        $cities = City::where('country_id', 275)->get();
        return view($this->route . 'create', compact('cities', 'object'));
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
        Examiner::updateOrCreate(['id' => $id], $request->all());
        return redirect()->back();
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
