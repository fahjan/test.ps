<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerCanViewStudentsBySchoolIdRequest;
use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use DB;

class Students extends Controller
{
    public function index(ManagerCanViewStudentsBySchoolIdRequest $request)
    {

        $students = Student::where('school_id', $request->school_id)

            ->when($request->active, function ($q, $active) {
                return $q->where('active', $active);
            })
            ->withCount([
                'lessons',
                'payments as payments_sum' => function ($q) {
                    return $q->select(DB::raw('SUM(amount) as payments_sum'));
                }
            ])
            ->with(['user'])
            ->latest()->paginate();

        return StudentResource::collection($students);
    }

    public function create()
    {
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
