<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerHasRoleToSchoolRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolLessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(School $school, ManagerHasRoleToSchoolRequest $request)
    {
        $lessons = $school->lessons()
            ->when($request->has('student_id'), function ($query) use ($request) {
                $query->where('student_id', $request->student_id);
            })
            ->when($request->has('trainer_id'), function ($query) use ($request) {
                $query->where('trainer_id', $request->trainer_id);
            })
            ->when($request->has('creator_id'), function ($query) use ($request) {
                $query->where('creator_id', $request->creator_id);
            })
            ->when($request->has('car_id'), function ($query) use ($request) {
                $query->where('car_id', $request->car_id);
            })
            ->when($request->has('from_date'), function ($query) use ($request) {
                $query->whereDate('lesson_at', '>=', $request->from_date);
            })
            ->when($request->has('to_date'), function ($query) use ($request) {
                $query->whereDate('lesson_at', '<=', $request->to_date);
            })
            ->with(['car', 'creator', 'trainer', 'student'])->simplePaginate();

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
