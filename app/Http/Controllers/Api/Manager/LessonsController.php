<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLessonRequest;
use App\Http\Requests\CreatePaymentRequest;
use App\Http\Resources\ExamResource;
use App\Http\Resources\LessonResource;
use App\Http\Resources\PaymentResource;
use App\Http\Services\CacheService;
use App\Models\Exam;
use App\Models\Lesson;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Student $student)
    {

        $page = request()->page ?? 1;
        return cache()->rememberForever("student-lessons:$student->id-page:$page", function () use ($student) {

            $lessons = Lesson::
                with(['car', 'student', 'trainer'])
                ->where("student_id", $student->id)->latest('created_at')->simplePaginate();

            return LessonResource::collection($lessons);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Student $student, CreateLessonRequest $request, CacheService $cache)
    {

        $cache->clearCache("student-lessons:$student->id-page:");

        $student->lessons()->create($request->validated());

        return $this->index($student);
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
