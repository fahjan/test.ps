<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerHasRoleToSchoolRequest;
use App\Http\Resources\PaymentWithStudentResource;
use App\Models\Payment;
use App\Models\School;
use Illuminate\Http\Request;

class SohoolPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ManagerHasRoleToSchoolRequest $request)
    {
        $school = School::find($request->school_id);
        $payments = $school->payments()->with(['student', 'creator', 'kind'])->simplePaginate();

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
