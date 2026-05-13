<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use DB;
use Illuminate\Http\Request;

class StatsController extends Controller
{

    public function __invoke(Request $request)
    {
        $students = \App\Models\Student::count();

        $students_this_week = \App\Models\Student::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        $students_this_month = Student::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        // $students_this_month = \App\Models\Student::whereMonth('created_at', now()->month)
        //     ->whereYear('created_at', now()->year)
        //     ->count();

        $students_by_day = Student::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        $weeklyCounts = Student::select([
            DB::raw('YEAR(created_at) as year'),
            DB::raw('WEEK(created_at) as week'),
            DB::raw('COUNT(*) as total')
        ])
            ->groupBy('year', 'week')
            ->orderBy('year', 'desc')
            ->orderBy('week', 'desc')
            ->get();

        $monthlyCunts = Student::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as total')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();


        return response()->json([
            'students_count' => $students,
            'students_this_week' => $students_this_week,
            'students_this_month' => $students_this_month,
            'students_by_day_count' => $students_by_day,
            'weeklyCounts' => $weeklyCounts,
            'monthlyCunts' => $monthlyCunts,
        ]);


    }

}
