<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use DB;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Exam::insertOrIgnore($request->exams);
            Answer::insertOrIgnore($request->answers);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }

    }


}
