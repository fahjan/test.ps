<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerHasRoleToSchoolRequest;
use App\Models\Exam;
use App\Models\School;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(School $school, ManagerHasRoleToSchoolRequest $request)
    {
        $students_with_new_paid_status = $school->students()->where('paid_status', 'new')->count();
        $students_this_month = $school->students()->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        $today_exams_count = Exam::whereHas('student', function ($query) use ($school) {
            $query->where('school_id', $school->id);
        })
            ->whereDate('created_at', now())
            ->count();

        $school->loadCount('students', 'lessons');
        $school->loadSum('payments', 'amount');

        $students_count = $school->students_count;
        $lessons_count = $school->lessons_count ?? 0;
        $payments_sum = $school->payments_sum ?? 0;


        return response()->json(compact(
            'students_count',
            'students_with_new_paid_status',
            'students_this_month',
            'lessons_count',
            'payments_sum',
            'today_exams_count',

        ));

    }
}
