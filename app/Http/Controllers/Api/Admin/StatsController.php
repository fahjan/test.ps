<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatsController extends Controller
{

    public function __invoke(Request $request)
    {
        $students = \App\Models\Student::count();
        $students_by_day = \App\Models\Student::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return response()->json([
            'students' => $students,
            'students_by_day' => $students_by_day,
        ]);


    }

}
