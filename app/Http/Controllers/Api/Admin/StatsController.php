<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use App\Models\Student;
use DB;
use Illuminate\Http\Request;

class StatsController extends Controller
{

    public function __invoke(Request $request)
    {
        $students_count = Student::count();

        $students_this_week = Student::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        $students_this_month = Student::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        $students_by_day_count = Student::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        // $weeklyCounts = Student::select([
        //     DB::raw('YEAR(created_at) as year'),
        //     DB::raw('WEEK(created_at) as week'),
        //     DB::raw('COUNT(*) as total')
        // ])
        //     ->groupBy('year', 'week')
        //     ->orderBy('year', 'desc')
        //     ->orderBy('week', 'desc')
        //     ->get();

        $monthlyCounts = Student::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as total')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();


        $payouts = Payout::sum('amount');

        return response()->json(
            compact(
                'students_count',
                'students_by_day_count',
                'students_this_week',
                'students_this_month',
                'monthlyCounts',
                'payouts',
            )
        );

    }

}
