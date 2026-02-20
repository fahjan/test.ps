<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListTrainersRequest;
use App\Http\Resources\TrainerResource;
use App\Models\Trainer;
use Illuminate\Http\Request;

class Trainers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListTrainersRequest $request)
    {

        return cache()->rememberForever("school-trainers:$request->school_id", function () use ($request) {

            $trainers = Trainer::with(['user', 'school'])->whereHas('school', function ($q) use ($request) {
                return $q->where('id', $request->school_id);
            })->get();

            return TrainerResource::collection($trainers);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListTrainersRequest $request)
    {
        cache()->forget("school-trainers:$request->school_id");

        Trainer::create($request->all());

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
    public function update(ListTrainersRequest $request, Trainer $trainer)
    {
        cache()->forget("school-trainers:$request->school_id");

        $trainer->update($request->all());
        return $this->index($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
