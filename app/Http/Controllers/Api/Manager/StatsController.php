<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerHasRoleToSchoolRequest;
use App\Models\School;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(School $school, ManagerHasRoleToSchoolRequest $request)
    {
        $students_count = $school->students()->count();
        $students_with_new_paid_status = $school->students()->where('paid_status', 'new')->count();
        $students_this_month = $school->students()->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $lessons_count = $school->lessons()->count();
        $payments_sum = $school->payments()->sum('amount');

        return response()->json(compact(
            'students_count',
            'students_with_new_paid_status',
            'students_this_month',
            'lessons_count',
            'payments_sum'
        ));

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
