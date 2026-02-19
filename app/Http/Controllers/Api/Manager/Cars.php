<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class Cars extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $cars = $request->user()->managers()->where('school_id', $request->school_id)->with(['school.cars'])->simplePaginate();

        return $cars;
        $cars = Car::where('school_id', $request->school_id)

            ->with(['trainer', 'vehicletype'])
            ->school()
            ->latest()
            ->simplePaginate();

        // $cars = Car::where('school_id', $request->school_id)->get();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
