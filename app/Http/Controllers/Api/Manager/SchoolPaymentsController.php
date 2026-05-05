<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerHasRoleToSchoolRequest;
use App\Http\Resources\PaymentWithStudentResource;
use App\Models\Payment;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ManagerHasRoleToSchoolRequest $request, School $school)
    {
        $payments = $school->payments()
            ->when($request->has('student_id'), function ($query) use ($request) {
                $query->where('student_id', $request->student_id);
            })
            ->when($request->has('kind_id'), function ($query) use ($request) {
                $query->where('kind_id', $request->kind_id);
            })
            ->when($request->has('creator_id'), function ($query) use ($request) {
                $query->where('creator_id', $request->creator_id);
            })
            ->when($request->has('from_date'), function ($query) use ($request) {
                $query->whereDate('payment_at', '>=', $request->payment_at);
            })
            ->when($request->has('to_date'), function ($query) use ($request) {
                $query->whereDate('payment_at', '<=', $request->payment_at);
            })

            ->with(['student', 'creator', 'kind'])->simplePaginate();

        return PaymentWithStudentResource::collection($payments);
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
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
