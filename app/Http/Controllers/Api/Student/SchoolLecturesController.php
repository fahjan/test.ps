<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\LecturesResource;
use App\Models\Lecture;
use App\Models\School;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SchoolLecturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(School $school)
    {
        $this->authorize('viewAll', [Lecture::class, $school]);
        $lectures = $school->lectures()->orderBy('sort_order')->with(['school', 'user'])->get();
        return LecturesResource::collection($lectures);



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(School $school)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, School $school)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school, Lecture $lecture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school, Lecture $lecture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school, Lecture $lecture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school, Lecture $lecture)
    {
        //
    }
}
