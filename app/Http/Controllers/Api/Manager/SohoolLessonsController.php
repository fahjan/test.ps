<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerHasRoleToSchoolRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use App\Models\School;
use Illuminate\Http\Request;

class SohoolLessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ManagerHasRoleToSchoolRequest $request)
    {

        $school = School::find($request->school_id);
        $lessons = $school->lessons()->with(['car', 'creator', 'trainer', 'student'])->simplePaginate();

        return LessonResource::collection($lessons);


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
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return response()->json(['message' => 'Lesson deleted successfully']);
    }
}
