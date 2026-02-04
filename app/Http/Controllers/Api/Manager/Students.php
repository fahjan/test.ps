<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use DB;

class Students extends Controller
{
    public function index(Request $request)
    {
        /*  if(!Storage::exists($path)){
            abort(404);
        } */


        // return response()->json(['data' => $request->header('manager-id')], 200);
        $students = Student::where('school_id', $request->header('school-id'))
            ->when($request->active, function ($q, $active) {
                return $q->where('active', $active);
            })
            ->withCount(['lessons', 'payments as payments_sum' => function ($q) {
                return $q->select(DB::raw('SUM(amount) as payments_sum'));
            }])
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
