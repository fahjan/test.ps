<?php

namespace App\Http\Controllers\Api\Trainer;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentResourceWithoutExams;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $trainser = auth()->user()->trainers()->where('school_id', $request->school_id)->first();
        if ($trainser->status == 'inactive') {
            return response()->json(['data' => []]);
        }

        $students = Student::where("school_id", $request->school_id)
            ->where("is_disabled", false)
            ->where(function ($query) use ($request) {
                $query->where('trainer_id', $request->trainer_id)
                    ->orWhere('drivingtrainer_id', $request->trainer_id);
            })
            ->simplePaginate();
        return StudentResourceWithoutExams::collection($students);
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
