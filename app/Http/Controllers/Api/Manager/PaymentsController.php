<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePaymentRequest;
use App\Http\Resources\ExamResource;
use App\Http\Resources\PaymentResource;
use App\Http\Services\CacheService;
use App\Models\Exam;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Student $student)
    {

        $page = request()->page ?? 1;
        return cache()->rememberForever("student-payments:$student->id-page:$page", function () use ($student) {
            // return $student->payments()->with('kind')->latest('created_at')->paginate(10);

            $payments = Payment::
                with(['kind', 'student'])
                ->where("student_id", $student->id)->latest('created_at')->simplePaginate();


            return PaymentResource::collection($payments);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Student $student, CreatePaymentRequest $request, CacheService $cache)
    {

        $cache->clearCache("student-payments:$student->id-page:");

        $student->payments()->create($request->validated());

        return $this->index($student);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student, Payment $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $exam)
    {
        //
    }
}
