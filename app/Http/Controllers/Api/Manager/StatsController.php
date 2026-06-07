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
    public function __invoke(School $school, ManagerHasRoleToSchoolRequest $request)
    {
        $students_count = $school->students()->count();
        $students_with_new_paid_status = $school->students()->where('paid_status', 'new')->count();
        $students_this_month = $school->students()->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $lessons_count = $school->lessons()->count();
        $payments_sum = $school->payments()->sum('amount');

        $school->loadCount('students', 'lessons', 'payments');

        return response()->json(compact(
            'students_count',
            'students_with_new_paid_status',
            'students_this_month',
            'lessons_count',
            'payments_sum'
        ));

    }
}
