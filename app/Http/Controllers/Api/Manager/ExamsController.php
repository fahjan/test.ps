<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use App\Models\Student;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Student $student)
    {
        $exams = Exam::where("student_id", $student->id)->simplePaginate(10);
        return ExamResource::collection($exams);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Student $student, Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student, Exam $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
