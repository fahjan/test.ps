<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SimpleStudentResource;
use App\Http\Resources\StudentsForAdminResource;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class Students extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        session()->pull('original_user_id');

        $paid_status = isset($request->paid_status) ? '&paid_status=' . $request->paid_status : '';
        $use_app = isset($request->use_app) ? '&use_app=' . $request->use_app : '';
        $school_id = isset($request->school_id) ? '&school_id=' . $request->school_id : '';

        $schools = School::where('status', 'active')->orderBy('title')->get();

        $students = Student::with(['user', 'school', 'creator'])

            ->when($request->paid_status, function ($query) use ($request) {
                $query->where('paid_status', $request->paid_status);
            })
            ->when($request->search, function ($q, $search) {
                if (is_numeric($search)) {

                    return $q->whereHas('user', function ($q) use ($search) {
                        $q->whereLike('mobile', '%' . $search . '%');
                    });

                }
                return $q->whereLike('family_name', '%' . $search . '%');
            })
            ->when($request->use_app, function ($query) use ($request) {
                $query->where('use_app', $request->use_app);
            })
            ->when($request->school_id, function ($query) use ($request) {
                $query->where('school_id', $request->school_id);
            })
            ->latest()->simplePaginate()->withQueryString();
        // ->search() can use search scope in student model to search in related models like school and user
        return StudentsForAdminResource::collection($students);


        // return view($this->route . 'index', compact('objects', 'paid_status', 'use_app', 'schools', 'school_id'));
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
    public function update(Request $request, Student $student)
    {
        if ($request->field == 'device_info') {
            $student->user()->update(['device_info', null]);
        }
        if ($request->field == 'paid_status') {
            Student::where('id', $student->id)->update(['paid_status' => $request->value]);
            // $student->update(['paid_status' => $request->value]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
