<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;

class Cars extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return cache()->rememberForever("school-cars:$request->school_id", function () use ($request) {
            $cars = Car::where('school_id', $request->school_id)
                ->with(['vehicletype', 'school'])
                ->whereHas('school.managers', function ($q) use ($request) {
                    $q->where('user_id', $request->user()->id);
                })->get();

            return CarResource::collection($cars);
        });

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        cache()->forget("school-cars:$request->school_id");

        Car::create($request->all());

        return $this->index($request);
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
    public function update(Request $request, Car $car)
    {
        cache()->forget("school-cars:$request->school_id");
        //

        $car->update($request->all());
        return $this->index($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
