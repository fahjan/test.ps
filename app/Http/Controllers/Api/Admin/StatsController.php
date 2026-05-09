<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatsController extends Controller
{

    public function __invoke(Request $request)
    {
        $students = \App\Models\Student::count();
        $students_this_month = \App\Models\Student::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $students_by_day = \App\Models\Student::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return response()->json([
            'students_count' => $students,
            'students_this_month' => $students_this_month,
            'students_by_day_count' => $students_by_day,
        ]);


    }

}
